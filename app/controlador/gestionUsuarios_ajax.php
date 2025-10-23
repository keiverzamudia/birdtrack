<?php
require_once 'componentes/sesion.php';

use App\modelo\CargoModel;
use App\modelo\gestionUsuariosModel;
use App\modelo\DepartamentoModel;

$obj_model = new gestionUsuariosModel();
$obj_cargo = new CargoModel();
$obj_departamento = new DepartamentoModel();

// Función para enviar respuesta JSON
function sendJsonResponse($success, $message, $data = null) {
    header('Content-Type: application/json');
    echo json_encode([
        'success' => $success,
        'message' => $message,
        'data' => $data
    ]);
    exit();
}

// Verificar si es una petición AJAX
$isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
          strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';

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
        if($isAjax) {
            sendJsonResponse(true, "Empleado registrado correctamente");
        } else {
            $mensaje = "Empleado registrado correctamente";
            header('Location: index.php?url=gestionUsuarios');
            exit();
        }
    } else {
        if($isAjax) {
            sendJsonResponse(false, "Error al registrar empleado");
        } else {
            $mensaje = "Error al registrar empleado";
            header('Location: index.php?url=gestionUsuarios');
            exit();
        }
    }
}

if(isset($_POST['editar'])){
    $obj_model->set_cedula($_POST['cedula']);
    $obj_model->set_nombre($_POST['nombre']);
    $obj_model->set_departamento($_POST['departamento']);
    $obj_model->set_cargo($_POST['cargo']);
    $obj_model->set_correo($_POST['correo']);

    if($obj_model->modificar($_POST['editar'])) {
        if($isAjax) {
            sendJsonResponse(true, "Actualización realizada correctamente");
        } else {
            $mensaje = "Actualización realizada correctamente";
            header('Location: index.php?url=gestionUsuarios');
            exit();
        }
    } else {
        if($isAjax) {
            sendJsonResponse(false, "Error al actualizar registro del empleado");
        } else {
            $mensaje = "Error al actualizar registro del empleado";
            header('Location: index.php?url=gestionUsuarios');
            exit();
        }
    }
}

if(isset($_POST['eliminar'])){
    $obj_model->set_cedula($_POST['eliminar']);
    if($obj_model->eliminar()) {
        if($isAjax) {
            sendJsonResponse(true, "Empleado eliminado correctamente");
        } else {
            $mensaje = "Empleado eliminado correctamente";
            header('Location: index.php?url=gestionUsuarios');
            exit();
        }
    } else {
        if($isAjax) {
            sendJsonResponse(false, "Error al eliminar empleado");
        } else {
            $mensaje = "Error al eliminar empleado";
            header('Location: index.php?url=gestionUsuarios');
            exit();
        }
    }
}

if(isset($_POST['seleccion'])){
    $obj_model->set_cedula($_POST['seleccion']);
    $editar_usuario = $obj_model->buscar();
}

// CRUD de Cargos
if(isset($_POST['agregar_cargo'])){
    $obj_cargo->set_nombre_cargo($_POST['nombre_cargo']);
    if($obj_cargo->registrarcargo()) {
        if($isAjax) {
            sendJsonResponse(true, "Cargo agregado correctamente");
        } else {
            header('Location: index.php?url=gestionUsuarios');
            exit();
        }
    } else {
        if($isAjax) {
            sendJsonResponse(false, "Error al agregar cargo");
        } else {
            header('Location: index.php?url=gestionUsuarios');
            exit();
        }
    }
}

if(isset($_POST['eliminar_cargo'])){
    $obj_cargo->set_id_cargo($_POST['eliminar_cargo']);
    if($obj_cargo->eliminarcargo()) {
        if($isAjax) {
            sendJsonResponse(true, "Cargo eliminado correctamente");
        } else {
            header('Location: index.php?url=gestionUsuarios');
            exit();
        }
    } else {
        if($isAjax) {
            sendJsonResponse(false, "Error al eliminar cargo");
        } else {
            header('Location: index.php?url=gestionUsuarios');
            exit();
        }
    }
}

if(isset($_POST['editar_cargo'])){
    $obj_cargo->set_id_cargo($_POST['editar_cargo']);
    $obj_cargo->set_nombre_cargo($_POST['nombre_cargo']);
    if($obj_cargo->modificarCargo()) {
        if($isAjax) {
            sendJsonResponse(true, "Cargo actualizado correctamente");
        } else {
            header('Location: index.php?url=gestionUsuarios');
            exit();
        }
    } else {
        if($isAjax) {
            sendJsonResponse(false, "Error al actualizar cargo");
        } else {
            header('Location: index.php?url=gestionUsuarios');
            exit();
        }
    }
}

// CRUD de Departamentos
if(isset($_POST['agregar_departamento'])){
    $obj_departamento->set_nombre_departamento($_POST['nombre_departamento']);
    $obj_departamento->set_descripcion_departamento($_POST['descripcion_departamento']);
    if($obj_departamento->registrarDep()) {
        if($isAjax) {
            sendJsonResponse(true, "Departamento agregado correctamente");
        } else {
            header('Location: index.php?url=gestionUsuarios');
            exit();
        }
    } else {
        if($isAjax) {
            sendJsonResponse(false, "Error al agregar departamento");
        } else {
            header('Location: index.php?url=gestionUsuarios');
            exit();
        }
    }
}

if(isset($_POST['eliminar_departamento'])){
    $obj_departamento->set_id_departamento($_POST['eliminar_departamento']);
    if($obj_departamento->eliminarDep()) {
        if($isAjax) {
            sendJsonResponse(true, "Departamento eliminado correctamente");
        } else {
            header('Location: index.php?url=gestionUsuarios');
            exit();
        }
    } else {
        if($isAjax) {
            sendJsonResponse(false, "Error al eliminar departamento");
        } else {
            header('Location: index.php?url=gestionUsuarios');
            exit();
        }
    }
}

if(isset($_POST['editar_departamento'])){
    $obj_departamento->set_id_departamento($_POST['editar_departamento']);
    $obj_departamento->set_nombre_departamento($_POST['nombre_departamento']);
    $obj_departamento->set_descripcion_departamento($_POST['descripcion_departamento']);
    if($obj_departamento->modificarDep()) {
        if($isAjax) {
            sendJsonResponse(true, "Departamento actualizado correctamente");
        } else {
            header('Location: index.php?url=gestionUsuarios');
            exit();
        }
    } else {
        if($isAjax) {
            sendJsonResponse(false, "Error al actualizar departamento");
        } else {
            header('Location: index.php?url=gestionUsuarios');
            exit();
        }
    }
}

$usuarios = $obj_model->consultar();
$departamentos = $obj_departamento->consultardep();
$cargos = $obj_cargo->consultarcargo();

require_once 'componentes/llamado_vistas.php';
?>
