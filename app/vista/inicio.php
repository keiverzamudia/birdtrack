<?php 
require_once 'componentes/head.php';
require_once 'componentes/menu.php';
?>
 <!-- Begin Page Content -->
 <div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Panel Central</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generar Reporte</a>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Enviar un mensaje global</div>
                        <a href="#" style="font-weight: bold; color: #5a5c69; font-size: 20px;">Enviar un Mensaje Global</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Enviar mensaje personal</div>
                        <a href="#" style="font-weight: bold; color: #5a5c69; font-size: 20px;">Enviar un Mensaje Privado</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Asignar Activos</div>
                        <a href="?url=gestionActivos" style="font-weight: bold; color: #5a5c69; font-size: 20px;">Asigna un Activo</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Activos asignados a Usuario</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Vista de mensajes Recibidos</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="row">
                    <!-- Mensajes Globales -->
                    <div class="col-md-6">
                        <h6 class="font-weight-bold text-primary">Mensajes Globales</h6>
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">Recuerden Formatear las Memorias</h6>
                                        <small class="text-muted">December 12, 2019</small>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">Recuerden Cargar las Baterias de las Camaras</h6>
                                        <small class="text-muted">December 7, 2019</small>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">Recuerden Cargar la Baterias de los Intercom</h6>
                                        <small class="text-muted">December 2, 2019</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Centro de Mensajes -->
                    <div class="col-md-6">
                        <h6 class="font-weight-bold text-primary">Centro de Mensajes</h6>
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <div class="mr-3">
                                        <img class="rounded-circle" src="assets/img/cardenales.png" alt="..." style="width: 40px; height: 40px;">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">Hi there! I am wondering if you can help me with a problem I've been having.</h6>
                                        <small class="text-muted">Emily Fowler · 58m</small>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <div class="mr-3">
                                        <img class="rounded-circle" src="assets/img/cardenales.png" alt="..." style="width: 40px; height: 40px;">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">I have the photos that you ordered last month, how would you like them sent to you?</h6>
                                        <small class="text-muted">Jae Chun · 1d</small>
                                    </div>
                                </div>
                        </div>
                        </a class="flex-grow-1">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Porcentaje Total de Articulos</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <canvas id="myPieChart"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    <span class="mr-2">
                        <i class="fas fa-circle text-primary"></i> Asignados
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-success"></i> Sin Asignar
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-info"></i> En Mantenimiento
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>


        <!-- Project Card Example -->


        <!-- Color System -->


        <!-- Illustrations -->


        <!-- Approach -->

        <!-- /.container-fluid -->

    </div>
<?php 
require_once 'componentes/footer.php';
?>