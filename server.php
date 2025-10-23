<?php

require 'vendor/autoload.php';

use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class NotificationServer implements MessageComponentInterface
{

    protected $clients;
    private $pdo;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;

        $this->pdo = new PDO("mysql:host=localhost;dbname=bridtrack", "root", "");
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        echo "New connection! - ({$conn->resourceId})\n";
        $this->sendNotifications($conn);
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        $data = json_decode($msg, true);

        if (isset($data['type']) && $data['type'] === 'new_comment') {
            $statement = $this->pdo->prepare("INSERT INTO reclamo_activo (cedula_empleado, Descripcion, Fecha_reclamo) VALUES (?, ?, NOW())");
            $statement->execute([$data['subject'], $data['comment']]);
            $this->broadcastNotifications();
        }

        if (isset($data['type']) && $data['type'] === 'new_reclamo') {
            $statement = $this->pdo->prepare("INSERT INTO reclamo_activo (cedula_empleado, id_activo, Descripcion, Fecha_reclamo) VALUES (?, ?, ?, ?)");
            $statement->execute([$data['cedula_empleado'], $data['id_activo'], $data['descripcion'], $data['fecha_reclamo']]);
            $this->broadcastNotifications();
        }

        if (isset($data['type']) && $data['type'] === 'mark_as_read') {
            $this->markNotificationAsRead($data['id_reclamo']);
            $this->broadcastNotifications(); // Refresh for all users
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error occurred: {$e->getMessage()}\n";
        $conn->close();
    }

    private function broadcastNotifications()
    {
        foreach ($this->clients as $client) {
            $this->sendNotifications($client);
        }
    }

    private function markNotificationAsRead($commentId)
    {
        $statement = $this->pdo->prepare("UPDATE reclamo_activo SET comment_status = 1 WHERE id_reclamo = ?");
        $statement->execute([$commentId]);
    }

    private function sendNotifications(ConnectionInterface $conn)
    {
        $statement = $this->pdo->query("SELECT ra.*, e.Nombre_Empleado 
                                       FROM reclamo_activo ra 
                                       LEFT JOIN empleado e ON ra.cedula_empleado = e.cedula_empleado 
                                       ORDER BY ra.id_reclamo DESC LIMIT 5");

        $notifications = $statement->fetchAll(PDO::FETCH_ASSOC);

        $statement = $this->pdo->query("SELECT COUNT(*) AS unread_count FROM reclamo_activo WHERE comment_status = 0");

        $unreadCount = $statement->fetch(PDO::FETCH_ASSOC)["unread_count"];

        $response = [
            'type' => 'notification',
            'notifications' => $notifications,
            'unread_count'    =>    $unreadCount
        ];

        $conn->send(json_encode($response));
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
