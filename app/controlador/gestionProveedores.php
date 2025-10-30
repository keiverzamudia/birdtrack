    <?php
    require_once 'componentes/sesion.php';

    use App\modelo\gestionProveedoresModel;

    $obj_proveedor = new gestionProveedoresModel();
    $proveedores = $obj_proveedor->consultar();

    if (isset($_POST['consultar'])) {
        header('Content-Type: application/json');
        echo json_encode($proveedores);
        exit();
    }

    if (isset($_POST['buscar'])) {
        $obj_proveedor->set_cod_proveedor($_POST['cod_proveedor']);
        $activo = $obj_model->buscar();
        echo json_encode(['status' => true, "datos" => $proveedores]);
        exit;
    }

    

    
if(isset($_POST['registrar'])){
  $$obj_proveedor->set_Nombre_Proveedor($_POST['Nombre_Proveedor']);
  $obj_proveedor->set_Direccion($_POST['Direccion']);
$obj_proveedor->set_Numero_telefono($_POST['Numero_telefono']);
  $obj_proveedor->set_Correo_elect($_POST['Correo_elect']);
  
  

  
 if($obj_proveedor->confirmarRegistro()) {
    $mensaje = "Activo registrado correctamente";
  } else {
    $mensaje = "Error al registrar el activo";
  }

  echo json_encode(['mensaje' => $mensaje]);
  exit();
}





    if (isset($_POST['editar_proveedor'])) {

        $obj_proveedor->set_cod_proveedor($_POST['cod_proveedor']);
        $obj_proveedor->set_Nombre_Proveedor($_POST['Nombre_Proveedor']);
        $obj_proveedor->set_Direccion($_POST['Direccion']);
        $obj_proveedor->set_Numero_telefono($_POST['Numero_telefono']);
        $obj_proveedor->set_Correo_elect($_POST['Correo_elect']);


        if ($obj_proveedor->confirmarModificacion()) {
            $mensaje = "Proveedor actualizado correctamente";
        } else {
            $mensaje = "Error al actualizar el proveedor";
        }

        echo json_encode(['message' => $mensaje]);
        exit();
    }



if (isset($_POST['eliminar']) && isset($_POST['cod_proveedor'])) {
    $id_a_eliminar = $_POST['cod_proveedor'];
    $obj_proveedor->set_cod_proveedor($id_a_eliminar);

    $respuesta = [];

    if ($obj_proveedor->eliminar()) {
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
    



    if (isset($_POST['seleccionar_proveedor'])) {
        $obj_proveedor->set_cod_proveedor($_POST['seleccionar_proveedor']);
        $editar_proveedor = $obj_proveedor->buscar();
        header('Content-Type: application/json');
        echo json_encode($editar_proveedor);
        exit();
    }



    require_once 'componentes/llamado_vistas.php';


    ?>