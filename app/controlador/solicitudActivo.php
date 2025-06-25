<?php
// require_once 'app/modelo/model.php';
namespace App\controlador;
use App\modelo\solicitudActivo;

$obj_model = new solicitudActivo();

if(isset($_POST['enviar'])){

  //print_r($_POST);

  
  $obj_model->set_ID_Activo($_POST['ID_Activo']);
  $obj_model->set_Nombre_Activo($_POST['Nombre_Activo']);
  $obj_model->set_Nombre_Usuario($_POST['Nombre_Usuario']);
  $obj_model->set_Cedula($_POST['Cedula']);
  $obj_model->set_Estado('Pendiente'); // Estado por defecto para nuevas solicitudes

  if($obj_model->registrar()) {
    $mensaje = "Solicitud registrada correctamente";
  } else {
    $mensaje = "Error al registrar la solicitud";
  }
}

if(isset($_POST['editar'])){
  $obj_model->set_ID_Activo($_POST['ID_Activo']);
  $obj_model->set_Nombre_Activo($_POST['Nombre_Activo']);
  $obj_model->set_Estado($_POST['Estado']);
  $obj_model->set_Nombre_Usuario($_POST['Nombre_Usuario']);
  $obj_model->set_Cedula($_POST['Cedula']);

  if($obj_model->modificar($_POST['editar'])) {
    $mensaje = "Solicitud actualizada correctamente";
  } else {
    $mensaje = "Error al actualizar la solicitud";
  }
}

if(isset($_POST['eliminar'])){
  $obj_model->set_id($_POST['eliminar']);
  if($obj_model->eliminar()) {
    $mensaje = "Solicitud eliminada correctamente";
  } else {
    $mensaje = "Error al eliminar la solicitud";
  }
}

if(isset($_POST['seleccion'])){
  $obj_model->set_id($_POST['seleccion']);
  $editar_solicitud = $obj_model->buscar();
}

$solicitud = $obj_model->consultar();

require_once 'componentes/llamado_vistas.php';
?>