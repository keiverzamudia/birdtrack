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



<br><br>

<div class="card">
  <div class="card-head">
    <h1 class="text-center">CENTRO DE COMPRAS Y REGISTRO</h1>
  </div>
  <br>

  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#realizar_compra">
    Ingresar una compra
  </button>
  <br>
  <button class="btn btn-info" onclick="window.location.href='?url=gestionProveedores'">
    Ir a proveedores
  </button>

  <br><br>
        <!--TABLA DE COMPRAS -->

    <div class="card-body">
      <div class="table-responsive">
        <table  id="tablaCompra" class="table table-hover table-striped text-center table-bordered">
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
          
          </tbody>
        </table>
      </div>
    </div>
  </div>





<!-- MODAL: Registrar Compra -->
<div class="modal fade" id="realizar_compra" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" id="formRegistrarCompra">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Ingresar una nueva compra</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body d-flex flex-column gap-4">


          <?php $proveedor = $obj_model->proveedor(); ?>
          <select name="cod_proveedor" id="cod_proveedor" required>
            <option value="">Seleccione un proveedor</option>
            <?php foreach ($proveedor as $proveedores) {
              echo "<option value='{$proveedores['cod_proveedor']}'> {$proveedores['Nombre']}</option>";
            } ?>
          </select> 


<?php $encargado = $obj_model->encargado(); ?>
          <select name="cedula_empleado" id="cedula_empleado" required>
            <option value="">Seleccione un encargado</option>
            <?php foreach ($encargado as $encarg) {
              echo "<option value='{$encarg['cedula_empleado']}'>{$encarg['Nombre']}</option>";
            } ?>
          </select>



          <label for="Titulo">Ingrese el detalle de la compra separando cada artículo con coma (,) </label>

          <div class="form-floating mb-4">
            <textarea class="form-control form-control-sm mb-4" required id="Detalle_Compra" name="Detalle_Compra" style="height: 100px"></textarea>
            <label for="floatingTextarea2">Ejem plo: Articulo1, Articulo2, Articulo3</label>
          </div>

          <input type="number" name="Cantidad" id="cantidad" placeholder="Cantidad de artículos" required>
          
          <input type="number" name="Costo" id="Costo" placeholder="Costo total de la compra" required>

          <input class="form-control" type="date" name="Fecha_Compra" placeholder="Fecha de compra" required>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary btn-enviar" id="btnEnviar">Enviar Compra</button>
        </div>
      </form>
    </div>
  </div>
</div>





<!-- MODAL: EDITAR COMPRA -->

<div class="modal fade" id="editarCompraModal" tabindex="-1" aria-labelledby="editarCompraLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editarCompraLabel">Editar compra</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <form method="POST" id="formEditarCompra">
        <div class="modal-body d-flex flex-column gap-2">


          <input type="hidden" name="id_compra" id="idCompraEdit">
          <input type="hidden" name="cod_proveedor" id="codProveedorEdit">


           <?php $proveedor = $obj_model->proveedor(); ?>
          <select name="cod_proveedor" id="cod_proveedor" required>
            <option value="">Seleccione un proveedor</option>
            <?php foreach ($proveedor as $proveedores) {
              echo "<option value='{$proveedores['cod_proveedor']}'> {$proveedores['Nombre']}</option>";
            } ?>
          </select> 
          <br>
               <label for=""> Empleado</label>
          <select class="form-control" name="cedula_empleado" id="cedulaEmpleadoEdit" required>
            <option value="" selected hidden>Seleccione el encargado</option>
            <?php foreach($encargado as $encarg){ ?>
              <option value="<?= $encarg['cedula_empleado'] ?>"><?= $encarg['Nombre'] ?></option>
            <?php } ?>
          </select>
                <br>
          <label for="detalleCompraEdit"><strong>Detalle de  compra separar elementos por una COMA (,) Ejemplo: Articulo1, Articulo2, Articulo3  </label>
          <textarea class="form-control" name="Detalle_Compra" id="detalleCompraEdit" rows="3" required></textarea>
          
            <label for="">Cantidad</label>
          <input type="number" name="Cantidad" id="cantidadEdit" placeholder="Cantidad de artículos" class="form-control" required>
            <label for="">Costo</label>
          <input type="number" name="Costo" id="costoEdit" placeholder="Costo total de la compra" class="form-control" required>
            <label for="">Fecha de Compra</label>
          <input type="date" name="Fecha_Compra" id="fechaCompraEdit" class="form-control" required>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Cancelar </button>
          <button type="submit" class="btn btn-success" name="editar_compra"> Guardar Cambios </button>

        </div>
      </form>
    </div>
  </div>
</div>





<!-- MODAL: Confirmar Eliminación -->
 <div class="modal fade" id="eliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmar eliminación</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <span class="fs-5">
            ¿Está seguro que desea eliminar el registro de compra N° <strong id="nombreEliminacion"></strong>?
          </span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <form method="POST">
            <button id="btnEliminar" name="eliminar" type="submit" class="btn btn-danger"> Eliminar </button>
          </form>
        </div>
      </div>
    </div>
  </div>


  <script src="Assets/js/tablaCompra.js"></script> 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>            

<?php require_once 'componentes/footer.php'; ?>





<script>

  
function confirmarEditar() {
    return confirm("¿Estás seguro de que deseas EDITAR este elemento?");
  }

    function confirmarGuardar() {
    return confirm("¿Estás seguro de que deseas Guardar este proveedor ?");
  }

  

</script>