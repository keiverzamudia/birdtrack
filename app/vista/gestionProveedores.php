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
                    <button type="submit" class="btn btn-primary" name="registrar" onsubmit="confirmarGuardar()">Enviar Proveedor</button>
                </div>
            </form>
        </div>
    </div>
</div>
<br>



    <!--TABLA DE PROVEEDORES -->

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
            <?php if (isset($proveedores)) {  foreach ($proveedores as $proveedor) { ?>
                    <tr>
                        <td> <?php echo $proveedor['cod_proveedor'] ?> </td>
                        <td> <?php echo $proveedor['Nombre_Proveedor'] ?> </td>
                        <td> <?php echo $proveedor['Direccion'] ?> </td>
                        <td> <?php echo $proveedor['Direccion'] ?> </td>
                        <td> <?php echo $proveedor['Numero_telefono'] ?> </td>
                        <td> <?php echo $proveedor['Correo_elect'] ?> </td>
                        <td>
                            <form method="POST" style="display:inline;">


                            
         <button class="btn btn-success" title="editar_proveedor" type="button" name="seleccion"
                       data-bs-toggle="modal" ni data-bs-target="#editar"  class="btn btn-warning btn-editar"
                        data-cod="<?= $prov['cod_proveedor'] ?>"
                        data-nombre="<?= $prov['Nombre_Proveedor'] ?>"
                        data-direccion="<?= $prov['Direccion'] ?>"
                        data-telefono="<?= $prov['Numero_telefono'] ?>"
                        data-correo="<?= $prov['Correo_elect'] ?>"     onsubmit="return confirmarEditar()">

              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-pencil-square" viewBox="0 0 16 16">
                               <path
                   d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                              <path fill-rule="evenodd"
                     d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                            </svg>

             </button>
                            </form>

                            <button class="btn btn-danger btnEliminar" title="elim" type="button"
                                data-id="<?php echo $proveedor['cod_proveedor'] ?>" data-bs-toggle="modal"
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

                    <input type="hidden" name="cod_proveedor" id="codProveedorEdit" 
                           value="<?= $proveedor['cod_proveedor'] ?>">



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
                    <button type="submit" class="btn btn-success" name="editar_proveedor" onsubmit="confirmarEditar()">Guardar Cambios</button>

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
                    <input type="hidden" name="eliminar" value="<?= $proveedor['cod_proveedor'] ?>">
                    <button id="btnEliminarProveedorConfirm" name="eliminar" type="submit"
                        class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>







        
<?php
require_once 'componentes/footer.php';
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
  $(document).ready(()=>{
    $(".btnEliminar").each((index, element)=>{
      $(element).on('click',(e)=>{
        $('#btnEliminarProveedorConfirm').val($(e.target).closest('tr').find('td:eq(0)').text()) //encuentra la fila de la tabla donde se hizo clic.
        $('#idProveedorEliminacion').text($(e.target).closest('tr').find('td:eq(1)').text()) //Dentro de esa fila, busca la segunda celda (<td>) (índice 1).
      })
    })

    });
    </script>
    
    
<script>
  
  function confirmarEditar() {
    return confirm("¿Estás seguro de que deseas EDITAR este proveedor?");
  }

  function confirmarGuardar() {
    return confirm("¿Estás seguro de que deseas Guardar este proveedor ?");
  }

</script>

