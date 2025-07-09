<?php

use App\modelo\gestionActivosModel;
use App\modelo\TipoActivoModel;
$obj_model = new gestionActivosModel();
$obj_tipo = new  TipoActivoModel();

session_start(); // 

if (isset($_POST['enviar'])) {
    $obj_model->set_id_tipo($_POST['id_tipo_activo']);
    $obj_model->set_id_ubicacion($_POST['id_ubicacion']);
    $obj_model->set_nombre($_POST['Nombre']);
    $obj_model->set_descripcion($_POST['Descripcion']);
    $obj_model->set_fecha_adquisicion($_POST['Fecha_adquisicion']);

    if ($obj_model->registrar()) {
        $_SESSION['mensaje_exito'] = "Activo registrado correctamente";
    } else {
        $_SESSION['mensaje_error'] = "Error al registrar el activo";
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
     $_SESSION['mensaje_exito'] = "Activo Modificado correctamente";
  } else {
     $_SESSION['mensaje_error'] = "Error al Modificar el activo";// modificado hoy 07/07
  }

}


if(isset($_POST['eliminar'])){
  $obj_model->set_id_activo($_POST['eliminar']);
  if($obj_model->eliminar()) {

      $_SESSION['mensaje_exito'] = "Activo eliminado correctamente";
   
  } else {
      $_SESSION['mensaje_error'] = "Error al registrar el activo";
  }
  //se puede quitar en eliminar no lo requiere // modificado hoy 07/07
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
        $_SESSION['mensaje_exito'] = "Tipo de Activo registrado correctamente";
    } else {
        $_SESSION['mensaje_error'] = "Error al registrar el tipo de activo";
    }

    header('Location: index.php?url=gestionActivos');
    exit();
}


if(isset($_POST['eliminar_tipo_activo'])){
  $obj_tipo->set_id_tipo($_POST['eliminar_tipo_activo']);
  if($obj_tipo->eliminarTipoActivo()){
        $_SESSION['mensaje_exito'] = "Tipo de activo Eliminado correctamente";
    } else {
        $_SESSION['mensaje_error'] = "Error al Eliminar el Tipo de activo"; // modificado hoy 07/07
  }
}

if(isset($_POST['editar_tipo_activo'])){
  $obj_tipo->set_id_tipo($_POST['editar_tipo_activo']);
  $obj_tipo->set_nombre_tipo($_POST['nombre_tipo_activo']);
  $obj_tipo->set_descripcion_tipo($_POST['descripcion_tipo_activo']);
  if($obj_tipo->editarTipoActivo()) {
        $_SESSION['mensaje_exito'] = "Tipo de activo Modificado correctamente";
    } else {
        $_SESSION['mensaje_error'] = "Error al Modificar el Tipo de activo";
   
   // modificado hoy 07/07
  }

}

$activos = $obj_model->consultar();
$tipos_activos = $obj_model->cargarTiposActivos();
$id_ubicacion = $obj_model->cargarUbicaciones();




require_once 'componentes/llamado_vistas.php';


