<?php
require_once 'componentes/head.php';
require_once 'componentes/menu.php';
?>
<?php if (isset($mensaje)) { ?>
  <div class="alert alert-info alert-dismissible fade show" role="alert">
    <?php echo $mensaje; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php } ?>


<?php if (isset($editar_compra)) { ?>
  <div class="row text-center d-flex justify-content-center">
    <div class="col-md-6 card">
      <div class="card-header">
        <h1>Editar Compra</h1>
      </div>
      <div class="card-body">
        <form method="POST">
          <div class="modal-body d-flex flex-column gap-8">
            <label for="">Ingrese Codigo proveedor</label>
            <input class="form-control" type="text" name="cod_proveedor" placeholder=""
              value="<?php echo $editar_compra['cod_proveedor'] ?>"> <br>
            <label for="">Ingrese Cedula Empleado</label>
            <input class="form-control" type="text" name="cedula_empleado" placeholder=""
              value="<?php echo $editar_compra['cedula_empleado'] ?>"> <br>
            <label for="">Detalles de Compra</label>
            <input type="text" name="Detalle_Compra" id="Detalle_Compra" placeholder=""
              value="<?php echo $editar_compra['Detalle_Compra'] ?>"><br>
            <label for="">Cantidad de Activos</label>
            <input class="form-control" type="text" name="Cantidad"
              placeholder=""
              value="<?php echo $editar_compra['Cantidad'] ?>"><br>
            <label for="">Costo</label>
            <input class="form-control" type="text" name="Costo" placeholder=""
              value="<?php echo $editar_compra['Costo'] ?>"> <br>
            <label for="">Fecha De Compra</label>
            <input class="form-control" type="text" name="Fecha_Compra" placeholder=""
              value="<?php echo $editar_compra['Fecha_Compra'] ?>"> <br>

            <button type="submit" class="btn btn-danger">Cancelar</button> <br>
            <button type="submit" class="btn btn-success" name="editar"
              value="<?php echo $editar_compra['id_compra'] ?>">Editar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

<?php } else { ?>

  <br><br>
  <div class="card">
    <div class="card-head">
      <h1 class="text-center">CENTRO DE COMPRAS Y REGISTRO</h1>
    </div> <br>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#realizar_compra">
      Ingresar una compra
    </button>
    <br>

    <!--boton de redireccionar a la vista PROVEEDORES-->
    <button class="btn btn-info" onclick="window.location.href='?url=gestionProveedores'">
      Ir a proveedores
    </button>

    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover table-striped text-center table-bordered">
          <thead class="table-primary">
            <tr>
              <th>ID de Compra</th>
              <th>Proveedor</th>
              <th>Empleado</th>
              <th>Detalle de Compra</th>
              <th>Cantidad</th>
              <th>Costo</th>
              <th>Fecha de Compra</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <form method="POST">
              <?php if (isset($compras)) {
                foreach ($compras as $compra) { ?>
                  <tr>
                    <td> <?php echo $compra['id_compra'] ?> </td>
                    <td> <?php echo $compra['cod_proveedor'] ?> </td>
                    <td> <?php echo $compra['cedula_empleado'] ?> </td>
                    <td> <?php echo $compra['Detalle_Compra'] ?> </td>
                    <td> <?php echo $compra['Cantidad'] ?> </td>
                    <td> <?php echo $compra['Costo'] ?> </td>
                    <td> <?php echo $compra['Fecha_Compra'] ?> </td>
                    <td>
                      <button class="btn btn-success" title="editar" type="submit" name="seleccion"
                        value="<?php echo $compra['id_compra'] ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                          class="bi bi-pencil-square" viewBox="0 0 16 16">
                          <path
                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                          <path fill-rule="evenodd"
                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                        </svg>
                      </button>
                      <button class="btn btn-danger btnEliminar" title="Eliminar" type="button"
                        value="<?php echo $compra['id_compra'] ?>" data-bs-toggle="modal" data-bs-target="#eliminar">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash"
                          viewBox="0 0 16 16">
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
                  <td colspan="5">
                    <h2>No hay registros de compras aun :</h2>
                  </td>
                </tr>
              <?php } ?>
            </form>
          </tbody>
        </table>
      </div>
    </div>
  </div>

<?php } ?>

<div class="modal fade" id="realizar_compra" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Ingresar una nueva compra</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST">
        <div class="modal-body d-flex flex-column gap-4">

          <label for="Titulo">Ingrese el detalle de la compra separando cada articulo con una coma ( , ).</label>
          <div class="form-floating mb-4">
            <textarea class="form-control form-control-sm mb-4" id="Detalle_Compra"
              name="Detalle_Compra" style="height: 100px"></textarea>
            <label for="floatingTextarea2"> Ejemplo: Articulo1, Articulo2, Articulo3, Articulo4. </label>
          </div>
          <input type="number" name="Cantidad" id="cantidad" placeholder="Ingrese la Cantidad de articulos comprados">
          <input type="number" name="Costo" id="Costo" placeholder="Costo total de la compra">
          <input class="form-control" type="date" name="Fecha_Compra" placeholder="Ingrese Fecha de la compra">
          <br>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary" name="enviar_compra">Enviar Compra</button>
        </div>
      </form>
    </div>


    <script src="assets\bootstrap\js\bootstrap.bundle.min.js"></script>
    </body>

    <!-- Nuevo Modal de eliminacion 'ALERTA' -->
    <div class="modal fade" id="eliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-danger">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmar eliminación</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <span class="fs-5">
              ¿Esta seguro que desea eliminar <strong id="nombreEliminacion"></strong>?
            </span>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
            <form method="POST">
              <button id="btnEliminarCompra" name="eliminar" type="submit" class="btn btn-danger">Eliminar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

    <script>
      $(document).ready(() => {
        $(".btnEliminar").each((index, element) => {
          $(element).on('click', (e) => {
            $('#btnEliminarCompra').val($(e.target).closest('tr').find('td:eq(0)').text())
            $('#nombreEliminacion').text($(e.target).closest('tr').find('td:eq(0)').text())
          })
        })
      });
    </script>


    <?php
    require_once 'componentes/footer.php';
    ?>