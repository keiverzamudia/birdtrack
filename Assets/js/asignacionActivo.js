// Archivo JavaScript para manejar las operaciones AJAX del módulo de asignación de activos

$(document).ready(function() {
    // Configurar CSRF token si es necesario
    $.ajaxSetup({
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    });

    // Manejar envío de formulario de creación
    $('#formCrearAsignacion').on('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        formData.append('enviar', '1');
        
        $.ajax({
            url: 'index.php?url=asignacionActivo',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    showAlert('success', response.message);
                    $('#enviar_solicitud').modal('hide');
                    location.reload(); // Recargar para mostrar los nuevos datos
                } else {
                    showAlert('danger', response.message);
                }
            },
            error: function(xhr, status, error) {
                showAlert('danger', 'Error en la comunicación con el servidor');
                console.error('Error:', error);
            }
        });
    });

    // Manejar envío de formulario de edición
    $('.formEditarAsignacion').on('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const idAsignacion = $(this).find('button[name="editar"]').val();
        formData.append('editar', idAsignacion);
        
        $.ajax({
            url: 'index.php?url=asignacionActivo',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    showAlert('success', response.message);
                    $('.modal').modal('hide');
                    location.reload(); // Recargar para mostrar los datos actualizados
                } else {
                    showAlert('danger', response.message);
                }
            },
            error: function(xhr, status, error) {
                showAlert('danger', 'Error en la comunicación con el servidor');
                console.error('Error:', error);
            }
        });
    });

    // Manejar eliminación
    $('#btnEliminarSolicitud').on('click', function(e) {
        e.preventDefault();
        
        const idAsignacion = $(this).val();
        
        $.ajax({
            url: 'index.php?url=asignacionActivo',
            type: 'POST',
            data: {
                eliminar: idAsignacion
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    showAlert('success', response.message);
                    $('#eliminar').modal('hide');
                    location.reload(); // Recargar para mostrar los datos actualizados
                } else {
                    showAlert('danger', response.message);
                }
            },
            error: function(xhr, status, error) {
                showAlert('danger', 'Error en la comunicación con el servidor');
                console.error('Error:', error);
            }
        });
    });

    // Función para mostrar alertas
    function showAlert(type, message) {
        const alertHtml = `
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
        
        // Remover alertas existentes
        $('.alert').remove();
        
        // Insertar nueva alerta al inicio del contenedor
        $('.container-fluid').prepend(alertHtml);
        
        // Auto-ocultar después de 5 segundos
        setTimeout(function() {
            $('.alert').fadeOut();
        }, 5000);
    }

    // Configurar botones de eliminar existentes
    $(".btnEliminar").each((index, element) => {
        $(element).on('click', (e) => {
            $('#btnEliminarSolicitud').val($(e.target).closest('tr').find('td:eq(0)').text());
            $('#nombreEliminacion').text($(e.target).closest('tr').find('td:eq(0)').text());
        });
    });
});
