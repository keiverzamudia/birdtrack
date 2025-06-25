<?php
require_once 'componentes/head.php';
require_once 'componentes/menu.php';
?>
  <div class="container-fluid">
  <?php if(isset($mensaje)) { ?>
    <div class="alert alert-info alert-dismissible fade show" role="alert">
      <?php echo $mensaje; ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php } ?>


 <div class="container-fluid">

  <div class="container-fluid">
    <div class="modal fade" id="Registrar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Registro de Mantenimiento</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <!-- formulario de registro a mantenimiento -->
          <div class="modal-body">
            <form method="POST">
              <div class="mb-4">
                <label for="nombre activo" class="form-label">Nombre De Activo</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
              </div>
              <div class="mb-4">
                <label for="id activo" class="form-label">ID De Activo</label>
                <input type="text" class="form-control" id="id_activo" name="id_activo" required>
              </div>
              <div class="mb-4">
                <label for="empleado responsable" class="form-label">Empleado Responsable</label>
                <input type="text" class="form-control" id="responsable" name="responsable">
              </div>
              <select class="form-select" name='tipo' id="tipo" aria-label="Default select example">
                <option selected>Selecione el Tipo de Mantenimiento</option>
                <option value="correctivo">Mantenimiento Correctivo</option>
                <option value="preventivo">Mantenimiento Preventivo</option>
                <option value="predictivo">Mantenimiento Predictivo</option>
              </select>
              <br><br>
              <select class="form-select" name='estado' id="estado" aria-label="Default select example">
                <option selected>Seleccione el Estado</option>
                <option value="Pendiente">Pendiente</option>
                <option value="En Proceso">En Proceso</option>
                <option value="Consolidado">Consolidado</option>
              </select>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success" name="enviar">Enviar a Mantenimiento</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>


  <div class="card">
      <div class="card-head">
        <h2 class="text-center">GESTION DE MANTENIMIENTO</h2>
      </div>
        
      <div class="card-body">
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Registrar">
      Enviar Activo a mantenimiento
     </button>
     <br>
     <br>
        <div class="table-responsive">
          <table class="table table-hover table-striped text-center table-bordered">
            <thead class="table-primary">
              <tr>
                <th>Id_MTTO</th>
                <th>Nombre Activo</th>
                <th>Id_Activo</th>
                <th>Empleado_Responsable</th>
                <th>Tipo_MTTO</th>
                <th>Estado_MTTO</th>
                <th>Fecha_Registro</th>
                <th>Acciones</th>

              </tr>
            </thead>
            <tbody>
              <form method="POST">
               <?php if (isset($mantenimientos)) {
              foreach ($mantenimientos as $mantenimiento) { ?>
                <tr>
                  <td> <?= $mantenimiento['ID_MTTO'] ?> </td>
                  <td> <?= $mantenimiento['Nombre_Activo'] ?> </td>
                  <td> <?= $mantenimiento['Id_Activo'] ?> </td>
                  <td> <?= $mantenimiento['Empleado_Responable'] ?> </td>
                  <td> <?= $mantenimiento['Tipo_MTTO'] ?> </td>
                  <td> <?= $mantenimiento['Estado_MTTO'] ?> </td>
                  <td> <?= $mantenimiento['Fecha_Registro'] ?> </td>

                  <td>
                      <button class="btn btn-success" type="button" data-bs-toggle="modal"
                      data-bs-target="#editar<?= $mantenimiento['ID_MTTO'] ?>" name="editar">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                          <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                          <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                        </svg>
                      </button>
                      
                             <!--BOTON DE MODAL DE ELIMINACION DE ALERTA  -->
                        <button class="btn btn-danger btnEliminar" title="Eliminar" type="button"
                          value="<?php echo $mantenimiento['ID_MTTO'] ?>" data-bs-toggle="modal" data-bs-target="#eliminar">
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
                <?php }}else{ ?>
                  <tr>
                    <td colspan="6"><h2>No hay registro de Mantenimientos</h2> </td>
                  </tr>
                <?php } ?>
              </form>
            </tbody>
          </table>
        </div>
      </div>
    </div>

              <!--modal de edicion-->
              <div class="modal fade" id="editar<?= $mantenimiento['ID_MTTO'] ?>" data-bs-backdrop="static"
                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="staticBackdropLabel">Registro de Mantenimiento</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- formulario de edicion a mantenimiento -->
                    <div class="modal-body">
                      <form method="POST">
                        <input type="hidden" name="id" value="<?= $mantenimiento['ID_MTTO'] ?>">
                        <div class="mb-4">
                          <label for="InputEmpleado" class="form-label">Empleado Responsable</label>
                          <input type="text" class="form-control" name='responsable' id="InputEmpleado"
                            aria-describedby="empleadoHelp" value="<?php echo $mantenimiento['Empleado_Responable']; ?>"
                            required>
                          <div id="empleadolHelp" class="form-text">Ingrese el Nombre del Responable del
                            Activo</div>
                        </div>
                        <select class="form-select" name='tipo' aria-label="Default select example">
                          <option selected><?php echo $mantenimiento['Tipo_MTTO']; ?></option>
                          <option value="correctivo">Mantenimiento Correctivo</option>
                          <option value="preventivo">Mantenimiento Preventivo</option>
                          <option value="predictivo">Mantenimiento Predictivo</option>
                        </select>
                        <br><br>
                        <select class="form-select" name='estado' aria-label="Default select example">
                          <option selected><?php echo $mantenimiento['Estado_MTTO']; ?></option>
                          <option value="Pendiente">Pendiente</option>
                          <option value="En Proceso">En Proceso</option>
                          <option value="Consolidado">Consolidado</option>
                        </select><br><br>

                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                          <button type="submit" class="btn btn-success p-2" data-bs-toggle="modal" title="Modificar"
                            name="modificar" value="<?php echo $mantenimiento['ID_MTTO'] ?>">Editar</button>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
              </form>
           <?php {}?>
        </tbody>
      </table>
    </div>
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
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <form method="POST">
          <button id="btnEliminarMantenimiento" name="eliminar" type="submit" class="btn btn-danger">Eliminar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>





  <?php 
  require_once "componentes/footer.php";
  ?>

  <script>
  $(document).ready(()=>{
    $(".btnEliminar").each((index, element)=>{
      $(element).on('click',(e)=>{
        $('#btnEliminarMantenimiento').val($(e.target).closest('tr').find('td:eq(0)').text())
        $('#nombreEliminacion').text($(e.target).closest('tr').find('td:eq(1)').text())
      })
    })
  });
</script>