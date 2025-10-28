<?php


use App\Modelo\GestionMantenimientoModel;
use App\Modelo\tipoMantenimientoModel;
use App\modelo\gestionActivosModel;
use App\modelo\gestionUsuariosModel;

$obj_Mantenimiento = new GestionMantenimientoModel();
$obj_TipoMantenimiento = new tipoMantenimientoModel();
$obj_Activos = new gestionActivosModel();
$obj_Usuarios = new gestionUsuariosModel();

$tipo_mantenimiento = $obj_TipoMantenimiento->consultar(); // Para el select
$Activo = $obj_Activos->consultar();//la consulta de los activos en la tabla y en el select
$mantenimientos = $obj_Mantenimiento->consultar();
$usuarios = $obj_Usuarios->consultar();

if (isset($_POST['enviar'])) {
  //print_r($_POST);
  $obj_Mantenimiento->set_Id_Activo($_POST['id_activo']);
  $obj_Mantenimiento->set_Empleado_Responable($_POST['cedula_empleado']);
  $obj_Mantenimiento->set_Tipo_MTTO($_POST['id_tipo_mantenimiento']);

  if ($obj_Mantenimiento->registrar()) {
    $mensaje = "Solicitud registrada correctamente";
  } else {
    $mensaje = "Error al registrar la solicitud";
  }


  header("Location: index.php?url=gestionMantenimiento");
  exit();

}

if (isset($_POST['modificar'])) {
  //print_r($_POST);

  $obj_Mantenimiento->set_Id_Activo($_POST['id']);
  $obj_Mantenimiento->set_Empleado_Responable($_POST['cedula_empleado']);
  $obj_Mantenimiento->set_tipo_MTTO($_POST['id_tipo_mantenimiento']);
  $obj_Mantenimiento->set_Estado_MTTO($_POST['estado']);


  if ($obj_Mantenimiento->modificar($_POST['modificar'])) {
    $mensaje = "Solicitud actualizada correctamente";
  } else {
    $mensaje = "Error al actualizar la solicitud";
  }


  header("Location: index.php?url=gestionMantenimiento");
  exit();
}
if (isset($_POST['eliminar'])) {
  $obj_Mantenimiento->set_ID_MTTO($_POST['eliminar']);
  if ($obj_Mantenimiento->eliminar()) {
    $mensaje = "Solicitud eliminada correctamente";
  } else {
    $mensaje = "Error al eliminar la solicitud";
  }

  header("Location: index.php?url=gestionMantenimiento");
  exit();

}

if (isset($_POST['seleccion'])) {
  // print_r($_POST);
  $obj_Mantenimiento->set_ID_MTTO($_POST['seleccion']);
  $modificar_Mantenimiento = $obj_Mantenimiento->buscar();

}

if (isset($_POST['insertGestionMTTO'])) {
  $id_activo = $_POST['id_activo'];
  $cedula_empleado = $_POST['cedula_empleado'];
  $id_tipo_mantenimiento = $_POST['id_tipo_mantenimiento'];

  $resultado = $obj_Mantenimiento->registrar();
  echo json_encode($resultado);
}

$model = new GestionMantenimientoModel();

// Obtener todos los mantenimientos
if (isset($_POST['getGestionMTTO'])) {

  $result = $model->consultar();
  echo json_encode($result);
  exit;
}


require_once 'componentes/llamado_vistas.php';