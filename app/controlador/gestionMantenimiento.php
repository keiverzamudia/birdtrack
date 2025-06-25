<?php


use App\modelo\GestionMantenimientoModel;

$obj_Mantenimiento = new GestionMantenimientoModel();


if (isset($_POST['enviar'])) {
   //print_r($_POST);
  $obj_Mantenimiento->set_Nombre_Activo($_POST['nombre']);
  $obj_Mantenimiento->set_Id_Activo($_POST['id_activo']);
  $obj_Mantenimiento->set_Empleado_Responable($_POST['responsable']);
  $obj_Mantenimiento->set_tipo_MTTO($_POST['tipo']);
  $obj_Mantenimiento->set_Estado_MTTO($_POST['estado']);

  if($obj_Mantenimiento->registrar()) {
    $mensaje = "Solicitud registrada correctamente";
  } else {
    $mensaje = "Error al registrar la solicitud";
  }


}
if (isset($_POST['modificar'])) {
  // print_r($_POST);

  $obj_Mantenimiento->set_Id_Activo($_POST['id']);
  $obj_Mantenimiento->set_Empleado_Responable($_POST['responsable']);
  $obj_Mantenimiento->set_tipo_MTTO($_POST['tipo']);
  $obj_Mantenimiento->set_Estado_MTTO($_POST['estado']);

  if($obj_Mantenimiento->modificar($_POST['editar'])) {
    $mensaje = "Solicitud actualizada correctamente";
  } else {
    $mensaje = "Error al actualizar la solicitud";
  }


}

if(isset($_POST['eliminar'])){
  $obj_Mantenimiento->set_ID_MTTO($_POST['eliminar']);
  if($obj_Mantenimiento->eliminar()) {
    $mensaje = "Solicitud eliminada correctamente";
  } else {
    $mensaje = "Error al eliminar la solicitud";
  }
}

if (isset($_POST['seleccion'])) {
  // print_r($_POST);
  $obj_Mantenimiento->set_ID_MTTO($_POST['seleccion']);
  $modificar_Mantenimiento = $obj_Mantenimiento->buscar();
}


$mantenimientos = $obj_Mantenimiento->consultar();

require_once 'componentes/llamado_vistas.php';