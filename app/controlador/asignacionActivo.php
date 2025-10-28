<?php
require_once 'componentes/sesion.php';

use App\modelo\asignacionActivoModel;
use App\modelo\gestionActivosModel;
use App\modelo\gestionUsuariosModel;

$obj_Asignacion = new asignacionActivoModel();
$obj_Activo = new gestionActivosModel();
$obj_Usuario = new gestionUsuariosModel();

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

if(isset($_POST['enviar'])){
  $obj_Asignacion->set_id_activo($_POST['id_activo']);
  $obj_Asignacion->set_cedula_empleado($_POST['cedula_empleado']);
  $obj_Asignacion->set_Descripcion_Asignacion($_POST['Descripcion_Asignacion']);
  $obj_Asignacion->set_Fecha_asignacion($_POST['Fecha_asignacion']);

  if($obj_Asignacion->registrar()) {
    if($isAjax) {
      sendJsonResponse(true, "Solicitud registrada correctamente");
    } else {
      $mensaje = "Solicitud registrada correctamente";
      header("Location: index.php?url=asignacionActivo");
      exit();
    }
  } else {
    if($isAjax) {
      sendJsonResponse(false, "Error al registrar la solicitud");
    } else {
      $mensaje = "Error al registrar la solicitud";
      header("Location: index.php?url=asignacionActivo");
      exit();
    }
  }
}

if(isset($_POST['editar'])){
  // Validar que todos los campos requeridos estén presentes
  if(empty($_POST['id_activo']) || empty($_POST['cedula_empleado']) || empty($_POST['Descripcion_Asignacion']) || empty($_POST['Fecha_asignacion'])) {
    if($isAjax) {
      sendJsonResponse(false, "Error: Todos los campos son requeridos");
    } else {
      $mensaje = "Error: Todos los campos son requeridos";
      header("Location: index.php?url=asignacionActivo");
      exit();
    }
  } else {
    $obj_Asignacion->set_id_asignacion($_POST['editar']);
    $obj_Asignacion->set_id_activo($_POST['id_activo']);
    $obj_Asignacion->set_cedula_empleado($_POST['cedula_empleado']);
    $obj_Asignacion->set_Descripcion_Asignacion($_POST['Descripcion_Asignacion']);
    $obj_Asignacion->set_Fecha_asignacion($_POST['Fecha_asignacion']);

    if($obj_Asignacion->modificar($_POST['editar'])) {
      if($isAjax) {
        sendJsonResponse(true, "Solicitud actualizada correctamente");
      } else {
        $mensaje = "Solicitud actualizada correctamente";
        header("Location: index.php?url=asignacionActivo");
        exit();
      }
    } else {
      if($isAjax) {
        sendJsonResponse(false, "Error al actualizar la solicitud");
      } else {
        $mensaje = "Error al actualizar la solicitud";
        header("Location: index.php?url=asignacionActivo");
        exit();
      }
    }
  }
}

if(isset($_POST['eliminar'])){
  $obj_Asignacion->set_id_asignacion($_POST['eliminar']);
  if($obj_Asignacion->eliminar()) {
    if($isAjax) {
      sendJsonResponse(true, "Solicitud eliminada correctamente");
    } else {
      $mensaje = "Solicitud eliminada correctamente";
      header("Location: index.php?url=asignacionActivo");
      exit();
    }
  } else {
    if($isAjax) {
      sendJsonResponse(false, "Error al eliminar la solicitud");
    } else {
      $mensaje = "Error al eliminar la solicitud";
      header("Location: index.php?url=asignacionActivo");
      exit();
    }
  }
}

if(isset($_POST['seleccion'])){
  $obj_Asignacion->set_id_asignacion($_POST['seleccion']);
  $editar_Asignacion = $obj_Asignacion->buscar();
}

$asignaciones = $obj_Asignacion->consultar();
$activos = $obj_Activo->consultar();
$usuarios = $obj_Usuario->consultar();

require_once 'componentes/llamado_vistas.php';
?>