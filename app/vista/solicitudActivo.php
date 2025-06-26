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

  <?php if(isset($editar_solicitud)){ ?>
    <div class="row text-center d-flex justify-content-center">
      <div class="col-md-6 card">
        <div class="card-header">
          <h1>Editar Solicitud</h1>
        </div>
        <div class="card-body">
          <form method="POST">
            <div class="modal-body d-flex flex-column gap-4">
              <input class="form-control" type="text" name="ID_Activo" placeholder="ID_Activo" value="<?php echo $editar_solicitud['ID_Activo']?>">
              <input class="form-control" type="text" name="Nombre_Activo" placeholder="Nombre del Activo con Caracteristica" value="<?php echo $editar_solicitud['Nombre_Activo']?>">
              <textarea class="form-control" name="Estado" placeholder="Estado del Activo"><?php echo $editar_solicitud['Estado']?></textarea>
              <input class="form-control" type="text" name="Nombre_Usuario" placeholder="Nombre del Usuario Asignado" value="<?php echo $editar_solicitud['Nombre_Usuario']?>">
              <input class="form-control" type="text" name="Cedula" placeholder="Cédula" value="<?php echo $editar_solicitud['Cedula']?>">
              <div class="d-flex gap-2">
                <button type="submit" class="btn btn-secondary">Cancelar</button>
                <button type="submit" class="btn btn-success" name="editar" value="<?php echo $editar_solicitud['Id_orden']?>">Editar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <?php }else{ ?>
      
      <div class="card">
        <div class="card-head">
          <h1 class="text-center">Centro de Solicitud de Activos</h1>
        </div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#enviar_solicitud">
          Nueva Solicitud
        </button>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover table-striped text-center table-bordered">
            <thead class="table-primary">
              <tr>
              <th>Id_orden</th>
                <th>ID_Activo</th>
                <th>Nombre del Activo</th>
                <th>Estado</th>
                <th>Nombre del Usuario</th>
                <th>Cedula</th>
                <th>Fecha de Solicitud</th>
                <th>Acciones</th>

              </tr>
            </thead>
            <tbody>
              <form method="POST">
                <?php if(isset($solicitud)) { foreach ($solicitud as $item) { ?>
                  <tr>
                  <td> <?php echo $item['Id_orden'] ?> </td>
                    <td> <?php echo $item['ID_Activo'] ?> </td>
                    <td> <?php echo $item['Nombre_Activo'] ?> </td>
                    <td> <?php echo $item['Estado'] ?> </td>
                    <td> <?php echo $item['Nombre_Usuario'] ?> </td>
                    <td> <?php echo $item['Cedula'] ?> </td>
                    <td> <?php echo $item['Fecha_de_Asignacion'] ?> </td>

                    <td>
                      <button class="btn btn-success" title="editar" type="submit" name="seleccion" value="<?php echo $item['Id_orden'] ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                          <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                          <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                        </svg>
                      </button>
                <!--BOTON DE MODAL DE ELIMINACION DE ALERTA  -->
                <button class="btn btn-danger btnEliminar" title="Eliminar" type="button"
                          value="<?php echo $item['Id_orden'] ?>" data-bs-toggle="modal" data-bs-target="#eliminar">
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

  <!-- Modal -->
  <div class="modal fade" id="enviar_solicitud" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Nueva Solicitud</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST">
          <div class="modal-body d-flex flex-column gap-4">
            <input class="form-control" type="text" name="ID_Activo" placeholder="ID del Activo" required>
            <input class="form-control" type="text" name="Nombre_Activo" placeholder="Nombre del Activo" required>
            <input class="form-control" type="text" name="Nombre_Usuario" placeholder="Nombre del Usuario" required>
            <input class="form-control" type="text" name="Cedula" placeholder="Cédula" required>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="enviar">Enviar</button>
          </div>
        </form>
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

<script>
  $(document).ready(()=>{
    $(".btnEliminar").each((index, element)=>{
      $(element).on('click',(e)=>{
        $('#btnEliminarSolicitud').val($(e.target).closest('tr').find('td:eq(0)').text()) //encuentra la fila de la tabla donde se hizo clic.
        $('#nombreEliminacion').text($(e.target).closest('tr').find('td:eq(0)').text()) //Dentro de esa fila, busca la segunda celda (<td>) (índice 1).
      })
    })
  });
</script>