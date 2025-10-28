<?php

require_once 'componentes/sesion.php';

use App\Modelo\tipoMantenimientoModel;

$object = new tipoMantenimientoModel();

// Función para enviar respuesta JSON
function sendJsonResponse($success, $message, $data = null)
{
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode([
        'success' => $success,
        'message' => $message,
        'data' => $data
    ]);
    exit();
}

// Función para manejar el resultado de una operación (éxito o error)
function handleOperationResult($success, $successMessage, $errorMessage, $isAjax)
{
    if ($isAjax) {
        sendJsonResponse($success, $success ? $successMessage : $errorMessage);
    } else {
        header('Location: index.php?url=tipoMantenimiento');
        exit();
    }
}

// Verificar si es una petición AJAX
$isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';

// CREAR
if (isset($_POST['enviarMTTO'])) {
    $nombre = $_POST['nombre_mtto'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';

    $object->set_Nombre_Tipo_mtto($nombre);
    $object->set_Descripcion($descripcion);

    if ($object->registrar()) {
        if ($isAjax) {
            sendJsonResponse(true, "Tipo de mantenimiento agregado correctamente");
        } else {
            header('Location: index.php?url=tipoMantenimiento');
            exit();
        }
    } else {
        if ($isAjax) {
            sendJsonResponse(false, "Error al agregar tipo de mantenimiento");
        } else {
            header('Location: index.php?url=tipoMantenimiento');
            exit();
        }
    }
    $success = $object->registrar();
    handleOperationResult($success, "Tipo de mantenimiento agregado correctamente", "Error al agregar tipo de mantenimiento", $isAjax);
}

// ELIMINAR (acción desde modal)
if (isset($_POST['EliminarMTTO'])) {
    $id = $_POST['id_tipo_mantenimiento'] ?? null;
    $object->set_Id_Tipo_Mtto($id);
    echo json_encode($id);

    if ($object->eliminar()) {
        if ($isAjax) {
            sendJsonResponse(true, "Tipo de mantenimiento eliminado correctamente");
        } else {
            header('Location: index.php?url=tipoMantenimiento');
            exit();
        }
    } else {
        if ($isAjax) {
            sendJsonResponse(false, "Error al eliminar tipo de mantenimiento");
        } else {
            header('Location: index.php?url=tipoMantenimiento');
            exit();
        }
    }
    $success = $object->eliminar();
    // La siguiente línea estaba causando una respuesta JSON inválida. La he eliminado.
    // echo json_encode($id); 
    handleOperationResult($success, "Tipo de mantenimiento eliminado correctamente", "Error al eliminar tipo de mantenimiento", $isAjax);
}

// EDITAR
if (isset($_POST['editarMTTO'])) {
    $id = $_POST['id_tipo_mantenimiento'] ?? null;
    $nombre = $_POST['nombre_mtto'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';

    $object->set_Id_Tipo_Mtto($id);
    $object->set_Nombre_Tipo_mtto($nombre);
    $object->set_Descripcion($descripcion);

    if ($object->modificar()) {
        if ($isAjax) {
            sendJsonResponse(true, "Tipo de mantenimiento actualizado correctamente");
        } else {
            header('Location: index.php?url=tipoMantenimiento');
            exit();
        }
    } else {
        if ($isAjax) {
            sendJsonResponse(false, "Error al actualizar tipo de mantenimiento");
        } else {
            header('Location: index.php?url=tipoMantenimiento');
            exit();
        }
    }
    $success = $object->modificar();
    handleOperationResult($success, "Tipo de mantenimiento actualizado correctamente", "Error al actualizar tipo de mantenimiento", $isAjax);
}

if (isset($_POST['getTipoMTTO'])) {
    $tipo_mantenimiento = $object->consultar();
    echo json_encode($tipo_mantenimiento);
    exit();
}

$tipo_mantenimiento = $object->consultar();

require_once 'componentes/llamado_vistas.php';
?>