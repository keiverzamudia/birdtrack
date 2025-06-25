<?php
// require_once 'app/modelo/model.php';
//namespace App\controlador;
use App\modelo\gestionUsuariosModel;

$obj_model = new gestionUsuariosModel();

if(isset($_POST['enviar'])){
  $obj_model->set_cedula($_POST['cedula']);
  $obj_model->set_nombre($_POST['nombre']);
  $obj_model->set_departamento($_POST['departamento']);
  $obj_model->set_cargo($_POST['cargo']);
  $obj_model->set_correo($_POST['correo']);
  $obj_model->set_clave($_POST['clave']);


  if($obj_model->registrar()) {
    $mensaje = "Solicitud registrada correctamente";
  } else {
    $mensaje = "Error al registrar la solicitud";
  }
}

if(isset($_POST['editar'])){
   $obj_model->set_cedula($_POST['cedula']);
  $obj_model->set_nombre($_POST['nombre']);
  $obj_model->set_departamento($_POST['departamento']);
  $obj_model->set_cargo($_POST['cargo']);
  $obj_model->set_correo($_POST['correo']);
  $obj_model->set_clave($_POST['clave']);

  if($obj_model->modificar($_POST['editar'])) {
    $mensaje = "Solicitud actualizada correctamente";
  } else {
    $mensaje = "Error al actualizar la solicitud";
  }
}

if(isset($_POST['eliminar'])){
  $obj_model->set_cedula($_POST['eliminar']);
  if($obj_model->eliminar()) {
    $mensaje = "Solicitud eliminada correctamente";
  } else {
    $mensaje = "Error al eliminar la solicitud";
  }
}

if(isset($_POST['seleccion'])){
  $obj_model->set_cedula($_POST['seleccion']);
  $editar_usuario = $obj_model->buscar();
}

$usuarios = $obj_model->consultar();

require_once 'componentes/llamado_vistas.php';
?>