<?php
require_once 'componentes/head.php';
require_once 'componentes/menu.php';
?>
<div class="container-fluid">
  <?php if (isset($mensaje)) { ?>
    <div class="alert alert-info alert-dismissible fade show" role="alert">
      <?php echo $mensaje; ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php } ?>

  <div class="card">
    <div class="card-head">
      <h1 class="text-center">Centro de Asignacion de Activos</h1>
    </div>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#enviar_solicitud">
      Crear Nueva Asignacion de Activos
    </button>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover table-striped text-center table-bordered">
          <thead class="table-primary">
            <tr>
              <th>Numero Asignado</th>
              <th>Codigo - Nombre Activo</th>
              <th>Activo Asignacion a:</th>
              <th>Descripcion Asignacion</th>
              <th>Fecha de Asignacion</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <form method="POST">
              <?php if (isset($asignaciones) && !empty($asignaciones)) {
                foreach ($asignaciones as $asignacion) { ?>
                  <tr>
                    <td> <?php echo $asignacion['id_asignacion'] ?> </td>
                    <td> <?php echo $asignacion['id_activo'] . ' - ' . $asignacion['Nombre_Activo']; ?> </td>
                    <td> <?php echo $asignacion['Nombre_Empleado']; ?> </td>
                    <td> <?php echo $asignacion['Descripcion_Asignacion'] ?> </td>
                    <td> <?php echo $asignacion['Fecha_asignacion'] ?> </td>

                    <td>
                      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editar<?php echo $asignacion['id_asignacion'] ?>" name="editar">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                          <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                          <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                        </svg>
                      </button>
                      <button class="btn btn-danger btnEliminar" title="Eliminar" type="button"
                        value="<?php echo $asignacion['id_asignacion'] ?>" data-bs-toggle="modal" data-bs-target="#eliminar">
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

                  <!-- Modal para editar asignación -->
                  <div class="modal fade" id="editar<?php echo $asignacion['id_asignacion'] ?>" tabindex="-1" aria-labelledby="editModalLabel<?php echo $asignacion['id_asignacion'] ?>" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="editModalLabel<?php echo $asignacion['id_asignacion'] ?>">Editar Activo Asignado N°-<?php echo $asignacion['id_asignacion'] ?></h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST" class="formEditarAsignacion">
                          <div class="modal-body d-flex flex-column gap-4">
                            <select class="form-select mb-3" name="id_activo" id="id_activo_edit<?php echo $asignacion['id_asignacion'] ?>" aria-label="Default select example">
                              <option disabled>Seleccione el Activo</option>
                              <?php
                              foreach ($activos as $activo_option) {
                                $selected = ($activo_option['id_activo'] == $asignacion['id_activo']) ? 'selected' : '';
                                echo "<option value='" . $activo_option['id_activo'] . "' " . $selected . ">"
                                  . $activo_option['id_activo'] . " - " . $activo_option['Nombre_Activo'] . "</option>";
                              } ?>
                            </select>

                            <select class="form-select mb-3" name="cedula_empleado" id="cedula_empleado_edit<?php echo $asignacion['id_asignacion'] ?>" aria-label="Default select example">
                              <option disabled>Seleccione el Empleado</option>
                              <?php
                              foreach ($usuarios as $usuario_option) {
                                $selected = ($usuario_option['cedula_empleado'] == $asignacion['cedula_empleado']) ? 'selected' : '';
                                echo "<option value='" . $usuario_option['cedula_empleado'] . "' " . $selected . ">"
                                  . $usuario_option['cedula_empleado'] . " - " . $usuario_option['Nombre_Empleado'] . "</option>";
                              } ?>
                            </select>

                            <input class="form-control" type="text" name="Descripcion_Asignacion"
                              value="<?php echo htmlspecialchars($asignacion['Descripcion_Asignacion']) ?>" required>
                            <input class="form-control" type="date" name="Fecha_asignacion"
                              value="<?php echo $asignacion['Fecha_asignacion'] ?>" required>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary" value="<?php echo $asignacion['id_asignacion'] ?>" name="editar">Editar Activo</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                <?php } // Cierre del foreach
              } else { ?>
                <tr>
                  <td colspan="6">
                    <h2>No se registró correctamente el activo:</h2>
                  </td>
                </tr>
              <?php } ?>
            </form>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="modal fade" id="enviar_solicitud" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Nueva Asignacion de Activos</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" id="formCrearAsignacion">
          <div class="modal-body d-flex flex-column gap-4">
            <select class="form-select mb-3" name="id_activo" id="id_activo_create" aria-label="Default select example">
              <option selected disabled>Seleccione el Activo</option>
              <?php
              foreach ($activos as $activo) {
                echo "<option value='" . $activo['id_activo'] . "'>"
                  . $activo['id_activo'] . " - " . $activo['Nombre_Activo'] . "</option>";
              } ?>
            </select>
            <select class="form-select mb-3" name="cedula_empleado" id="cedula_empleado_create" aria-label="Default select example">
              <option selected disabled>Seleccione el Empleado</option>
              <?php
              foreach ($usuarios as $usuario) {
                echo "<option value='" . $usuario['cedula_empleado'] . "'>"
                  . $usuario['cedula_empleado'] . " - " . $usuario['Nombre_Empleado'] . "</option>";
              } ?>
            </select>
            <input class="form-control" type="text" name="Descripcion_Asignacion" placeholder="Describe El estado del Activo" required>
            <input class="form-control" type="date" name="Fecha_asignacion" placeholder="Fecha_asignacion" required>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary" name="enviar">Enviar</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  
  <div class="modal fade" id="eliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmar eliminación</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <span class="fs-5">
            ¿Está seguro que desea eliminar El Activo Asignado N° <strong id="nombreEliminacion"></strong>?
          </span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <form method="POST">
            <button id="btnEliminarSolicitud" name="eliminar" type="submit" class="btn btn-danger">Eliminar</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

  <?php
  require_once 'componentes/footer.php';
  ?>

  <!-- Incluir jQuery si no está incluido -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Incluir el archivo JavaScript para AJAX -->
  <script src="Assets/js/asignacionActivo.js"></script>