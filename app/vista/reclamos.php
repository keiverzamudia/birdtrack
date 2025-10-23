<?php 
require_once 'componentes/head.php';
require_once 'componentes/menu.php';

// Obtener datos del usuario de la sesión
$usuario = $_SESSION["usuario"];
$nombre_usuario = $usuario['Nombre_Empleado'];
$cedula_empleado = $usuario['cedula_empleado'];
?>
<div class="container-fluid">

	<?php if (isset($mensaje)) { ?>
		<?php echo $mensaje; ?>
		<script>
			alert(" <?php echo $mensaje; ?>")
		</script>
	<?php } ?>

	<?php if (isset($editar_reclamo)) { ?>
		<div class="row text-center d-flex justify-content-center">
			<div class="col-md-6 card">
				<div class="card-header">
					<h1>Editar Reclamo</h1>
				</div>
				<div class="card-body">
					<form method="POST">
						<div class="modal-body d-flex flex-column gap-4">

							<select class="form-control" name="id_activo" required>
								<option value="" selected hidden>Seleccionar Activo</option>
								<?php foreach ($activos as $activo) { ?>
									<option value="<?php echo $activo['id_activo'] ?>" <?php echo ($activo['id_activo'] == $editar_reclamo['id_activo']) ? 'selected' : ''; ?>><?php echo $activo['Nombre_Activo'] ?></option>
								<?php } ?>
							</select>

							<select class="form-control" name="cedula_empleado" required>
								<option value="" selected hidden>Seleccionar Empleado</option>
								<?php foreach ($empleados as $empleado) { ?>
									<option value="<?php echo $empleado['cedula_empleado'] ?>" <?php echo ($empleado['cedula_empleado'] == $editar_reclamo['cedula_empleado']) ? 'selected' : ''; ?>><?php echo $empleado['Nombre_Empleado'] ?></option>
								<?php } ?>
							</select>


							<textarea class="form-control" name="descripcion" placeholder="Descripción del Reclamo" rows="4" required><?php echo $editar_reclamo['Descripcion'] ?></textarea>
							<input class="form-control" type="date" name="fecha_reclamo" placeholder="Fecha del reclamo"
								value="<?php echo $editar_reclamo['Fecha_reclamo'] ?>" required>

							<div class="d-flex gap-2">
								<button type="submit" class="btn btn-secondary">Cancelar</button>
								<button type="submit" class="btn btn-success" name="editar"
									value="<?php echo $editar_reclamo['id_reclamo'] ?>">Editar</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>

	<?php } else { ?>


		<div class="card mt-5">
			<div class="card-head">
				<h3 class="text-center">GESTIÓN DE RECLAMOS</h3>

				<!-- Indicador de estado de conexión -->
				<div class="d-flex justify-content-between align-items-center mb-3">
					<div class="d-flex gap-2">
						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formulario_reclamo">
							Registrar Reclamo
						</button>
						<button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#ver_activos_asignados">
							Ver Activos Asignados
						</button>
						<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ver_activos_disponibles">
							Ver Activos Disponibles
						</button>
					</div>

					<!-- Estado de conexión WebSocket -->
					<div class="d-flex align-items-center gap-2">
						<span id="estado-conexion" class="badge bg-secondary">Desconectado</span>
						<span class="badge bg-info">Usuario: <?php echo $nombre_usuario; ?></span>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-striped text-center table-bordered">
						<thead class="table-primary">
							<tr>
								<th>ID Reclamo</th>
								<th>Empleado</th>
								<th>Activo</th>
								<th>Descripción</th>
								<th>Fecha Reclamo</th>
								<th>Acciones</th>
							</tr>


						</thead>
						<tbody>
							<form method="POST">
								<?php if (isset($reclamos)) {
									foreach ($reclamos as $reclamo) { ?>
										<tr>
											<td> <?php echo $reclamo['id_reclamo'] ?> </td>
											<td> <?php echo $reclamo['Nombre_Empleado'] ?> </td>
											<td> <?php echo $reclamo['Nombre_Activo'] ?> </td>
											<td> <?php echo substr($reclamo['Descripcion'], 0, 50) . '...' ?> </td>
											<td> <?php echo $reclamo['Fecha_reclamo'] ?></td>

											<td>
												<button class="btn btn-success" title="editar" type="submit" name="seleccion"
													value="<?php echo $reclamo['id_reclamo'] ?>">
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
													value="<?php echo $reclamo['id_reclamo'] ?>" data-bs-toggle="modal" data-bs-target="#eliminar">
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
											<h2>No hay reclamos registrados</h2>
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

	<!-- Modal Registrar reclamo -->
	<div class="modal fade" id="formulario_reclamo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo Reclamo</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>


				<form id="reclamoForm" onsubmit="event.preventDefault(); enviarReclamo();">
					<div class="modal-body d-flex flex-column gap-4">

						<select class="form-control" id="id_activo_select" required>
							<option value="" selected hidden>Seleccionar Activo</option>
							<?php foreach ($activos as $activo) { ?>
								<option value="<?php echo $activo['id_activo'] ?>"><?php echo $activo['Nombre_Activo'] ?></option>
							<?php } ?>
						</select>

						<!-- Empleado predefinido por sesión -->
				<div class="alert alert-info">
							<strong>Empleado:</strong> <?php echo $nombre_usuario; ?> (<?php echo $cedula_empleado; ?>)
						</div>

						<textarea class="form-control" id="comment" placeholder="Descripción del Reclamo" rows="4" required></textarea>
						<input class="form-control" type="date" id="fecha_reclamo_input" placeholder="fecha_reclamo" required>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="limpiarModal()">CERRAR</button>
						<button type="submit" class="btn btn-primary">ENVIAR RECLAMO</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Modal Ver Activos Asignados -->
	<div class="modal fade" id="ver_activos_asignados" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="exampleModalLabel">Activos Asignados</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="table-responsive">
						<table class="table table-striped text-center table-bordered">
							<thead class="table-primary">
								<tr>
									<th>ID Activo</th>
									<th>Nombre</th>
									<th>Tipo</th>
									<th>Ubicación</th>
									<th>Empleado Asignado</th>
									<th>Fecha Asignación</th>
									<th>Estado</th>
								</tr>
							</thead>
							<tbody>
								<?php if (isset($activos_asignados)) {
									foreach ($activos_asignados as $activo) { ?>
										<tr>
											<td> <?php echo $activo['id_activo'] ?> </td>
											<td> <?php echo $activo['Nombre_Activo'] ?> </td>
											<td> <?php echo $activo['Tipo_Activo'] ?> </td>
											<td> <?php echo $activo['Ubicacion'] ?> </td>
											<td> <?php echo $activo['Empleado_Asignado'] ?> </td>
											<td> <?php echo $activo['Fecha_asignacion'] ?> </td>
											<td> <?php echo $activo['Estado_Activo'] ?> </td>
										</tr>
									<?php }
								} else { ?>
									<tr>
										<td colspan="7">
											<h2>No hay activos asignados</h2>
										</td>
									</tr>
								<?php } ?>
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

	<!-- Modal Ver Activos Disponibles -->
	<div class="modal fade" id="ver_activos_disponibles" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="exampleModalLabel">Activos Disponibles</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="table-responsive">
						<table class="table table-striped text-center table-bordered">
							<thead class="table-primary">
								<tr>
									<th>ID Activo</th>
									<th>Nombre</th>
									<th>Tipo</th>
									<th>Ubicación</th>
									<th>Estado</th>
									<th>Fecha Adquisición</th>
								</tr>
							</thead>
							<tbody>
								<?php if (isset($activos_disponibles)) {
									foreach ($activos_disponibles as $activo) { ?>
										<tr>
											<td> <?php echo $activo['id_activo'] ?> </td>
											<td> <?php echo $activo['Nombre_Activo'] ?> </td>
											<td> <?php echo $activo['Tipo_Activo'] ?> </td>
											<td> <?php echo $activo['Ubicacion'] ?> </td>
											<td> <?php echo $activo['Estado_Activo'] ?> </td>
											<td> <?php echo $activo['Fecha_adquisicion'] ?> </td>
										</tr>
									<?php }
								} else { ?>
									<tr>
										<td colspan="6">
											<h2>No hay activos disponibles</h2>
										</td>
									</tr>
								<?php } ?>
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
					¿Esta seguro que desea eliminar el reclamo <strong id="nombreEliminacion"></strong>?
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


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>



<?php
require_once 'componentes/footer.php';
?>

				<script>
	// Variables globales para WebSocket
	var ws;
					var nombreUsuario = '<?php echo $nombre_usuario; ?>';
					var cedulaEmpleado = '<?php echo $cedula_empleado; ?>';
					
	// Conectar WebSocket al cargar la página
	$(document).ready(function() {
		conectarWebSocket();

		// Configurar fecha actual por defecto
		var fechaActual = new Date().toISOString().split('T')[0];
		$('#fecha_reclamo_input').val(fechaActual);

		// Event listeners para botones
		$(".btnEliminar").each((index, element) => {
			$(element).on('click', (e) => {
				$('#btnEliminarRegistro').val($(e.target).closest('tr').find('td:eq(0)').text())
				$('#nombreEliminacion').text($(e.target).closest('tr').find('td:eq(0)').text())
			})
		})

		// Limpiar modal cuando se cierre
		$('#formulario_reclamo').on('hidden.bs.modal', function() {
			$(this).find('form')[0].reset();
			$('#fecha_reclamo_input').val(new Date().toISOString().split('T')[0]);
			limpiarModal();
		});
	});

	// Función para conectar WebSocket
	function conectarWebSocket() {
		try {
			ws = new WebSocket("ws://localhost:8080");

			ws.onopen = function(event) {
				console.log("Conectado al servidor WebSocket");
				$('#estado-conexion').removeClass('bg-secondary bg-danger').addClass('bg-success').text('Conectado');
			};

			ws.onmessage = function(event) {
				var data = JSON.parse(event.data);

				if (data.type === 'notification') {
					actualizarNotificaciones(data);
				}
			};

			ws.onclose = function(event) {
				console.log("Conexión WebSocket cerrada");
				$('#estado-conexion').removeClass('bg-success bg-secondary').addClass('bg-danger').text('Desconectado');
				// Intentar reconectar después de 3 segundos
				setTimeout(conectarWebSocket, 3000);
			};

			ws.onerror = function(error) {
				console.log("Error en WebSocket:", error);
				$('#estado-conexion').removeClass('bg-success bg-secondary').addClass('bg-danger').text('Error');
			};

		} catch (error) {
			console.log("Error al conectar WebSocket:", error);
		}
	}

	// Función para limpiar modal completamente
	function limpiarModal() {
		$('.modal-backdrop').remove();
		$('body').removeClass('modal-open');
		$('body').css('padding-right', '');
		$('body').css('overflow', '');
	}

	// Función para enviar reclamo via WebSocket
	function enviarReclamo() {
		var idActivo = $('#id_activo_select').val();
		var descripcion = $('#comment').val();
		var fechaReclamo = $('#fecha_reclamo_input').val();
		
		if (!idActivo || !descripcion || !fechaReclamo) {
			mostrarNotificacion("Por favor complete todos los campos", "warning");
			return;
		}
		
		if (ws && ws.readyState === WebSocket.OPEN) {
							var data = {
				type: "new_reclamo",
				cedula_empleado: cedulaEmpleado,
				id_activo: idActivo,
				descripcion: descripcion,
				fecha_reclamo: fechaReclamo
							};

							ws.send(JSON.stringify(data));

			// Limpiar formulario
			$('#reclamoForm')[0].reset();
			$('#fecha_reclamo_input').val(new Date().toISOString().split('T')[0]);
			
			// Cerrar modal y limpiar backdrop
			$('#formulario_reclamo').modal('hide');
			
			// Usar setTimeout para asegurar que el modal se cierre completamente
			setTimeout(function() {
				limpiarModal();
			}, 300);

						} else {
			mostrarNotificacion("No hay conexión con el servidor. Intente nuevamente.", "danger");
		}
	}


	// Función para actualizar notificaciones
	function actualizarNotificaciones(data) {
		if (data.notifications && data.notifications.length > 0) {
			// Actualizar contador de no leídos si existe
			if (data.unread_count !== undefined) {
				actualizarContadorNoLeidos(data.unread_count);
			}
		}
	}

	// Función para mostrar notificaciones
	function mostrarNotificacion(mensaje, tipo) {
		var alertClass = 'alert-' + tipo;
		var notificacion = '<div class="alert ' + alertClass + ' alert-dismissible fade show" role="alert">' +
			'<strong>Notificación:</strong> ' + mensaje +
			'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
			'</div>';

		// Insertar al inicio del container
		$('.container-fluid').prepend(notificacion);

		// Auto-remover después de 5 segundos
		setTimeout(function() {
			$('.alert').first().fadeOut();
		}, 5000);
	}

	// Función para actualizar contador de no leídos
	function actualizarContadorNoLeidos(count) {
		// Si existe un badge de notificaciones, actualizarlo
		var badge = $('.badge-notificaciones');
		if (badge.length > 0) {
			badge.text(count);
			badge.show();
		}
	}

	// Función para marcar notificación como leída
	function marcarComoLeido(idReclamo) {
		if (ws && ws.readyState === WebSocket.OPEN) {
			var data = {
				type: "mark_as_read",
				id_reclamo: idReclamo
			};
			ws.send(JSON.stringify(data));
		}
	}

	// Función de emergencia para limpiar modal (disponible globalmente)
	window.limpiarModalEmergencia = function() {
		$('.modal').modal('hide');
		$('.modal-backdrop').remove();
		$('body').removeClass('modal-open');
		$('body').css('padding-right', '');
		$('body').css('overflow', '');
		console.log('Modal de emergencia limpiado');
	};

	// Cerrar WebSocket al salir de la página
	window.addEventListener('beforeunload', function() {
		if (ws) {
			ws.close();
		}
	});
				</script>