<?php
require_once 'componentes/sesion.php';
use App\modelo\perfilAdm;

//session_start();

// Verificar que el usuario esté logueado
if (!isset($_SESSION["usuario"])) {
    header('Location: ?url=login');
    exit();
}

$obj_perfil = new perfilAdm();
$usuario_actual = $_SESSION["usuario"];
$mensaje = "";
$error = "";

// Obtener datos actualizados del usuario
$datos_usuario = $obj_perfil->obtenerUsuarioPorId($usuario_actual['id_usuario']);

// Procesar actualización de perfil
if (isset($_POST['actualizar_perfil'])) {
    $valido = true;

    // Validaciones
    $norNombre = "/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{2,50}$/";
    $norApellidos = "/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{2,50}$/";
    $norTelefono = "/^[0-9]{7,15}$/";
    $norCorreo = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
    $norCedula = "/^[0-9]{7,10}$/";

    if (preg_match($norNombre, $_POST['nombre']) == 0) {
        $error = "El nombre no cumple con el formato (solo letras, 2-50 caracteres)";
        $valido = false;
    } else if (preg_match($norApellidos, $_POST['apellidos']) == 0) {
        $error = "Los apellidos no cumplen con el formato (solo letras, 2-50 caracteres)";
        $valido = false;
    } else if (preg_match($norTelefono, $_POST['telefono']) == 0) {
        $error = "El teléfono debe contener entre 7 y 15 dígitos";
        $valido = false;
    } else if (preg_match($norCorreo, $_POST['correo']) == 0) {
        $error = "El correo no cumple con el formato";
        $valido = false;
    } else if (preg_match($norCedula, $_POST['cedula']) == 0) {
        $error = "La cédula debe contener entre 7 y 10 dígitos";
        $valido = false;
    }

    // Verificar si el correo ya existe (excluyendo el usuario actual)
    if ($valido && $obj_perfil->verificarCorreoExistente($_POST['correo'], $usuario_actual['id_usuario'])) {
        $error = "El correo ya está registrado por otro usuario";
        $valido = false;
    }

    // Verificar si la cédula ya existe (excluyendo el usuario actual)
    if ($valido && $obj_perfil->verificarCedulaExistente($_POST['cedula'], $usuario_actual['id_usuario'])) {
        $error = "La cédula ya está registrada por otro usuario";
        $valido = false;
    }

    if ($valido) {
        $obj_perfil->set_id_usuario($usuario_actual['id_usuario']);
        $obj_perfil->set_nombre($_POST['nombre']);
        $obj_perfil->set_apellidos($_POST['apellidos']);
        $obj_perfil->set_telefono($_POST['telefono']);
        $obj_perfil->set_correo($_POST['correo']);
        $obj_perfil->set_cedula($_POST['cedula']);

        if ($obj_perfil->actualizarPerfil()) {
            $mensaje = "Perfil actualizado correctamente";
            // Actualizar la sesión con los nuevos datos
            $datos_usuario = $obj_perfil->obtenerUsuarioPorId($usuario_actual['id_usuario']);
            $_SESSION["usuario"] = $datos_usuario;
        } else {
            $error = "Error al actualizar el perfil";
        }
    }
}

// Procesar cambio de contraseña
if (isset($_POST['cambiar_clave'])) {
    $valido = true;

    $norClave = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";

    if (preg_match($norClave, $_POST['nueva_clave']) == 0) {
        $error = "La nueva contraseña debe tener al menos 8 caracteres, incluyendo mayúsculas, minúsculas, números y símbolos";
        $valido = false;
    } else if ($_POST['nueva_clave'] !== $_POST['confirmar_clave']) {
        $error = "Las contraseñas no coinciden";
        $valido = false;
    }

    if ($valido) {
        $obj_perfil->set_id_usuario($usuario_actual['id_usuario']);
        $obj_perfil->set_clave($_POST['nueva_clave']);

        if ($obj_perfil->cambiarClave()) {
            $mensaje = "Contraseña cambiada correctamente";
        } else {
            $error = "Error al cambiar la contraseña";
        }
    }
}

// Procesar logout
if (isset($_POST['logout'])) {
    unset($_SESSION["usuario"]);
    header('Location: ?url=login');
    exit();
}

require_once 'componentes/llamado_vistas.php';
?>