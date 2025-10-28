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

  <?php if (isset($editar_activo)) { ?>
    <div class="row text-center d-flex justify-content-center">
      <div class="col-md-6 card">
        <div class="card-header">
          <h1>Editar Activo</h1>
        </div>
        <div class="card-body">
          <form id="formEditarTipoActivo" method="POST">
            <div class="modal-body d-flex flex-column gap-4">

              <div>
                <select class="form-control" id="id_activoEdit" name="id_tipo_activo" required>
                  <option value="" selected hidden>Seleccionar Tipo de Activo</option>
                  <?php foreach ($tipos_activos as $tipo) { ?>
                    <option value="<?php echo $tipo['id_tipo_activo'] ?>"><?php echo $tipo['Nombre'] ?></option>
                  <?php } ?>
                </select>
                <div class="invalid-feedback">Por Favor Seleccione el Tipo de Activo</div>
              </div>

              <div>
                <select class="form-control" id="id_ubicacionEdit" name="id_ubicacion" required>
                  <option value="" selected hidden>Seleccionar ubicacion</option>
                  <?php foreach ($id_ubicacion as $ubicacion) { ?>
                    <option value="<?php echo $ubicacion['id_ubicacion'] ?>"><?php echo $ubicacion['nombre'] ?></option>
                  <?php } ?>
                </select>
                <div class="invalid-feedback">Por Favor Seleccione la Ubicación del Activo</div>
              </div>


              <div>
                <input class="form-control" type="text" id="NombreEdit" name="Nombre" placeholder="Nombre del Activo "
                  value="<?php echo $editar_activo['Nombre_Activo'] ?>">
                <div class="invalid-feedback">Por Favor Ingrese el Nombre del Activo</div>
              </div>

              <div>
                <input class="form-control" type="text" id="DescripcionEdit" name="Descripcion"
                  placeholder="Descripcion del Activo con Caracteristica"
                  value="<?php echo $editar_activo['Descripcion_Activo'] ?>">
                <div class="invalid-feedback">Por Favor Ingrese una Descripcion Valida</div>
              </div>

              <div>
                <input class="form-control" type="date" id="fechaEdit" name="Fecha_adquisicion"
                  placeholder="Fecha de registro" value="<?php echo $editar_activo['Fecha_adquisicion'] ?>">
                <div class="invalid-feedback">Por Favor Seleccione la Fecha Actual</div>
              </div>


              <div class="d-flex gap-2">
                <button type="button" onclick="window.location.href='?url=gestionActivos'"
                  class="btn btn-secondary">Cancelar</button>
                <button type="submit" class="btn btn-success" name="editar"
                  value="<?php echo $editar_activo['id_activo'] ?>">Editar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

  <?php } else { ?>


    <div class="card mt-5">
      <div class="card-head">
        <h3 class="text-center">GESTION DE ACTIVOS</h3>
        <button type="button" class="btn btn-primary my-2" data-bs-toggle="modal" data-bs-target="#formulario_activo">
          Registrar activo
        </button>
        <button type="button" id="btnformularioTipoActivo" class="btn btn-success my-2" data-bs-toggle="modal"
          data-bs-target="#formulario_tipo_activo">
          Tipo de Activo
        </button>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped text-center table-bordered">
            <thead class="table-primary">
              <tr>
                <th>Id de activo</th>
                <th>Tipo</th>
                <th>Ubicación</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Fecha adquisición</th>
                <th>Acciones</th>
              </tr>


            </thead>
            <tbody>
              <form method="POST">
                <?php if (isset($activos)) {
                  foreach ($activos as $item) { ?>
                    <tr>
                      <td> <?php echo $item['id_activo'] ?> </td>
                      <td> <?php echo $item['tipo'] ?> </td>
                      <td> <?php echo $item['ubicacion'] ?> </td>
                      <td> <?php echo $item['Nombre_Activo'] ?> </td>
                      <td> <?php echo $item['Descripcion_Activo'] ?> </td>
                      <td> <?php echo $item['Estado_Activo'] ?> </td>
                      <td> <?php echo $item['Fecha_adquisicion'] ?></td>

                      <td>
                        <button class="btn btn-success" title="editar" type="submit" name="seleccion"
                          value="<?php echo $item['id_activo'] ?>">
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
                          value="<?php echo $item['id_activo'] ?>" data-bs-toggle="modal" data-bs-target="#eliminar">
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
                  <?php }
                } else { ?>
                  <tr>
                    <td colspan="6">
                      <h2>No se registro correctamente el activo :</h2>
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

  <!-- Modal Registrar activo -->
  <div class="modal fade" id="formulario_activo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo Registro</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>


        <form id="formRegistrarActivo" method="POST">
          <div class="modal-body d-flex flex-column gap-4">

            <div class="mb-4">
              <select class="form-control" id="id_tipo_activo" name="id_tipo_activo" required>
                <option value="" selected hidden>Seleccionar Tipo de Activo</option>
                <?php foreach ($tipos_activos as $tipo) { ?>
                  <option value="<?php echo $tipo['id_tipo_activo'] ?>"><?php echo $tipo['Nombre'] ?></option>
                <?php } ?>
              </select>
              <div class="invalid-feedback">Por Favor Seleccione un Activo</div>
            </div>

            <div>
              <select class="form-control" id="id_ubicacion" name="id_ubicacion" required>
                <option value="" selected hidden>Selecciona ubicacion</option>
                <?php foreach ($id_ubicacion as $ubicacion) { ?>
                  <option value="<?php echo $ubicacion['id_ubicacion'] ?>"><?php echo $ubicacion['nombre'] ?></option>
                <?php } ?>
              </select>
              <div class="invalid-feedback">Por Favor Seleccione la Ubicación del Activo</div>
            </div>

            <div>
              <input class="form-control" type="text" id="Nombre" name="Nombre" placeholder="Nombre del Activo"
                required>
              <div class="invalid-feedback">Este Campo Solo Admite Letras, Por Favor Ingrese el Nombre del Activo</div>
            </div>

            <div>
              <input class="form-control" type="text" id="Descripcion" name="Descripcion"
                placeholder="Descripcion del Activo con Caracteristica" required>
              <div class="invalid-feedback">Ingrese una Descripcion Valida</div>
            </div>

            <div>
              <input class="form-control" type="date" id="Fecha" name="Fecha_adquisicion"
                placeholder="fecha_adquisicion" required>
              <div class="invalid-feedback">Por Favor Seleccione la Fecha Actual</div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CERRAR</button>
            <button type="submit" class="btn btn-primary" name="enviar">REGISTRAR</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Tipo de Activo -->
  <div class="modal fade" id="formulario_tipo_activo" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tipos de Activos</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body d-flex flex-column gap-4">
          <div class="row">
            <form id="formEditarTipoActivo" method="POST">
              <hr>
              <h3 class="text-center">Registrar nuevo tipo de activo</h3>
              <div class="input-group">
                <div class="mb-4">
                  <input class="form-control" id="nombre_tipo_activo" type="text" name="nombre_tipo_activo"
                    placeholder="Nombre del tipo de activo" required>
                  <div class="invalid-feedback">Ingrese el Nombre del Tipo de Activo Correctamente</div>
                </div>

                <div class="mb-4">
                  <input class="form-control" id="descripcion_tipo_activo" type="text" name="descripcion_tipo_activo"
                    placeholder="Descripcion del tipo de activo" required>
                  <div class="invalid-feedback">Ingrese una Descripcion Valida</div>
                </div>
                <div class="mb-4">
                  <button type="submit" id="btnTipoActivo" name="agregar_tipo_activo"
                    class="btn btn-primary">Registrar</button>
                </div>
              </div>
              <hr>
            </form>
          </div>
          <div class="table-responsive">
            <table class="table table-striped text-center table-bordered">
              <thead class="table-primary">
                <tr>
                  <th>Id tipo activo</th>
                  <th>Nombre</th>
                  <th>Descripcion</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>

                <form method="POST">
                  <?php if (isset($tipos_activos)) {
                    foreach ($tipos_activos as $tipo) { ?>
                      <tr>
                        <td> <?php echo $tipo['id_tipo_activo'] ?> </td>
                        <td> <?php echo $tipo['Nombre'] ?> </td>
                        <td> <?php echo $tipo['Descripcion_tipo'] ?> </td>
                        <td>
                          <button type="button" class="btn btn-success btnEditarTipoActivo" title="Editar" type="button"
                            value="<?php echo $tipo['id_tipo_activo'] ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                              class="bi bi-pencil-square" viewBox="0 0 16 16">
                              <path
                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                              <path fill-rule="evenodd"
                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                            </svg>

                          </button>
                          <button class="btn btn-danger" title="Eliminar" name="eliminar_tipo_activo" type="submit"
                            onclick="return confirm('Eliminar tipo de activo?') "
                            value="<?php echo $tipo['id_tipo_activo'] ?>">
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
                    <?php }
                  } else { ?>
                    <tr>
                      <td colspan="6">
                        <h2>No se registro correctamente el activo :</h2>
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

  <!-- FINAL -->
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
          <button id="btnEliminarRegistro" name="eliminar" type="submit" class="btn btn-danger">Eliminar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script type="module" src="Assets/js/validaciones/gestionActivos.js"></script>




<?php
require_once 'componentes/footer.php';
?>

<script>
  $(document).ready(() => {
    $(".btnEliminar").each((index, element) => {
      $(element).on('click', (e) => {
        $('#btnEliminarRegistro').val($(e.target).closest('tr').find('td:eq(0)').text()) //encuentra la fila de la tabla donde se hizo clic.
        $('#nombreEliminacion').text($(e.target).closest('tr').find('td:eq(1)').text()) //Dentro de esa fila, busca la segunda celda (<td>) (índice 1).
      })
    })


    $(".btnEditarTipoActivo").each((index, element) => {
      $(element).on('click', (e) => {
        $('#nombre_tipo_activo').val($(e.target).closest('tr').find('td:eq(1)').text())
        $('#descripcion_tipo_activo').val($(e.target).closest('tr').find('td:eq(2)').text())

        $('#btnTipoActivo').val($(e.target).closest('tr').find('td:eq(0)').text().trim())
        $('#btnTipoActivo').text('Editar')
        $('#btnTipoActivo').prop('name', 'editar_tipo_activo')
      })
    })

    $('#btnformularioTipoActivo').on('click', (e) => {
      $('#nombre_tipo_activo').val('')
      $('#btnTipoActivo').val('')
      $('#btnTipoActivo').text('Registrar')
      $('#btnTipoActivo').prop('name', 'agregar_tipo_activo')
    })

  });
</script>