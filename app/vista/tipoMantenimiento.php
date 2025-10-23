<?php
include_once 'componentes/head.php';
include_once 'componentes/menu.php';
?>

<div class="container">
    <!--boton de regresar a la vista gestion mantenimiento-->
    <button class="btn btn-outline-info" onclick="window.location.href='?url=gestionMantenimiento'">
        <i class="fa-solid fa-arrow-left"></i>
</div>
</button>

<div class="container mb-5 p-5">
    <h1>Tipo de Mantenimiento</h1>
    <p>En esta sección puede registrar los tipos de mantenimiento que se pueden realizar a los activos.</p>
    <form method="post">
        <div class="mb-4">
            <label for="nombre_mtto" class="form-label">Nombre del Mantenimiento</label>
            <input type="text" class="form-control form-control-sm mb-4" id="nombre_mtto"
                aria-describedby="nombre_mttoHelp" name="nombre_mtto">
            <div id="nombre_mttoHelp" class="form-text">Ingrese el Nombre del Mantenimiento</div>
        </div>
        <div class="form-floating mb-4">
            <textarea class="form-control form-control-sm mb-4" id="descripcion" name="descripcion"
                placeholder="ingrese la descripcion del mantenimiento" style="height: 100px"></textarea>
            <label for="floatingTextarea2">Describe el Mantenimiento</label>
        </div>
        <button type="submit" id="enviar" name="enviar" class="btn btn-success">Submit</button>

    </form>
    <br><br>


    <div class="table-responsive">
        <table class="table table-hover table-striped text-center table-bordered">
            <thead class="table-primary">
                <tr>
                    <th>ID_TIPO_MANTENIMIENTO</th>
                    <th>NOMBRE MANTENIMIENTO</th>
                    <th>DESCRIPCION</th>
                    <th>Acciones</th>

                </tr>
            </thead>
            <tbody>
                <form method="POST">
                    <?php
                    if (isset($tipo_mantenimiento)) {
                        foreach ($tipo_mantenimiento as $tipo) {
                            ?>
                            <tr>
                                <td> <?= $tipo['id_tipo_mantenimiento'] ?> </td>
                                <td> <?= $tipo['Nombre'] ?> </td>
                                <td> <?= $tipo['Descripcion'] ?> </td>
                                <td>
                                    <button class="btn btn-success" type="button" data-bs-toggle="modal"
                                        data-bs-target="#editar<?= $tipo['id_tipo_mantenimiento'] ?>" name="editar">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path
                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd"
                                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                        </svg>
                                    </button>
                                    <!--BOTON DE MODAL DE ELIMINACION DE ALERTA  -->
                                    <button class="btn btn-danger btnEliminar" title="Eliminar" type="button"
                                        value="<?php $tipo['id_tipo_mantenimiento'] ?>" data-bs-toggle="modal"
                                        data-bs-target="#eliminar">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-trash" viewBox="0 0 16 16">
                                            <path
                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                            <path
                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                        </svg>
                                    </button>

                                </td>
                            </tr>
                            <!-- Nuevo Modal de eliminacion 'ALERTA' -->
                            <div class="modal fade" id="eliminar" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmar eliminación</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <span class="fs-5">
                                                ¿Esta seguro que desea eliminar <strong id="nombreEliminacion"></strong>?
                                            </span>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancelar</button>
                                            <form method="POST">
                                                <input type="hidden" name="id_tipo_mantenimiento"
                                                    value="<?= $tipo['id_tipo_mantenimiento'] ?>">
                                                <button id="btnEliminarMantenimiento" name="Eliminar" type="submit"
                                                    class="btn btn-danger">Eliminar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <!--modal de edicion-->
                            <div class="modal fade" id="editar<?= $tipo['id_tipo_mantenimiento'] ?>" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Registro de Mantenimiento</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>



                                        <!-- formulario de edicion a mantenimiento -->
                                            <div class="modal-body">
                                                <form method="post">
                                                    <div class="mb-4">
                                                        
                                                        <label for="nombre_mtto" class="form-label">Nombre del Mantenimiento</label>
                                                        <input type="text" value="<?php echo $tipo['Nombre'] ?>"
                                                            class="form-control form-control-sm mb-4" id="nombre_mtto"
                                                            aria-describedby="nombre_mttoHelp" name="nombre_mtto">
                                                        <div id="nombre_mttoHelp" class="form-text">Ingrese el Nombre del
                                                            Mantenimiento</div>
                                                    </div>
                                                    <div class="form-floating mb-4">
                                                        <textarea class="form-control form-control-sm mb-4" id="descripcion"
                                                            name="descripcion" style="height: 100px"></textarea>
                                                        <label for="floatingTextarea2"><?php echo $tipo['Descripcion'] ?></label>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger"
                                                            data-bs-dismiss="modal">Cancelar</button>
                                                        <button type="submit" class="btn btn-success p-2" data-bs-toggle="modal"
                                                            title="editar" name="editar"
                                                            value="<?php echo $tipo['id_tipo_mantenimiento'] ?>">Editar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
            </div>
            </form>
        <?php }
                    } else { ?>
        <tr>
            <td colspan="6">
                <h2>No hay registro de Mantenimientos</h2>
            </td>
        </tr>
    <?php } ?>
    </form>
    </tbody>
    </table>


</div>

<?php {
} ?>
</tbody>
</table>
</div>










<?php
include_once 'componentes/footer.php';
?>