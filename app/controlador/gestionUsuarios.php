<?php
//namespace App\controlador\Model;

use App\modelo\CargoModel;
use App\modelo\gestionUsuariosModel;
use App\modelo\DepartamentoModel;

 $obj_model = new gestionUsuariosModel();
 $obj_cargo = new CargoModel();
 $obj_departamento = new DepartamentoModel();

 session_start();

if(isset($_POST['enviar'])){
 
  $obj_model->set_cedula($_POST['cedula']);
  $obj_model->set_nombre($_POST['nombre']);
  $obj_model->set_departamento($_POST['departamento']);
  $obj_model->set_cargo($_POST['cargo']);
  $obj_model->set_correo($_POST['correo']);
 

  if($obj_model->registrar()) {
    $_SESSION['mensaje_exito'] = "Nuevo Usuario Registardo correctamente";
  } else {
     $_SESSION['mensaje_error'] = "Error al Crear el Nuevo Usuario";
  }
  header('Location: index.php?url=gestionUsuarios');
 exit();
}

if(isset($_POST['editar'])){
 
   $obj_model->set_cedula($_POST['cedula']);
  $obj_model->set_nombre($_POST['nombre']);
  $obj_model->set_departamento($_POST['departamento']);
  $obj_model->set_cargo($_POST['cargo']);
  $obj_model->set_correo($_POST['correo']);
 

  if($obj_model->modificar($_POST['editar'])) {
    $_SESSION['mensaje_exito'] = "Usuario Modificado correctamente";
  } else {
     $_SESSION['mensaje_error'] = "Error al Modificar el Usuario";
  }
  
}

if(isset($_POST['eliminar'])){
  $obj_model->set_cedula($_POST['eliminar']);
  if($obj_model->eliminar()) {
    $_SESSION['mensaje_exito'] = "Usuario Eliminado correctamente";
  } else {
     $_SESSION['mensaje_error'] = "Error al Eliminar el Usuario";
  }
}

if(isset($_POST['seleccion'])){
  $obj_model->set_cedula($_POST['seleccion']);
  $editar_usuario = $obj_model->buscar();
}

// controlador para el crud pequeño de cargo

if(isset($_POST['agregar_cargo'])){
  $obj_cargo->set_nombre_cargo($_POST['nombre_cargo']);
  if($obj_cargo->registrarcargo()){
    $_SESSION['mensaje_exito'] = "Nuevo Cargo Creado correctamente";
  } else {
     $_SESSION['mensaje_error'] = "Error al Crear el Nuevo Cargo";
  }
  header('Location: index.php?url=gestionUsuarios');
 exit();
}

 if(isset($_POST['eliminar_cargo'])){
  $obj_cargo->set_id_cargo($_POST['eliminar_cargo']);
  if($obj_cargo->eliminarcargo()){
    $_SESSION['mensaje_exito'] = "Cargo Eliminado correctamente";
  } else {
     $_SESSION['mensaje_error'] = "Error al Eliminar el Cargo";
  }
 }

if(isset($_POST['editar_cargo'])){
  
  $obj_cargo->set_id_cargo($_POST['editar_cargo']);
  $obj_cargo->set_nombre_cargo($_POST['nombre_cargo']);
  if($obj_cargo->modificarCargo()){
    $_SESSION['mensaje_exito'] = "Cargo Modificado correctamente";
  } else {
     $_SESSION['mensaje_error'] = "Error al Modificar el Cargo";
  }
}


// controlador para el crud peque;o de departamento

if(isset($_POST['agregar_departamento'])){

  $obj_departamento->set_nombre_departamento($_POST['nombre_departamento']);
  $obj_departamento->set_descripcion_departamento($_POST['descripcion_departamento']);
  if($obj_departamento->registrarDep()){
    $_SESSION['mensaje_exito'] = "Nuevo Departamento Agregado correctamente";
  } else {
     $_SESSION['mensaje_error'] = "Error al Agregar el Nuevo Departamento";
  }
  
}

 if(isset($_POST['eliminar_departamento'])){
  $obj_departamento->set_id_departamento($_POST['eliminar_departamento']);
  if($obj_departamento->eliminarDep()){
    $_SESSION['mensaje_exito'] = "Departamento Eliminado correctamente";
  } else {
     $_SESSION['mensaje_error'] = "Error al Eliminar el Departamento";
  } 

 }

if(isset($_POST['editar_departamento'])){
  $obj_departamento->set_id_departamento($_POST['editar_departamento']);
  $obj_departamento->set_nombre_departamento($_POST['nombre_departamento']);
   $obj_departamento->set_descripcion_departamento($_POST['descripcion_departamento']);
  if($obj_departamento-> modificarDep()){
    $_SESSION['mensaje_exito'] = "Departamento Editado correctamente";
  } else {
     $_SESSION['mensaje_error'] = "Error al Editar el Departamento";
  }

}

$usuarios = $obj_model->consultar();
$departamentos = $obj_departamento->consultardep();
$cargos = $obj_cargo->consultarcargo();




require_once 'componentes/llamado_vistas.php';
?>