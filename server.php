<?php

			require 'vendor/autoload.php';

			use Ratchet\Http\HttpServer;
			use Ratchet\Server\IoServer;
			use Ratchet\WebSocket\WsServer;
			use Ratchet\MessageComponentInterface;
			use Ratchet\ConnectionInterface;

			class NotificationServer implements MessageComponentInterface {

				protected $clients;
				private $pdo;

				public function __construct(){
					$this->clients = new \SplObjectStorage;

					try {
						$this->pdo = new PDO("mysql:unix_socket=/Applications/XAMPP/xamppfiles/var/mysql/mysql.sock;dbname=bridtrack", "root", "");
						$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						echo "Conexión a la base de datos establecida correctamente\n";
					} catch (PDOException $e) {
						echo "Error de conexión a la base de datos: " . $e->getMessage() . "\n";
						die();
					}

				}

				public function onOpen(ConnectionInterface $conn){
					$this->clients->attach($conn);
					echo "New connection! - ({$conn->resourceId})\n";
					$this->sendNotifications($conn);
				}

				public function onMessage(ConnectionInterface $from, $msg){
					$data = json_decode($msg, true);
					echo "Mensaje recibido: " . $msg . "\n";

					if(isset($data['type']) && $data['type'] === 'new_comment'){
						try {
							$statement = $this->pdo->prepare("INSERT INTO comments (comment_subject, comment_text, comment_status) VALUES (?, ?, 0)");
							$result = $statement->execute([$data['subject'], $data['comment']]);
							if($result) {
								echo "Comentario guardado correctamente en la base de datos\n";
								$this->broadcastNotifications();
							} else {
								echo "Error al guardar comentario\n";
							}
						} catch (PDOException $e) {
							echo "Error de base de datos al guardar comentario: " . $e->getMessage() . "\n";
						}
					}

					if(isset($data['type']) && $data['type'] === 'mark_as_read'){
						try {
							$this->markNotificationAsRead($data['comment_id']);
							$this->broadcastNotifications(); // Refresh for all users
						} catch (Exception $e) {
							echo "Error al marcar como leído: " . $e->getMessage() . "\n";
						}
					}
				}

				public function onClose(ConnectionInterface $conn){
					$this->clients->detach($conn);
					echo "Connection {$conn->resourceId} has disconnected\n";
				}

				public function onError(ConnectionInterface $conn, \Exception $e){
					echo "An error occurred: {$e->getMessage()}\n";
					$conn->close();
				}

				private function broadcastNotifications()
				{
					foreach($this->clients as $client){
						$this->sendNotifications($client);
					}
				}

				private function markNotificationAsRead($commentId){
					try {
						$statement = $this->pdo->prepare("UPDATE comments SET comment_status = 1 WHERE comment_id = ?");
						$result = $statement->execute([$commentId]);
						if($result) {
							echo "Notificación marcada como leída\n";
						} else {
							echo "Error al marcar notificación como leída\n";
						}
					} catch (PDOException $e) {
						echo "Error de base de datos al marcar como leído: " . $e->getMessage() . "\n";
					}
				}

				private function sendNotifications(ConnectionInterface $conn){
					try {
						$statement = $this->pdo->query("SELECT * FROM comments ORDER BY comment_id DESC LIMIT 5");
						$notifications = $statement->fetchAll(PDO::FETCH_ASSOC);

						$statement = $this->pdo->query("SELECT COUNT(*) AS unread_count FROM comments WHERE comment_status = 0");
						$unreadCount = $statement->fetch(PDO::FETCH_ASSOC)["unread_count"];

						$response = [
							'type' => 'notification',
							'notifications' => $notifications,
							'unread_count'	=>	$unreadCount
						];

						$conn->send(json_encode($response));
						echo "Notificaciones enviadas a cliente\n";
					} catch (PDOException $e) {
						echo "Error de base de datos al enviar notificaciones: " . $e->getMessage() . "\n";
					}
				}
			}

			// Start the WebSocket server

			$server = IoServer::factory(
				new HttpServer(
					new WsServer(
						new NotificationServer()
					)
				),
				8080
			);

			echo "WebSocket server started on port 8080\n";
			$server->run();

			?>