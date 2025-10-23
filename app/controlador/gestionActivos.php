<?php
require_once 'componentes/sesion.php';

use App\modelo\gestionActivosModel;
use App\modelo\TipoActivoModel;
$obj_model = new gestionActivosModel();
$obj_tipo = new  TipoActivoModel();


if(isset($_POST['enviar'])){
  $obj_model->set_id_tipo($_POST['id_tipo_activo']);
  $obj_model->set_id_ubicacion($_POST['id_ubicacion']);
  $obj_model->set_nombre($_POST['Nombre']);
  $obj_model->set_descripcion($_POST['Descripcion']);
  $obj_model->set_fecha_adquisicion($_POST['Fecha_adquisicion']);
 if($obj_model->registrar()) {
    $mensaje = "Activo registrado correctamente";
  } else {
    $mensaje = "Error al registrar el activo";
  }

  header('Location: index.php?url=gestionActivos');
  exit();
}

if(isset($_POST['editar'])){
  $obj_model->set_id_tipo($_POST['id_tipo_activo']);
  $obj_model->set_id_ubicacion($_POST['id_ubicacion']);
  $obj_model->set_nombre($_POST['Nombre']);
  $obj_model->set_descripcion($_POST['Descripcion']);
  $obj_model->set_fecha_adquisicion($_POST['Fecha_adquisicion']);
 
  if($obj_model->modificar($_POST['editar'])) {
    $mensaje = "Activo actualizado correctamente";
  } else {
    $mensaje = "Error al actualizar el activo";
  }
  header('Location: index.php?url=gestionActivos');
  exit();
}


if(isset($_POST['eliminar'])){
  $obj_model->set_id_activo($_POST['eliminar']);
  if($obj_model->eliminar()) {
    $mensaje = "Activo eliminado correctamente";
  } else {
    $mensaje = "Error al eliminar el activo";
  }
  header('Location: index.php?url=gestionActivos');
  exit();
}

if(isset($_POST['seleccion'])){
  $obj_model->set_id_activo($_POST['seleccion']);
  $editar_activo = $obj_model->buscar();
}


//CRUD Tipo de activo

if(isset($_POST['agregar_tipo_activo'])){
  $obj_tipo->set_nombre_tipo($_POST['nombre_tipo_activo']);
  $obj_tipo->set_descripcion_tipo($_POST['descripcion_tipo_activo']);
  if($obj_tipo->registrarTipoActivo()){
 $mensaje = "Tipo de activo registrado correctamente";
  } else {
    $mensaje = "Error al registrar el tipo de activo";
  }
 header('Location: index.php?url=gestionActivos');
 exit();
}

if(isset($_POST['eliminar_tipo_activo'])){
  $obj_tipo->set_id_tipo($_POST['eliminar_tipo_activo']);
  $obj_tipo->eliminarTipoActivo();

 header('Location: index.php?url=gestionActivos');
 exit();
}

if(isset($_POST['editar_tipo_activo'])){
  $obj_tipo->set_id_tipo($_POST['editar_tipo_activo']);
  $obj_tipo->set_nombre_tipo($_POST['nombre_tipo_activo']);
  $obj_tipo->set_descripcion_tipo($_POST['descripcion_tipo_activo']);
  $obj_tipo->editarTipoActivo();
  
  header('Location: index.php?url=gestionActivos');
  exit();
}



$activos = $obj_model->consultar();
$tipos_activos = $obj_model->cargarTiposActivos();
$id_ubicacion = $obj_model->cargarUbicaciones();




require_once 'componentes/llamado_vistas.php';


