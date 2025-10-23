<!DOCTYPE html>
			<html lang="en">
			<head>
				<meta charset="UTF-8">
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<title>Real-Time Notifications</title>
				<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
			</head>
			<body class="container mt-5">
				<h2 class="text-center mb-4">Real-Time Notifications</h2>
				<div class="card shadow-sm p-4">
					<div class="text-end">
						<div class="dropdown">
							<button class="btn btn-primary dropdown-toggle" type="button" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
								Notifications <span id="unreadCount" class="badge bg-danger">0</span>
							</button>
							<ul class="dropdown-menu dropdown-menu-end" id="notificationList">
								<li><a class="dropdown-item text-center">No new notifications</a></li>
							</ul>
						</div>
					</div>
				</div>
				<script>
					var conn = new WebSocket('ws://localhost:8080');

					conn.onopen = function(){
						console.log('WebSocket Connected!');
					};

					conn.onmessage = function(event){
						var data = JSON.parse(event.data);
						if(data.type === 'notification'){
							updateNotificationDropdown(data.notifications);
						}
					};

					function updateNotificationDropdown(notifications){
						var notificationList = document.getElementById('notificationList');
						var unreadBadge = document.getElementById('unreadCount');

						notificationList.innerHTML = '';

						if(notifications.length === 0){
							notificationList.innerHTML = `<li><a class="dropdown-item text-center">No new notifications</a></li>`;
							unreadBadge.style.display = 'none';
							return;
						}

						let count = 0;

						notifications.forEach(function(notification){

							let li = document.createElement('li');
							let a = document.createElement('a');

							a.className = 'dropdown-item';

							a.href = '#';

							a.innerHTML = `<strong>${notification.Nombre_Empleado || notification.cedula_empleado}</strong>: ${notification.Descripcion} ${notification.Fecha_reclamo}`;

							if(notification.comment_status == 0){
								console.log('test');
								a.style.fontWeight = 'bold';
								count++;
							}

							// Mark as read on click
							a.onclick = function(){
								markAsRead(notification.id_reclamo);
							};

							li.appendChild(a);
							notificationList.appendChild(li);
						});

						unreadBadge.textContent = count;
						unreadBadge.style.display = count > 0 ? "inline" : "none";
					}

					function markAsRead(reclamoId){
						conn.send(JSON.stringify({ type : "mark_as_read", id_reclamo : reclamoId }));
					}

				</script>
			</body>
			</html>
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>