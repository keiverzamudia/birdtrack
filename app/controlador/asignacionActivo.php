<?php
use App\modelo\asignacionActivoModel;
use App\modelo\gestionActivosModel;
use App\modelo\gestionUsuariosModel;

$obj_Asignacion = new asignacionActivoModel();
$obj_Activo = new gestionActivosModel();
$obj_Usuario = new gestionUsuariosModel();




if(isset($_POST['enviar'])){
  $obj_Asignacion->set_id_activo($_POST['id_activo']);
  $obj_Asignacion->set_cedula_empleado($_POST['cedula_empleado']);
  $obj_Asignacion->set_Descripcion_Asignacion($_POST['Descripcion_Asignacion']);
  $obj_Asignacion->set_Fecha_asignacion($_POST['Fecha_asignacion']);


  if($obj_Asignacion->registrar()) {
    $mensaje = "Solicitud registrada correctamente";
  } else {
    $mensaje = "Error al registrar la solicitud";
  }
      header("Location: index.php?url=asignacionActivo");
  exit();
}

if(isset($_POST['editar'])){
  // Validar que todos los campos requeridos estén presentes
  if(empty($_POST['id_activo']) || empty($_POST['cedula_empleado']) || empty($_POST['Descripcion_Asignacion']) || empty($_POST['Fecha_asignacion'])) {
    $mensaje = "Error: Todos los campos son requeridos";
  } else {
    $obj_Asignacion->set_id_asignacion($_POST['editar']);
    $obj_Asignacion->set_id_activo($_POST['id_activo']);
    $obj_Asignacion->set_cedula_empleado($_POST['cedula_empleado']);
    $obj_Asignacion->set_Descripcion_Asignacion($_POST['Descripcion_Asignacion']);
    $obj_Asignacion->set_Fecha_asignacion($_POST['Fecha_asignacion']);

    if($obj_Asignacion->modificar($_POST['editar'])) {
      $mensaje = "Solicitud actualizada correctamente";
    } else {
      $mensaje = "Error al actualizar la solicitud";
    }
  }
      header("Location: index.php?url=asignacionActivo");
  exit();
}


if(isset($_POST['eliminar'])){
  $obj_Asignacion->set_id_asignacion($_POST['eliminar']);
  if($obj_Asignacion->eliminar()) {
    $mensaje = "Solicitud eliminada correctamente";
  } else {
    $mensaje = "Error al eliminar la solicitud";
  }
      header("Location: index.php?url=asignacionActivo");
  exit();
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