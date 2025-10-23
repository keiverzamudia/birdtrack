<!--Inicio Sidebar -->
  
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon">
        <img src="Assets/img/cardenales.png" alt="Logo" style="width:40px; height:40px;">
    </div>
    <div class="sidebar-brand-text mx-3">BirdTrack</div>
</a>
<!-- Barra Divisora -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->


<!-- Divider -->
<hr class="sidebar-divider">
<li class="nav-item">
    <a class="nav-link" href="?url=inicio">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>
<!-- Barra Divisora -->
<hr class="sidebar-divider my-0">


<!-- Nav Item - Gestion de Activos Menu -->
<li class="nav-item">
    <a class="nav-link" href="?url=gestionActivos">
        <i class="fa-solid fa-laptop-medical"></i>
        <span>Gestion de Activos</span></a>
</li>

<!-- Nav Item - Asignacion de Activos Menu -->
<li class="nav-item">
    <a class="nav-link" href="?url=asignacionActivo">
        <i class="fa-solid fa-people-arrows"></i>
        <span>Asignacion de Activos</span></a>
</li>


<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading --> <!--
<div class="sidebar-heading">
    Addons
</div> -->

            <!-- Nav Item - Gestion de Usuario Menu -->
<li class="nav-item">
    <a class="nav-link" href="?url=gestionUsuarios">
        <i class="fa-solid fa-user-gear"></i>
        <span>Gestion de Usuarios</span></a>
</li>
<!-- Divider -->
<hr class="sidebar-divider">

<!-- Nav Item - Reclamos Menu -->
<li class="nav-item">
    <a class="nav-link" href="?url=reclamos">
        <i class="fa-solid fa-person-circle-exclamation"></i>
        <span>Reclamos</span></a>
</li>

<!-- Nav Item - Gestion de Mantenimiento Menu -->
<li class="nav-item">
    <a class="nav-link" href="?url=gestionMantenimiento">
        <i class="fa-solid fa-screwdriver-wrench"></i>
        <span>Gestion Mantenimiento</span></a>
</li>

            <!-- Divider -->
<hr class="sidebar-divider">

            <!-- Nav Item - Centro de Mensajes Menu -->
<li class="nav-item">
    <a class="nav-link" href="#">
        <i class="fa-solid fa-comments"></i>
        <span>Contro de Mensajes</span></a>
</li>
                        <!-- Divider -->
<hr class="sidebar-divider">

<!-- Nav Item - Compras y Proveedores Menu -->
<li class="nav-item">
    <a class="nav-link" href="?url=compras">
        <i class="fa-solid fa-cart-shopping"></i>
        <span>Compras y Proveedores</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Nav Item - Perfil de Usuario -->
<li class="nav-item">
    <a class="nav-link" href="?url=perfilAdm">
        <i class="fas fa-user-circle"></i>
        <span>Mi Perfil</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- Fin de SideBar -->



<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column flex-grow-1">

  <!-- Main Content -->
  <div id="content">

   <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

      <!-- Sidebar Toggle (Topbar) -->
      <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
      </button>

      <!-- Topbar Navbar -->
      <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) 
        <li class="nav-item dropdown no-arrow d-sm-none">
          <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-search fa-fw"></i>
          </a>
          <!-- Dropdown - Messages 
          <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"

          aria-labelledby="searchDropdown">
            <form class="form-inline mr-auto w-100 navbar-search">
              <div class="input-group">
                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                  aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                  <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>
        -->
        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-bell fa-fw"></i>
            <span class="badge badge-danger badge-counter" id="unreadCount">0</span>
          </a>
          <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="notificationDropdown">
            <h6 class="dropdown-header">
              Centro de Alertas
            </h6>
            <ul id="notificationList">
              <li><a class="dropdown-item text-center">No new notifications</a></li>
            </ul>
          </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
      <li class="nav-item dropdown no-arrow">
    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        
        <div class="mr-2 d-none d-lg-inline text-gray-600 small text-right">
            <span class="font-weight-bold">
                <?php echo $_SESSION["usuario"]["Nombre_Empleado"] ?>
            </span>
            <br>
            <span class="text-danger">
                <?php echo strtoupper($_SESSION["usuario"]["id_cargo"]) ?>
            </span>
        </div>
        
        <img class="img-profile rounded-circle" src="Assets/img/cardenales.png" alt="Perfil">
    </a>
    
    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
        <a class="dropdown-item" href="?url=perfilAdm">
            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Perfil
        </a>
        <a class="dropdown-item" href="#">
            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i> Configuraciones
        </a>
        <a class="dropdown-item" href="#">
            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i> Activity Log
        </a>
        <div class="dropdown-divider"></div>
        
        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Cerrar Sesión
        </a>
    </div>
</li>    

      </ul>
<form method="POST" action="?url=login" class="d-inline">
  <button type="submit" name="logout" class="btn-logout-pulse">
    <i class="fas fa-sign-out-alt mr-2"></i>
    <span>Salir</span>
    <span class="pulse-dot"></span>
  </button>
</form>

    </nav>
  </form>

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

							a.className = 'dropdown-item d-flex align-items-center';

							a.href = '#';

							a.innerHTML = `
								<div class="dropdown-list-image mr-3">
									<img class="rounded-circle" src="Assets/img/cardenales.png" alt="...">
									<div class="status-indicator bg-success"></div>
								</div>
								<div>
									<div class="text-truncate">${notification.Descripcion}</div>
									<div class="small text-gray-500">${notification.Fecha_reclamo}</div>
									<span class="font-weight-bold">${notification.Nombre_Empleado || notification.cedula_empleado}</span>
								</div>
							`;

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