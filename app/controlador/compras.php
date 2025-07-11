<?php
use App\modelo\comprasModelo;
use App\modelo\gestionProveedoresModel;
use App\modelo\EncagadoModel;

$obj_model = new comprasModelo();
$obj_Proveedormodel = new gestionProveedoresModel();



if (isset($_POST['enviar_compra'])) {

  $mensaje = "Formulario incompleto, por favor complete todos los campos";
  
  if (
    !empty($_POST['cod_proveedor']) &&
    !empty($_POST['cedula_empleado']) &&
    !empty($_POST['Detalle_Compra']) &&
    !empty($_POST['Cantidad']) &&
    !empty($_POST['Costo']) &&
    !empty($_POST['Fecha_Compra'])
  ) {

    $obj_model->set_cod_proveedor($_POST['cod_proveedor']);
    $obj_model->set_cedula_empleado($_POST['cedula_empleado']);
    $obj_model->set_Detalle_Compra($_POST['Detalle_Compra']);
    $obj_model->set_Cantidad($_POST['Cantidad']);
    $obj_model->set_Costo($_POST['Costo']);
    $obj_model->set_Fecha_Compra($_POST['Fecha_Compra']);
      
  
    if ($obj_model->registrar()) {
      $_SESSION['mensaje_exito'] = "Nueva Compra Registrada correctamente";
    } else {
        $_SESSION['mensaje_error'] = "Error al Registrar Compra";
  }
  } else {
    echo "<script>alert('Por favor, complete todos los campos al formulario');</script>";
    // No redirigir aún
  }
  header('Location: index.php?url=compras');
  exit();
}






if (isset($_POST['editar_compra'])) {
  $obj_model->set_id_compra( $id_compra = $_POST['id_compra']);
  $obj_model->set_cod_proveedor($_POST['cod_proveedor']);
  $obj_model->set_cedula_empleado($_POST['cedula_empleado']);
  $obj_model->set_Detalle_Compra($_POST['Detalle_Compra']);
  $obj_model->set_Costo($_POST['Costo']);
  $obj_model->set_Cantidad($_POST['Cantidad']);
  $obj_model->set_Fecha_Compra($_POST['Fecha_Compra']);

  if ($obj_model->modificar($_POST['id_compra'])) {
    $_SESSION['mensaje_error'] = "Error al Editar la Compra";
  } else {
    $_SESSION['mensaje_exito'] = "Compra Editada correctamente";

}

}






if (isset($_POST['eliminar'])) {
  $obj_model->set_id_compra($_POST['eliminar']);
   
  if ($obj_model->eliminar()) {
    $_SESSION['mensaje_exito'] = "Compra Eliminada correctamente";
  } else {
      $_SESSION['mensaje_error'] = "Error al Eliminar Compra";
}
   $compras = $obj_model->consultar();

}


  
if (isset($_POST['seleccion'])) {
  $obj_model->set_id_compra($_POST['seleccion']);
  $editar_compra = $obj_model->buscar();
}


$compras = $obj_model->consultar();
$Proveedor = $obj_Proveedormodel->consultarProveedor();



require_once 'componentes/llamado_vistas.php'; ?>