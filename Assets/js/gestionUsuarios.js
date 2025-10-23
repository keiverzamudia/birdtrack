// Archivo JavaScript para manejar las operaciones AJAX del módulo de gestión de usuarios

$(document).ready(function() {
    // Configurar headers AJAX
    $.ajaxSetup({
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    });

    // Manejar envío de formulario de creación de usuario
    $('#formCrearUsuario').on('submit', function(e) {
        e.preventDefault();
        enviarFormulario(this, 'enviar');
    });

    // Manejar envío de formulario de edición de usuario
    $('.formEditarUsuario').on('submit', function(e) {
        e.preventDefault();
        enviarFormulario(this, 'editar');
    });

    // Manejar envío de formulario de creación de cargo
    $('#formCrearCargo').on('submit', function(e) {
        e.preventDefault();
        enviarFormulario(this, 'agregar_cargo');
    });

    // Manejar envío de formulario de edición de cargo
    $('.formEditarCargo').on('submit', function(e) {
        e.preventDefault();
        enviarFormulario(this, 'editar_cargo');
    });

    // Manejar envío de formulario de creación de departamento
    $('#formCrearDepartamento').on('submit', function(e) {
        e.preventDefault();
        enviarFormulario(this, 'agregar_departamento');
    });

    // Manejar envío de formulario de edición de departamento
    $('.formEditarDepartamento').on('submit', function(e) {
        e.preventDefault();
        enviarFormulario(this, 'editar_departamento');
    });

    // Manejar eliminación de usuario
    $('#btnEliminarUsuario').on('click', function(e) {
        e.preventDefault();
        const cedula = $(this).val();
        eliminarRegistro('eliminar', cedula);
    });

    // Manejar eliminación de cargo
    $('.btnEliminarCargo').on('click', function(e) {
        e.preventDefault();
        const idCargo = $(this).data('id');
        eliminarRegistro('eliminar_cargo', idCargo);
    });

    // Manejar eliminación de departamento
    $('.btnEliminarDepartamento').on('click', function(e) {
        e.preventDefault();
        const idDepartamento = $(this).data('id');
        eliminarRegistro('eliminar_departamento', idDepartamento);
    });

    // Función genérica para enviar formularios
    function enviarFormulario(form, accion) {
        const formData = new FormData(form);
        formData.append(accion, '1');
        
        $.ajax({
            url: 'index.php?url=gestionUsuarios',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    showAlert('success', response.message);
                    $('.modal').modal('hide');
                    // Limpiar formularios
                    form.reset();
                    // Recargar página para mostrar cambios
                    setTimeout(() => location.reload(), 1000);
                } else {
                    showAlert('danger', response.message);
                }
            },
            error: function(xhr, status, error) {
                showAlert('danger', 'Error en la comunicación con el servidor');
                console.error('Error:', error);
            }
        });
    }

    // Función para eliminar registros
    function eliminarRegistro(accion, id) {
        if (confirm('¿Está seguro que desea eliminar este registro?')) {
            $.ajax({
                url: 'index.php?url=gestionUsuarios',
                type: 'POST',
                data: {
                    [accion]: id
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        showAlert('success', response.message);
                        $('.modal').modal('hide');
                        setTimeout(() => location.reload(), 1000);
                    } else {
                        showAlert('danger', response.message);
                    }
                },
                error: function(xhr, status, error) {
                    showAlert('danger', 'Error en la comunicación con el servidor');
                    console.error('Error:', error);
                }
            });
        }
    }

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

    // Configurar botones de eliminar existentes (si los hay)
    $(".btnEliminar").each((index, element) => {
        $(element).on('click', (e) => {
            const cedula = $(e.target).closest('tr').find('td:eq(0)').text();
            $('#btnEliminarUsuario').val(cedula);
            $('#nombreEliminacion').text(cedula);
        });
    });

    // Validación de formularios
    $('form').on('submit', function(e) {
        const requiredFields = $(this).find('[required]');
        let isValid = true;
        
        requiredFields.each(function() {
            if ($(this).val().trim() === '') {
                $(this).addClass('is-invalid');
                isValid = false;
            } else {
                $(this).removeClass('is-invalid');
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            showAlert('warning', 'Por favor complete todos los campos requeridos');
        }
    });

    // Limpiar validación al escribir
    $('input, select, textarea').on('input change', function() {
        $(this).removeClass('is-invalid');
    });
});
