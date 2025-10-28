<?php
require_once 'componentes/sesion.php';

use App\modelo\comprasModelo;
use App\modelo\gestionProveedoresModel;


$obj_model = new comprasModelo();
$obj_Proveedormodel = new gestionProveedoresModel();



if (isset($_POST['enviar_compra'])) {
  
 {

    $obj_model->set_cod_proveedor($_POST['cod_proveedor']);
    $obj_model->set_cedula_empleado($_POST['cedula_empleado']);
    $obj_model->set_Detalle_Compra($_POST['Detalle_Compra']);
    $obj_model->set_Cantidad($_POST['Cantidad']);
    $obj_model->set_Costo($_POST['Costo']);
    $obj_model->set_Fecha_Compra($_POST['Fecha_Compra']);
      
  
    if ($obj_model->confirmarRegistro()) {
      $mensaje = "✅ Compra registrada correctamente.";
    } else {
      $mensaje = "❌Registro de compra fallido.";
    }

}


}



if (isset($_POST['editar_compra'])) {
  $obj_model->set_id_compra($_POST['id_compra']);
  $obj_model->set_cod_proveedor($_POST['cod_proveedor']);
  $obj_model->set_cedula_empleado($_POST['cedula_empleado']);
  $obj_model->set_Detalle_Compra($_POST['Detalle_Compra']);
  $obj_model->set_Costo($_POST['Costo']);
  $obj_model->set_Cantidad($_POST['Cantidad']);
  $obj_model->set_Fecha_Compra($_POST['Fecha_Compra']);

  if ($obj_model->confirmarModificacion()) {
    $mensaje = "✅ COMPRA actualizada correctamente";
  } else {
    $mensaje = "❌ Error al actualizar la COMPRA";
  }
}







if (isset($_POST['eliminar'])) {
  $obj_model->set_id_compra($_POST['eliminar']);
   
  if ($obj_model->eliminar()) {
    $mensaje = "Compra eliminada correctamente";
  } else {
    $mensaje = "Error al eliminar la compra";
  }
   $compras = $obj_model->consultar();

}


  
if (isset($_POST['seleccion'])) {
  $obj_model->set_id_compra($_POST['seleccion']);
  $editar_compra = $obj_model->buscar();
}


$compras = $obj_model->consultar();
$Proveedor = $obj_Proveedormodel->consultar();



require_once 'componentes/llamado_vistas.php'; ?>