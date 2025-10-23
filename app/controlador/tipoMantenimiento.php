<?php
require_once 'componentes/sesion.php';
use App\Modelo\tipoMantenimientoModel;

$obj_tipoMantenimiento = new tipoMantenimientoModel();

if (isset($_POST['enviar'])) {
    //print_r($_POST);
    $obj_tipoMantenimiento->set_nombre_tipo_mtto($_POST['nombre_mtto']);
    $obj_tipoMantenimiento->set_descripcion($_POST['descripcion']);
    if ($obj_tipoMantenimiento->registrar()) {
        $mensaje = "Tipo de mantenimiento registrado correctamente";
    } else {
        $mensaje = "Error al registrar el tipo de mantenimiento";
    }
    header("Location: index.php?url=tipoMantenimiento");
    exit();


}

if (isset($_POST['Eliminar'])) {
    $obj_tipoMantenimiento->set_ID_TIPO_MTTO($_POST['id_tipo_mantenimiento']);
    if ($obj_tipoMantenimiento->eliminar()) {
        $mensaje = "Tipo de mantenimiento eliminado correctamente";
    } else {
        $mensaje = "Error al eliminar el tipo de mantenimiento";
    }

    header("Location: index.php?url=tipoMantenimiento");
    exit();
}

if (isset($_POST['editar'])) {
    // print_r($_POST);
    $obj_tipoMantenimiento->set_ID_TIPO_MTTO($_POST['editar']);
    $obj_tipoMantenimiento->set_nombre_tipo_mtto($_POST["nombre_mtto"]);
    $obj_tipoMantenimiento->set_descripcion($_POST["descripcion"]);


    if ($obj_tipoMantenimiento->modificar()) {
        $mensaje = "Tipo de mantenimiento actualizado correctamente";
    } else {
        $mensaje = "Error al actualizar el tipo de mantenimiento";
    }

    header("Location: index.php?url=tipoMantenimiento");
    exit();
}

if (isset($_POST['seleccion'])) {
    $tipo_mantenimiento = $obj_tipoMantenimiento->consultar();
}
$tipo_mantenimiento = $obj_tipoMantenimiento->consultar();

require_once 'componentes/llamado_vistas.php';
?>