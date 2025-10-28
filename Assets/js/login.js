$(document).ready(function() {
    // Expresiones regulares
    const regexUsuario = /^[a-zA-Z0-9_]{4,20}$/;
    const regexClave = /^.{6,}$/;

    // Elementos del formulario
    const $formulario = $('#formulario');
    const $usuario = $('#usuario');
    const $clave = $('#clave');
    const $advUsuario = $('#advUsuario');
    const $advContrasena = $('#advContrasena');
    const $btnLogin = $('button[name="login"]');

    // Mensajes de error
    const mensajesError = {
        usuario: {
            requerido: 'El usuario es obligatorio',
            formato: 'El usuario debe tener entre 4 y 20 caracteres (solo letras, números y _)',
            vacio: 'Por favor ingresa tu usuario'
        },
        clave: {
            requerido: 'La contraseña es obligatoria',
            formato: 'La contraseña debe tener al menos 6 caracteres',
            vacio: 'Por favor ingresa tu contraseña'
        }
    };

    // Función para mostrar errores
    function mostrarError($elemento, $advElemento, mensaje) {
        $elemento.addClass('input-error');
        $elemento.removeClass('input-success');
        $advElemento.text(mensaje).addClass('error-message');
    }

    // Función para mostrar éxito
    function mostrarExito($elemento, $advElemento) {
        $elemento.removeClass('input-error');
        $elemento.addClass('input-success');
        $advElemento.text('').removeClass('error-message');
    }

    // Función para validar usuario
    function validarUsuario() {
        const valor = $usuario.val().trim();
        
        if (valor === '') {
            mostrarError($usuario, $advUsuario, mensajesError.usuario.vacio);
            return false;
        }
        
        if (!regexUsuario.test(valor)) {
            mostrarError($usuario, $advUsuario, mensajesError.usuario.formato);
            return false;
        }
        
        mostrarExito($usuario, $advUsuario);
        return true;
    }

    // Función para validar contraseña
    function validarClave() {
        const valor = $clave.val();
        
        if (valor === '') {
            mostrarError($clave, $advContrasena, mensajesError.clave.vacio);
            return false;
        }
        
        if (!regexClave.test(valor)) {
            mostrarError($clave, $advContrasena, mensajesError.clave.formato);
            return false;
        }
        
        mostrarExito($clave, $advContrasena);
        return true;
    }

    // Función para redirigir al inicio
    function redirigirAlInicio() {
        // Cambia esta URL por la ruta de tu página de inicio
        const urlInicio = '?url=inicio'; // o 'dashboard.php', 'index.php', etc.
        
        // Mostrar mensaje de éxito antes de redirigir
        $btnLogin.html(`
            <i class="fas fa-check"></i>
            ¡Acceso concedido!
        `).addClass('btn-success');
        
        // Redirigir después de 1.5 segundos
        setTimeout(() => {
            window.location.href = urlInicio;
        }, 1500);
    }

    // Validación en tiempo real
    $usuario.on('input', function() {
        const valor = $(this).val().trim();
        if (valor === '') {
            mostrarError($usuario, $advUsuario, mensajesError.usuario.vacio);
        } else {
            validarUsuario();
        }
    });

    $clave.on('input', function() {
        const valor = $(this).val();
        if (valor === '') {
            mostrarError($clave, $advContrasena, mensajesError.clave.vacio);
        } else {
            validarClave();
        }
    });

    // Validación al perder el foco
    $usuario.on('blur', validarUsuario);
    $clave.on('blur', validarClave);

    // Validación antes del envío
    $formulario.on('submit', function(e) {
        e.preventDefault();
        
        const esUsuarioValido = validarUsuario();
        const esClaveValida = validarClave();
        
        if (esUsuarioValido && esClaveValida) {
            // Mostrar loading en el botón
            $btnLogin.prop('disabled', true).html(`
                <i class="fas fa-spinner fa-spin"></i>
                Verificando credenciales...
            `);
            
            // Simular verificación de credenciales
            setTimeout(() => {
                // Aquí normalmente harías una petición AJAX al servidor
                // Para este ejemplo, asumimos que las credenciales son correctas
                
                // Mostrar éxito y redirigir
                $btnLogin.html(`
                    <i class="fas fa-check"></i>
                    ¡Credenciales correctas!
                `).addClass('btn-success');
                
                // Redirigir al inicio después de 1 segundo
                setTimeout(() => {
                    redirigirAlInicio();
                }, 1000);
                
            }, 2000);

            // Petición AJAX al servidor para verificar credenciales
            $.ajax({
                url: 'index.php?url=login', // Asegúrate que esta URL es correcta
                type: 'POST',
                dataType: 'json',
                data: $formulario.serialize(), // Envía los datos del formulario
                success: function(response) {
                    if (response && response.success) {
                        // Mostrar éxito y redirigir
                        $btnLogin.html(`
                            <i class="fas fa-check"></i>
                            ¡Credenciales correctas!
                        `).addClass('btn-success');
                        
                        setTimeout(redirigirAlInicio, 1000);
                    } else {
                        // Mostrar error del servidor
                        mostrarError($clave, $advContrasena, response.message || 'Usuario o contraseña incorrectos');
                        $btnLogin.prop('disabled', false).html('Iniciar Sesión');
                        $formulario.addClass('shake');
                        setTimeout(() => $formulario.removeClass('shake'), 500);
                    }
                },
                error: function() {
                    mostrarError($clave, $advContrasena, 'Error de comunicación con el servidor.');
                    $btnLogin.prop('disabled', false).html('Iniciar Sesión');
                }
            });
        } else {
            // Efecto de shake en el formulario
            $formulario.addClass('shake');
            setTimeout(() => {
                $formulario.removeClass('shake');
            }, 500);
            
            // Enfocar el primer campo con error
            if (!esUsuarioValido) {
                $usuario.focus();
            } else if (!esClaveValida) {
                $clave.focus();
            }
        }
    });

    // Limpiar validaciones al obtener foco
    $usuario.on('focus', function() {
        $advUsuario.text('').removeClass('error-message');
        $usuario.removeClass('input-error');
    });

    $clave.on('focus', function() {
        $advContrasena.text('').removeClass('error-message');
        $clave.removeClass('input-error');
    });
});


 