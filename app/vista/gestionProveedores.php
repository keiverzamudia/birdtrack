<?php
require_once 'componentes/head.php';
require_once 'componentes/menu.php';
?>

<div class="container">
    <!--boton de regresar a la vista gestion mantenimiento-->
    <button class="btn btn-outline-info" onclick="window.location.href='?url=compras'">
        <i class="fa-solid fa-arrow-left"></i>

    </button>
</div>
<br>

<div class="container">
    <button type="button" class="btn btn-info text-white px-4 py-2" data-bs-toggle="modal"
        data-bs-target="#registro_proveedor">
        <i class="bi bi-person-plus"></i> Registrar Proveedor
    </button>
</div>


<div class="modal fade" id="registro_proveedor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"> Proveedores </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="POST">
                <h6>Ingresar un nuevo proveedor</h6>
                <div class="modal-body d-flex flex-column gap-1">
                    <label for="tit">Nombre</label>
                    <input class="form-control" type="text" name="Nombre_Proveedor"
                        placeholder="Ingrese nombre de proveeedor">
                    <label for="tit">Direccion </label>
                    <input class="form-control" type="text" name="Direccion"
                        placeholder="ingrese direccion de proveedor">
                    <label for="tit">Numero de Contacto</label>
                    <input class="form-control" type="number" name="Numero_telefono"
                        placeholder="Ingrese numero telefonico">
                    <label for="tit">Correo</label>
                    <input class="form-control" type="email" name="Correo_elect"
                        placeholder="Ingrese correo electronico de proveedor">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" name="registrar">Enviar Proveedor</button>
                </div>
            </form>
        </div>
    </div>
</div>
<br>

<div class="table-responsive">
    <table class="table table-hover table-striped text-center table-bordered">
        <thead class="table-primary">
            <tr>
                <th>Codigo de proveedor</th>
                <th>Nombre</th>
                <th>Direccion</th>
                <th>Detalle de compra</th>
                <th>Numero Telefono</th>
                <th>Correo electronico </th>
                <th>Acciones</th>

            </tr>
        </thead>
        <tbody>
            <?php if (isset($proveedores)) { // Verificamos que $compras exista y no esté vacío ?>
                <?php foreach ($proveedores as $proveedor) { ?>
                    <tr>
                        <td> <?php echo $proveedor['cod_proveedor'] ?> </td>
                        <td> <?php echo $proveedor['Nombre_Proveedor'] ?> </td>
                        <td> <?php echo $proveedor['Direccion'] ?> </td>
                        <td> <?php echo $proveedor['Direccion'] ?> </td>
                        <td> <?php echo $proveedor['Numero_telefono'] ?> </td>
                        <td> <?php echo $proveedor['Correo_elect'] ?> </td>
                        <td>
                            <form method="POST" style="display:inline;">
                                <button class="btn btn-success" title="editar" type="submit" name="seleccion"
                                    data-bs-toggle="modal" ni data-bs-target="#editar"
                                    value="<?php echo $compra['cod_proveedor'] ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                    </svg>
                                </button>
                            </form>
                            <button class="btn btn-danger btnEliminar" title="editar" type="button"
                                data-id="<?php echo $compra['cod_proveedor'] ?>" data-bs-toggle="modal"
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
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="10">
                        <h2>No hay registros de compras aún.</h2>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!--Alerta de eliminacion -->

<div class="modal fade" id="eliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmar eliminación de Proveedor</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span class="fs-5">
                    ¿Está seguro que desea eliminar al proveedor con código <strong
                        id="idProveedorEliminacion"></strong>?
                </span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form method="POST">
                    <input type="hidden" name="eliminar" value="<?= $proveedor['cod_proveedor'] ?>">
                    <button id="btnEliminarProveedorConfirm" name="eliminar" type="submit"
                        class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>






<!--MODAL DE EDICION  -->
<div class="modal fade" id="editar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row text-center d-flex justify-content-center" id="editar">
                    <div class="col-md-6 card">
                        <div class="card-header">
                            <h1>Editar Proveedor</h1>
                        </div>
                        <div class="card-body">
                            <form method="POST">
                                <div class="modal-body d-flex flex-column gap-8">
                                    <input class="form-control" type="text" name="Nombre_Proveedor"
                                        placeholder="Ingrese el nombre del proveedor"
                                        value="<?php echo $editar_proveedor['Nombre_Proveedor'] ?>"> <br>
                                    <input class="form-control" type="text" name="Direccion"
                                        placeholder="Ingrese la dirección del proveedor"
                                        value="<?php echo $editar_proveedor['Direccion'] ?>"> <br>
                                    <input class="form-control" type="text" name="Numero_telefono"
                                        placeholder="Ingrese el número de teléfono del proveedor"
                                        value="<?php echo $editar_proveedor['Numero_telefono'] ?>"> <br>
                                    <input class="form-control" type="email" name="Correo_elect"
                                        placeholder="Ingrese el correo electrónico del proveedor"
                                        value="<?php echo $editar_proveedor['Correo_elect'] ?>"> <br>
                                    <button type="submit" class="btn btn-danger">Cancelar</button> <br>
                                    <button type="submit" class="btn btn-success" name="editar"
                                        value="<?php echo $editar_proveedor['cod_proveedor'] ?>">Editar</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div> 
  </div>
</div>

        <?php
        require_once 'componentes/footer.php';
        ?>