<?php
require_once 'componentes/sesion.php';

use App\modelo\comprasModelo;
use App\modelo\gestionProveedoresModel;


$obj_model = new comprasModelo();
$obj_Proveedormodel = new gestionProveedoresModel();



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['consultar'])) {
 
  $compra = $obj_model->consultar();
  echo json_encode(['data' => $compra ?: []]);
  exit;

}


  if (isset($_POST['buscar'])) {
        $obj_model->set_id_compra($_POST['id_compra']);
        $compra = $obj_model->buscar();
        echo json_encode(['status' => true, "datos" => $compra]);
        exit;
    }



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['enviar_compra'])) {

    $respuesta = []; 

    $obj_model->set_cod_proveedor($_POST['cod_proveedor']);
    $obj_model->set_cedula_empleado($_POST['cedula_empleado']);
    $obj_model->set_Detalle_Compra($_POST['Detalle_Compra']);
    $obj_model->set_Cantidad($_POST['Cantidad']);
    $obj_model->set_Costo($_POST['Costo']);
    $obj_model->set_Fecha_Compra($_POST['Fecha_Compra']);

// Ejecución del modelo y preparación de la respuesta
    if ($obj_model->confirmarRegistro()) {

        $respuesta['success'] = true;
        $respuesta['message'] = "✅ Compra registrada correctamente.";
    } else {
        $respuesta['success'] = false;
        $respuesta['message'] = "❌Registro de compra fallido.";
    }

    header('Content-Type: application/json');
    echo json_encode($respuesta);
    exit; 
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




if (isset($_POST['eliminar']) && isset($_POST['id_compra'])) {
    $id_a_eliminar = $_POST['id_compra'];
    $obj_model->set_id_compra($id_a_eliminar);

    $respuesta = [];

    if ($obj_model->eliminar()) {
        $respuesta['success'] = true;
        $respuesta['message'] = "Compra eliminada correctamente ✅  ";
    } else {
        $respuesta['success'] = false;
        $respuesta['message'] = "Error al eliminar la compra ❌";
    }
    
    header('Content-Type: application/json');
    echo json_encode($respuesta);
    exit; 
}





if (isset($_POST['seleccion'])) {
  $obj_model->set_id_compra($_POST['seleccion']);
  $editar_compra = $obj_model->buscar();
}


$compras = $obj_model->consultar();
$Proveedor = $obj_Proveedormodel->consultar();



require_once 'componentes/llamado_vistas.php'; ?>