<?php
require_once 'componentes/sesion.php';

use App\modelo\reclamosModelo;
use App\modelo\gestionActivosModel;
use App\modelo\gestionUsuariosModel;

$obj_reclamos = new reclamosModelo();
$obj_activos = new gestionActivosModel();
$obj_usuarios = new gestionUsuariosModel();

// Función para enviar respuesta JSON
function sendJsonResponse($success, $message, $data = null) {
    header('Content-Type: application/json');
    echo json_encode([
        'success' => $success,
        'message' => $message,
        'data' => $data
    ]);
    exit();
}

// Verificar si es una petición AJAX
$isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
          strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';

// Registrar nuevo reclamo
if(isset($_POST['enviar'])){
    $obj_reclamos->set_cedula_empleado($_POST['cedula_empleado']);
    $obj_reclamos->set_id_activo($_POST['id_activo']);
    $obj_reclamos->set_descripcion($_POST['descripcion']);
    $obj_reclamos->set_fecha_reclamo($_POST['fecha_reclamo']);

    if($obj_reclamos->registrar()) {
        if($isAjax) {
            sendJsonResponse(true, "Reclamo registrado correctamente");
        } else {
            $mensaje = "Reclamo registrado correctamente";
            header("Location: index.php?url=reclamos");
            exit();
        }
    } else {
        if($isAjax) {
            sendJsonResponse(false, "Error al registrar el reclamo");
        } else {
            $mensaje = "Error al registrar el reclamo";
            header("Location: index.php?url=reclamos");
            exit();
        }
    }
}

// Editar reclamo
if(isset($_POST['editar'])){
    // Validar que todos los campos requeridos estén presentes
    if(empty($_POST['id_activo']) || empty($_POST['cedula_empleado']) || empty($_POST['descripcion']) || empty($_POST['fecha_reclamo'])) {
        if($isAjax) {
            sendJsonResponse(false, "Error: Todos los campos son requeridos");
        } else {
            $mensaje = "Error: Todos los campos son requeridos";
            header("Location: index.php?url=reclamos");
            exit();
        }
    } else {
        $obj_reclamos->set_id_reclamo($_POST['editar']);
        $obj_reclamos->set_cedula_empleado($_POST['cedula_empleado']);
        $obj_reclamos->set_id_activo($_POST['id_activo']);
        $obj_reclamos->set_descripcion($_POST['descripcion']);
        $obj_reclamos->set_fecha_reclamo($_POST['fecha_reclamo']);

        if($obj_reclamos->actualizar()) {
            if($isAjax) {
                sendJsonResponse(true, "Reclamo actualizado correctamente");
            } else {
                $mensaje = "Reclamo actualizado correctamente";
                header("Location: index.php?url=reclamos");
                exit();
            }
        } else {
            if($isAjax) {
                sendJsonResponse(false, "Error al actualizar el reclamo");
            } else {
                $mensaje = "Error al actualizar el reclamo";
                header("Location: index.php?url=reclamos");
                exit();
            }
        }
    }
}

// Eliminar reclamo
if(isset($_POST['eliminar'])){
    $obj_reclamos->set_id_reclamo($_POST['eliminar']);
    if($obj_reclamos->eliminar()) {
        if($isAjax) {
            sendJsonResponse(true, "Reclamo eliminado correctamente");
        } else {
            $mensaje = "Reclamo eliminado correctamente";
            header("Location: index.php?url=reclamos");
            exit();
        }
    } else {
        if($isAjax) {
            sendJsonResponse(false, "Error al eliminar el reclamo");
        } else {
            $mensaje = "Error al eliminar el reclamo";
            header("Location: index.php?url=reclamos");
            exit();
        }
    }
}

// Seleccionar reclamo para editar
if(isset($_POST['seleccion'])){
    $obj_reclamos->set_id_reclamo($_POST['seleccion']);
    $editar_reclamo = $obj_reclamos->consultar_por_id();
}

// Obtener datos para la vista
$reclamos = $obj_reclamos->consultar();
$activos = $obj_activos->consultar();
$empleados = $obj_usuarios->consultar();

// Obtener activos asignados y disponibles
$activos_asignados = $obj_reclamos->obtener_activos_asignados();
$activos_disponibles = $obj_reclamos->obtener_activos_disponibles();

require_once 'componentes/llamado_vistas.php';
?>
