<?php
require_once 'componentes/head.php';
require_once 'componentes/menu.php';
?>
<div class="container-fluid">


  <?php if (isset($mensaje)) { ?>
    <?php echo $mensaje; ?>
    <script>
      alert(" <?php echo $mensaje; ?>")
    </script>
  <?php } ?>



  <?php if (isset($editar_usuario)) { ?>
    <div class="row text-center d-flex justify-content-center">
      <div class="col-md-6 card">
        <div class="card-header">
          <h1>Editar usuario</h1>
        </div>
        <div class="card-body">
          <form method="POST">
            <div class="modal-body d-flex flex-column gap-4">
              <input class="form-control" type="text" name="cedula" placeholder="cedula" value="<?php echo $editar_usuario['cedula_empleado'] ?>">
              <input class="form-control" type="text" name="nombre" placeholder="Nombre y apellido" value="<?php echo $editar_usuario['Nombre_Empleado'] ?>">
              <select class="form-control" name="cargo" id="">
                <option value="" selected hidden>seleccione el Departamento</option>
                <?php foreach ($departamentos as $departamento) { ?>
                  <option value="<?php echo $departamento['id_departamento'] ?>"> <?php echo $departamento['Nombre_Departamento'] ?></option>
                <?php } ?>
              </select>
              <select class="form-control" name="cargo" id="">
                <option value="" selected hidden>seleccione el cargo</option>
                <?php foreach ($cargos as $cargo) { ?>
                  <option value="<?php echo $cargo['id_cargo'] ?>"> <?php echo $cargo['Nombre_Cargo'] ?></option>
                <?php } ?>
              </select>
              <!-- <input class="form-control" type="text" name="cargo" placeholder="cargo" value="<?php echo $editar_usuario['id_cargo'] ?>">-->
              <input class="form-control" type="text" name="correo" placeholder="Correo" value="<?php echo $editar_usuario['correo_electronico'] ?>">

              <div class="d-flex gap-2">
                <button type="submit" class="btn btn-secondary">Cancelar</button>
                <button type="submit" class="btn btn-success" name="editar" value="<?php echo $editar_usuario['cedula_empleado'] ?>">Editar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

  <?php } else { ?>
    <br>
    <br>

    <div class="card">
      <div class="card-head">
        <h2 class="text-center">GESTION DE USUARIO</h2>
      </div>

      <div class="card-body">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#enviar_solicitud">
          Registrar Usuario
        </button>

        <button type="button" id="btnformulariocargos" class="btn btn-success my-2" data-bs-toggle="modal" data-bs-target="#formulario_cargo">
          cargos
        </button>

        <button type="button" id="btnformulariodepartamentos" class="btn btn-success my-2" data-bs-toggle="modal" data-bs-target="#formulario_departamento">
          departamentos
        </button>
        <br>
        <br>
        <div class="table-responsive">
          <table class="table table-hover table-striped text-center table-bordered">
            <thead class="table-primary">
              <tr>
                <th>Cedula</th>
                <th>Nombre</th>
                <th>Departamento</th>
                <th>Cargo</th>
                <th>Correo</th>
                <th>Fecha de creacion</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <form method="POST">
                <?php if (isset($usuarios)) {
                  foreach ($usuarios as $usuario) { ?>
                    <tr>
                      <td> <?php echo $usuario['cedula_empleado'] ?> </td>
                      <td> <?php echo $usuario['Nombre_Empleado'] ?> </td>
                      <td> <?php echo $usuario['Departamento'] ?> </td>
                      <td> <?php echo $usuario['Cargo'] ?> </td>
                      <td> <?php echo $usuario['correo_electronico'] ?> </td>
                      <td> <?php echo $usuario['Fecha_creacion'] ?> </td>

                      <td>
                        <button class="btn btn-success" title="editar" type="submit" name="seleccion" value="<?php echo $usuario['cedula_empleado'] ?>">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                          </svg>
                        </button>

                        <!--BOTON DE MODAL DE ELIMINACION DE ALERTA  -->
                        <button class="btn btn-danger btnEliminar" title="Eliminar" type="button"
                          value="<?php echo $usuario['cedula_empleado'] ?>" data-bs-toggle="modal" data-bs-target="#eliminar">
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
                    <td colspan="6">
                      <h2>No hay registro de usuarios</h2>
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

  <!-- Modal de registrar empleado-->
  <div class="modal fade" id="enviar_solicitud" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo usuario</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" enctype="multipart/form-data">

          <div class="modal-body d-flex flex-column gap-4">
            <input class="form-control" type="text" name="cedula" placeholder="cedula" required>
            <input class="form-control" type="text" name="nombre" placeholder="Nombre" required>


            <select class="form-control" name="departamento" id="depertamento">
              <option value="" selected hidden>seleccione un departamento</option>
              <?php foreach ($departamentos as $departamento) { ?>

                <option value="<?php echo $departamento['id_departamento'] ?>"> <?php echo $departamento['Nombre_Departamento'] ?></option>
              <?php } ?>
            </select>

            <select class="form-control" name="cargo" id="">
              <option value="" selected hidden>seleccione el cargo</option>
              <?php foreach ($cargos as $cargo) { ?>

                <option value="<?php echo $cargo['id_cargo'] ?>"> <?php echo $cargo['Nombre_Cargo'] ?></option>
              <?php } ?>
            </select>
            <input class="form-control" type="email" name="correo" placeholder="correo" required>
            <input class="form-control" type="file" name="foto" accept="image/*">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="enviar">Enviar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal para el crud pequeño de cargo -->
<div class="modal fade" id="formulario_cargo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Cargos</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body d-flex flex-column gap-4">
        <div class="row">
          <form method="POST">
            <hr>
            <h3 class="text-center">Agregar un nuevo cargo</h3>
            <div class="input-group">
              <input class="form-control" id="nombre_cargo" type="text" name="nombre_cargo" placeholder="Nombre del nuevo cargo" required>
              <button type="submit" id="btnCargo" name="agregar_cargo" class="btn btn-primary">Agregar</button>
            </div>
            <hr>
          </form>
        </div>
        <div class="table-responsive">
          <table class="table table-striped text-center table-bordered">
            <thead class="table-primary">
              <tr>
                <th>Id del cargo</th>
                <th>Nombre</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>

              <form method="POST">
                <?php if (isset($cargos)) {
                  foreach ($cargos as $cargo) { ?>
                    <tr>
                      <td> <?php echo $cargo['id_cargo'] ?> </td>
                      <td> <?php echo $cargo['Nombre_Cargo'] ?> </td>
                      <td>
                        <button type="button" class="btn btn-success btnEditarcargo" title="Editar" type="button"
                          value="<?php echo $cargo['id_cargo'] ?>">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path
                              d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                            <path fill-rule="evenodd"
                              d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                          </svg>

                        </button>
                        <button class="btn btn-danger" title="Eliminar" name="eliminar_cargo" type="submit" onclick="return confirm('Eliminar tipo de activo?') "
                          value="<?php echo $cargo['id_cargo'] ?>">
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
                    <td colspan="6">
                      <h2>No se registro el cargo correctamente :</h2>
                    </td>
                  </tr>
                <?php } ?>
              </form>
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CERRAR</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal para el crud pequeño de departamento -->
<div class="modal fade" id="formulario_departamento" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Departamentos</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body d-flex flex-column gap-4">
        <div class="row">
          <form method="POST">
            <hr>
            <h3 class="text-center">Agregar un nuevo departamento</h3>
            <div class="input-group">
              <input class="form-control" id="nombre_departamento" type="text" name="nombre_departamento" placeholder="Nombre del nuevo departamento" required>
              <input class="form-control" id="descripcion_departamento" type="text" name="descripcion_departamento" placeholder="descripcion del nuevo departamento" required>
              <button type="submit" id="btndepartamento" name="agregar_departamento" class="btn btn-primary">Agregar</button>
            </div>
            <hr>
          </form>
        </div>
        <div class="table-responsive">
          <table class="table table-striped text-center table-bordered">
            <thead class="table-primary">
              <tr>
                <th>Id del departamento</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>

              <form method="POST">
                <?php if (isset($departamentos)) {
                  foreach ($departamentos as $departamento) { ?>
                    <tr>
                      <td> <?php echo $departamento['id_departamento'] ?> </td>
                      <td> <?php echo $departamento['Nombre_Departamento'] ?> </td>
                      <td> <?php echo $departamento['Descripcion_Departamento'] ?> </td>
                      <td>
                        <button type="button" class="btn btn-success btnEditar_departamento" title="Editar" type="button"
                          value="<?php echo $departamento['id_departamento'] ?>">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path
                              d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                            <path fill-rule="evenodd"
                              d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                          </svg>

                        </button>
                        <button class="btn btn-danger" title="Eliminar" name="eliminar_departamento" type="submit" onclick="return confirm('Eliminar departamento?') "
                          value="<?php echo $departamento['id_departamento'] ?>">
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
                    <td colspan="6">
                      <h2>No se registro correctamente el departamento :</h2>
                    </td>
                  </tr>
                <?php } ?>
              </form>
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CERRAR</button>
      </div>
    </div>
  </div>
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
          <button id="btnEliminarEmpleado" name="eliminar" type="submit" class="btn btn-danger">Eliminar</button>
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

<?php if (isset($mensaje)) { ?>
  <?php echo $mensaje; ?>
  <script>
    alert(" <?php echo $mensaje; ?>")
  </script>
<?php } ?>


<script>
  // eliminar empleado
  $(document).ready(() => {
    $(".btnEliminar").each((index, element) => {
      $(element).on('click', (e) => {
        $('#btnEliminarEmpleado').val($(e.target).closest('tr').find('td:eq(0)').text())
        $('#nombreEliminacion').text($(e.target).closest('tr').find('td:eq(1)').text())
      })
    })
    //editar cargo
    $(".btnEditarcargo").each((index, element) => {
      $(element).on('click', (e) => {
        $('#nombre_cargo').val($(e.target).closest('tr').find('td:eq(1)').text())
        $('#btnCargo').val($(e.target).closest('tr').find('td:eq(0)').text().trim())
        $('#btnCargo').text('Editar')
        $('#btnCargo').prop('name', 'editar_cargo')
      })
    })

    $('#btnformulariocargos').on('click', (e) => {
      $('#nombre_cargo').val('')
      $('#btnCargo').val('')
      $('#btnCargo').text('Registrar')
      $('#btnCargo').prop('name', 'agregar_cargo')
    })

    //editar departamento
    $(".btnEditar_departamento").each((index, element) => {
      $(element).on('click', (e) => {
        $('#nombre_departamento').val($(e.target).closest('tr').find('td:eq(1)').text())
        $('#descripcion_departamento').val($(e.target).closest('tr').find('td:eq(2)').text())
        $('#btndepartamento').val($(e.target).closest('tr').find('td:eq(0)').text().trim())
        $('#btndepartamento').text('Editar')
        $('#btndepartamento').prop('name', 'editar_departamento')
      })
    })

    $('#btnformulario_departamento').on('click', (e) => {
      $('#nombre_departamento').val('')
      $('#descripcion_departamento').val('')
      $('#btndepartamento').val('')
      $('#btndepartamento').text('Registrar')
      $('#btndepartamento').prop('name', 'agregar_departamento')
    })
  });
</script>