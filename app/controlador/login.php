<?php

use App\modelo\gestionUsuariosModel;

session_start();


if (isset($_SESSION["usuario"])) {
  unset($_SESSION["usuario"]);
}


if (isset($_POST['login'])) {

  $obj_usuarios = new gestionUsuariosModel();

  $norCorreo = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
  $norCedula = "/^[0-9]{7,10}$/";
  $valido = true;

  if (preg_match($norCorreo, $_POST['usuario']) == 0) {
    $errorBackebd = "El correo no cumple con el formato";
    $valido = false;
  } else if (preg_match($norCedula, $_POST['clave']) == 0) {
    $errorBackebd = "La cédula debe contener entre 7 y 10 dígitos";
    $valido = false;
  }

  if ($valido) {
    $obj_usuarios->set_correo($_POST['usuario']);
    $obj_usuarios->set_clave($_POST['clave']);

    $usuario = $obj_usuarios->login();

    if (isset($usuario)) {
      $_SESSION["usuario"] = $usuario;
      header('Location: ?url=inicio');
      exit();
    } else {
      $error = "Correo o cédula incorrecta";
    }
  }
}
require_once 'componentes/llamado_vistas.php';

?>

