<?php
require_once 'componentes/head.php';
require_once 'componentes/menu.php';
?>

<!-- MENSAJE DE ALERTA -->
<?php if (isset($mensaje)) { ?>
  <div class="alert alert-info alert-dismissible fade show" role="alert">
    <?php echo $mensaje; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php } ?>



<div class="container">

        <!--boton de regresar a la vista gestion compra -->
<button class="btn btn-outline-info" onclick="window.location.href='?url=compras'" >
        <i class="fa-solid fa-arrow-left"></i>
    </button>



        <!--boton de registrar proveedor-->

    <button type="button" class="btn btn-info text-white px-4 py-2" data-bs-toggle="modal"
        data-bs-target="#registro_proveedor">
        <i class="bi bi-person-plus"></i> Registrar Proveedor
    </button>
</div>

        <!--MODEL REGISTRO PROVEEDOR-->
    <div class="modal fade" id="registro_proveedor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"> Proveedores </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="POST" id="formRegistroProveedor">
                    
                      <h6>Ingresar un nuevo proveedor</h6>
                    <div class="modal-body d-flex flex-column gap-1">
                        <label for="tit">Nombre</label>
                        <input class="form-control" type="text" id="Nombre_Proveedor" name="Nombre_Proveedor"
                            placeholder="Ingrese nombre de proveeedor">
                        <label for="tit">Direccion </label>
                        <input class="form-control" type="text" id="Direccion" name="Direccion"
                            placeholder="ingrese direccion de proveedor">
                        <label for="tit">Numero de Contacto</label>
                        <input class="form-control" type="number" id="Numero_telefono" name="Numero_telefono"
                            placeholder="Ingrese numero telefonico">
                        <label for="tit">Correo</label>
                        <input class="form-control" type="email" id="Correo_elect" name="Correo_elect"
                            placeholder="Ingrese correo electronico de proveedor">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" id="btnregistrarprov" value="registrar" name="btnregistrarprov" >Enviar Proveedor</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <br>



    <!--TABLA DE PROVEEDORES -->

<div class="table-responsive container-fluid">
    <table id="tablaProv" class="table table-hover table-striped text-center table-bordered">
        <thead class="table-primary">
            <tr>
                <th>Codigo de proveedor</th>
                <th>Nombre</th>
                <th>Direccion</th>
                <th>Numero Telefono</th>
                <th>Correo electronico </th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
          
        </tbody>
    </table>
</div>




<!--MODAL de EDICION -->


<div class="modal fade" id="editar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Proveedor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="POST" id="editarForm">

                <div class="modal-body">
                    <div class="mb-3">

              <input type="hidden" name="cod_proveedor" id="codProveedorEdit" value="">



                        <label for="nombreProveedor" class="form-label">Modifique Nombre</label>
                        <input class="form-control" type="text" name="Nombre_Proveedor" id="nombreProveedor"
                            placeholder="Ingrese el nombre modificado del proveedor"
                           >
                    </div>

                    <div class="mb-3">
                        <label for="direccionProveedor" class="form-label">Direccion</label>
                        <input class="form-control" type="text" name="Direccion" id="direccionProveedor"
                            placeholder="Ingrese la dirección modificada del proveedor">
                    </div>

                    <div class="mb-3">
                        <label for="telefonoProveedor" class="form-label">Numero de telefono</label>
                        <input class="form-control" type="number" name="Numero_telefono" id="telefonoProveedor"
                            placeholder="Ingrese el número de teléfono modificado del proveedor">
                    </div>

                    <div class="mb-3">
                        <label for="correoProveedor" class="form-label">Correo electronico</label>
                        <input class="form-control" type="email" name="Correo_elect" id="correoProveedor"
                            placeholder="Ingrese el correo electrónico modificado del proveedor">
                    </div>
                </div> <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success" name="editar_proveedor">Guardar Cambios</button>

                </div>
            </form>
        </div>
    </div>
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
                    ¿Está seguro que desea eliminar al proveedor  <strong id="idProveedorEliminacion"></strong>?
                </span>
            </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form method="POST">
                    <!-- The confirm button's value will be set by JS when user clicks delete -->
                    <button id="btneliminarprov" type="button" class="btn btn-danger">Eliminar</button>
                        class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>




<script src="Assets/js/tablaProveedores.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>     




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


<?php
require_once 'componentes/footer.php';
?>


