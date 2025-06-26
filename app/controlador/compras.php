<?php
use App\modelo\comprasModelo;
$obj_model = new comprasModelo();


if(isset($_POST['enviar'])){
  
  $obj_model->set_Nro_Factura($_POST['Nro_Factura']);
  $obj_model->set_Fecha($_POST['Fecha']);
  $obj_model->set_Cantidad($_POST['Cantidad']);
  $obj_model->set_nombre_activo($_POST['Nombre_activo']);
   $obj_model->set_proveedor($_POST['proveedor']);
  $obj_model->registrar();

  if($obj_model->registrar()) {
    $mensaje = "Activo registrado correctamente";
  } else {
    $mensaje = "Error al registrar el activo";
  }
}


if(isset($_POST['editar'])){
  
  $obj_model->set_Nro_Factura($_POST['Nro_Factura']);
  $obj_model->set_Fecha($_POST['Fecha']);
  $obj_model->set_Cantidad($_POST['Cantidad']);
  $obj_model->set_nombre_activo($_POST['Nombre_activo']);
  $obj_model->set_proveedor($_POST['proveedor']);
  
  if($obj_model->modificar($_POST['editar'])) {
    $mensaje = "Solicitud actualizada correctamente";
  } else {
    $mensaje = "Error al actualizar la solicitud";
  }

}

if(isset($_POST['eliminar'])){
  $obj_model->set_Id_compra($_POST['eliminar']);
  if($obj_model->eliminar()) {
    $mensaje = "Activo eliminado correctamente";
  } else {
    $mensaje = "Error al eliminar el activo";
  }
}

if(isset($_POST['seleccion'])){
  $obj_model->set_Id_compra($_POST['seleccion']);
  $editar_compra = $obj_model->buscar();
}


$compras = $obj_model->consultar();

require_once 'componentes/llamado_vistas.php';?>