<?php
include_once 'componentes/head.php';
include_once 'componentes/menu.php';
?>

<body>


    <div class="container">
        <button class="btn btn-outline-info" onclick="window.location.href='?url=gestionMantenimiento'">
            <i class="fa-solid fa-arrow-left"></i>
        </button>
    </div>

    <div class="container mb-5 p-5">
        <h1>Tipo de Mantenimiento</h1>
        <p>En esta sección puede registrar los tipos de mantenimiento que se pueden realizar a los activos.</p>

        <!-- Form creación -->
        <form id="formCrearTipoMTTO" novalidate class="form-box" method="post">
            <div class="mb-4">
                <label for="nombre_mtto" class="form-label">Nombre del Mantenimiento</label>
                <div id="nombre_mttoHelp" class="form-text">Ingrese el Nombre del Mantenimiento</div>
                <input type="text" class="form-control form-control-sm mb-4" id="nombre_mtto" name="nombre_mtto"
                    required>

                <div class="invalid-feedback">Por Favor Ingrese el Nombre del Tipo de Mantenimiento Correctamente.</div>

            </div>
            <div class="form-floating mb-4">
                <textarea class="form-control form-control-sm mb-4" id="descripcion" name="descripcion"
                    placeholder="ingrese la descripcion del mantenimiento" style="height: 100px"></textarea>
                <label for="descripcion">Describe el Mantenimiento</label>
                <div class="invalid-feedback">Por Favor Ingrese la Descripcion correctamente, Debe Tener Minimo 10
                    Caracteres</div>

            </div>
            <button type="submit" name="enviarMTTO" id="enviarMTTO" class="btn btn-success">Registrar Tipo
                Mantenimiento</button>
        </form>

        <br><br>
        <p class="d-inline-flex gap-1">
            <button class="btn btn-info" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample"
                aria-expanded="false" aria-controls="collapseExample">
                Mostrar Tipos de Mantenimiento
            </button>
        </p>

        <div class="collapse" id="collapseExample">
            <div class="card card-body">
                <div class="table-responsive">
                    <table class=" table table-hover table-striped text-center table-bordered" id="myTable">
                        <thead class="table-primary">
                            <tr>
                                <th id="tabla">ID</th>
                                <th id="tabla">NOMBRE</th>
                                <th id="tabla">DESCRIPCION</th>
                                <th id="acciones">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($tipo_mantenimiento)) {
                                foreach ($tipo_mantenimiento as $tipo) { ?>
                                    <tr>
                                        <td><?= $tipo['id_tipo_mantenimiento'] ?></td>
                                        <td><?= $tipo['Nombre'] ?></td>
                                        <td><?= $tipo['Descripcion'] ?></td>
                                        <td>
                                            <!-- Editar (abre modal) -->
                                            <button class="btn btn-success " type="button" data-bs-toggle="modal"
                                                data-bs-target="#modalEditar"
                                                data-id="<?= $tipo['id_tipo_mantenimiento'] ?>"></button>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path
                                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd"
                                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                            </svg>
                                            </button>

                                            <!-- Eliminar (abre modal) -->
                                            <button class="btn btn-danger btnEliminar" type="button"
                                                data-id="<?= $tipo['id_tipo_mantenimiento'] ?>" data-bs-toggle="modal"
                                                data-bs-target="#modalEliminar">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path
                                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                                    <path
                                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>


                                <?php }
                            } else { ?>
                                <tr>
                                    <td colspan="4">
                                        <h5>No hay registro de Mantenimientos</h5>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal eliminar -->

    <div class="modal fade" id="modalEliminar" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title">Confirmar eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    ¿Está seguro de eliminar este tipo de mantenimiento?
                </div>
                <div class="modal-footer">
                    <form method="post" id="formEliminar">
                        <input type="hidden" name="id_tipo_mantenimiento" id="id_tipo_mantenimiento_eliminar"
                            value="<?php echo $tipo['id_tipo_mantenimiento'] ?>">
                        <button name="EliminarMTTO" type="submit" class="btn btn-danger">Eliminar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal editar -->
    <div class="modal fade" id="modalEditar" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Tipo de Mantenimiento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="formEditarTipoMtto" class="formEditarTipoMtto" method="post" novalidate>
                        <input type="hidden" id="nombre_mtto2" name="id_tipo_mantenimiento"
                            value="<?= $tipo['id_tipo_mantenimiento'] ?>">

                        <div class="invalid-feedback">Por Favor Ingrese el Nombre del Tipo de Mantenimiento
                            Correctamente.</div>
                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="nombre_mtto" class="form-control"
                                value="<?= htmlspecialchars($tipo['Nombre']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Descripción</label>
                            <textarea name="descripcion" class="form-control" id="descripcion2"
                                style="height:100px;"><?= htmlspecialchars($tipo['Descripcion']) ?></textarea>

                            <div class="invalid-feedback">Por Favor Ingrese la Descripcion correctamente, Debe Tener
                                Minimo
                                10
                                Caracteres</div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" name="editarMTTO" class="btn btn-success">
                                Guardar cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
<Script src="Assets/js/tablaTipoMTTO.js"></script>

<script type="module" src="Assets/js/validaciones/tipoMantenimiento.js"></script>
<!--<script src="Assets/js/tipoMantenimiento.js"></script>

<?php
include_once 'componentes/footer.php';
?>