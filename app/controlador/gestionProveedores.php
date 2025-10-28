<?php
require_once 'componentes/sesion.php';
use App\modelo\gestionProveedoresModel;

$obj_proveedor = new gestionProveedoresModel();
$proveedores = $obj_proveedor->consultar();



if (isset($_POST['registrar'])) {

    $obj_proveedor->set_Nombre_Proveedor($_POST['Nombre_Proveedor']);
    $obj_proveedor->set_Direccion($_POST['Direccion']);
    $obj_proveedor->set_Numero_telefono($_POST['Numero_telefono']);
    $obj_proveedor->set_Correo_elect($_POST['Correo_elect']);

    $mensaje = $obj_proveedor->confirmarRegistro()
        ? "Proveedor registrado correctamente"
        : "Error al registrar el proveedor";

    header('location: index.php?url=gestionProveedores');
    exit();
}



if (isset($_POST['editar_proveedor'])) {
   
    $obj_proveedor->set_cod_proveedor($_POST['cod_proveedor']);
    $obj_proveedor->set_Nombre_Proveedor($_POST['Nombre_Proveedor']);
    $obj_proveedor->set_Direccion($_POST['Direccion']);
    $obj_proveedor->set_Numero_telefono($_POST['Numero_telefono']);
    $obj_proveedor->set_Correo_elect($_POST['Correo_elect']);

   
   if ($obj_proveedor->confirmarModificacion($_POST['cod_proveedor'])) {
        $mensaje = "Proveedor actualizado correctamente";
    } else {
        $mensaje = "Error al actualizar el proveedor";
    } header('location: index.php?url=gestionProveedores');
    exit();
}

    


if (isset($_POST['eliminar'])) {
    $obj_proveedor->set_cod_proveedor($_POST['eliminar']);
    if ($obj_proveedor->eliminar()) {
        $mensaje = "Proveedor eliminado correctamente";
    } else {
        $mensaje = "Error al eliminar el proveedor";
    }

   
}




if (isset($_POST['seleccionar_proveedor'])) {
    $obj_proveedor->set_cod_proveedor($_POST['seleccionar_proveedor']);
    $editar_proveedor = $obj_proveedor->buscar();
}

$proveedores = $obj_proveedor->consultar();


require_once 'componentes/llamado_vistas.php'


    ?>