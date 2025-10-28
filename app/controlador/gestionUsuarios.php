<?php
require_once 'componentes/sesion.php';
//namespace App\controlador\Model;



use App\modelo\CargoModel;
use App\modelo\gestionUsuariosModel;
use App\modelo\DepartamentoModel;

 $obj_model = new gestionUsuariosModel();
 $obj_cargo = new CargoModel();
 $obj_departamento = new DepartamentoModel();

if(isset($_POST['enviar'])){

  if(!is_dir('Assets/img/perfiles')){
    mkdir('Assets/img/perfiles', 0777, true);
  }

  $ruta_temporal = $_FILES['foto']['tmp_name'];
  $destino = 'Assets/img/perfiles/' . $_FILES['foto']['name'];
  move_uploaded_file($ruta_temporal, $destino);

  $obj_model->set_cedula($_POST['cedula']);
  $obj_model->set_nombre($_POST['nombre']);
  $obj_model->set_departamento($_POST['departamento']);
  $obj_model->set_cargo($_POST['cargo']);
  $obj_model->set_correo($_POST['correo']);
  $obj_model->set_foto($_FILES['foto']['name']);
 

  if($obj_model->registrar()) {
    $mensaje = " empleado registrado correctamente";
  } else {
    $mensaje = "Error al registrar empleado";
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
    $mensaje = "Actualizacion realizada correctamente";
  } else {
    $mensaje = "Error al actualizar registro del empleado";
  }
  header('Location: index.php?url=gestionUsuarios');
 exit();
}

if(isset($_POST['eliminar'])){
  $obj_model->set_cedula($_POST['eliminar']);
  if($obj_model->eliminar()) {
    $mensaje = "error al eliminar";
  } else {
    $mensaje = "empleado eliminado correctament";
  }
  header('Location: index.php?url=gestionUsuarios');
 exit();
}

if(isset($_POST['seleccion'])){
  $obj_model->set_cedula($_POST['seleccion']);
  $editar_usuario = $obj_model->buscar();
}

// controlador para el crud pequeño de cargo

if(isset($_POST['agregar_cargo'])){
  $obj_cargo->set_nombre_cargo($_POST['nombre_cargo']);
  $obj_cargo->registrarcargo();
  header('Location: index.php?url=gestionUsuarios');
 exit();
}

 if(isset($_POST['eliminar_cargo'])){
  $obj_cargo->set_id_cargo($_POST['eliminar_cargo']);
  $obj_cargo->eliminarcargo();
  header('Location: index.php?url=gestionUsuarios');
 exit();
 }

if(isset($_POST['editar_cargo'])){
  
  $obj_cargo->set_id_cargo($_POST['editar_cargo']);
  $obj_cargo->set_nombre_cargo($_POST['nombre_cargo']);
  $obj_cargo->modificarCargo();
  header('Location: index.php?url=gestionUsuarios');
 exit();
}


// controlador para el crud peque;o de departamento

if(isset($_POST['agregar_departamento'])){

  $obj_departamento->set_nombre_departamento($_POST['nombre_departamento']);
  $obj_departamento->set_descripcion_departamento($_POST['descripcion_departamento']);
  $obj_departamento->registrarDep();
  header('Location: index.php?url=gestionUsuarios');
 exit();
  
}

 if(isset($_POST['eliminar_departamento'])){
  $obj_departamento->set_id_departamento($_POST['eliminar_departamento']);
  $obj_departamento->eliminarDep();
  header('Location: index.php?url=gestionUsuarios');
 exit();
 }

if(isset($_POST['editar_departamento'])){
  $obj_departamento->set_id_departamento($_POST['editar_departamento']);
  $obj_departamento->set_nombre_departamento($_POST['nombre_departamento']);
   $obj_departamento->set_descripcion_departamento($_POST['descripcion_departamento']);
  $obj_departamento-> modificarDep();
  header('Location: index.php?url=gestionUsuarios');
 exit();
}

$usuarios = $obj_model->consultar();
$departamentos = $obj_departamento->consultardep();
$cargos = $obj_cargo->consultarcargo();

require_once 'componentes/llamado_vistas.php';
?>