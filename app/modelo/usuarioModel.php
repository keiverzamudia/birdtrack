<?php
 namespace App\modelo;
use \App\conexion\conexion;
use PDO; 
use PDOException;

class usuarioModel  extends conexion{
  protected $con;
  private $id_usuario;
  private $cedula;
  private $nombre;
  private $apellido;
  private $telefono;
  private $correo;
  private $clave;
  private $rol;

  function set_id_usuario($valor)
  {
    $this->id_usuario = $valor;
  }
  function set_cedula($valor)
  {
    $this->cedula = $valor;
  }
  function set_nombre($valor)
  {
    $this->nombre = $valor;
  }
  function set_apellido($valor)
  {
    $this->apellido = $valor;
  }
  function set_telefono($valor)
  {
    $this->telefono = $valor;
  }
  function set_correo($valor)
  {
    $this->correo = $valor;
  }
  function set_clave($valor)
  {
    $this->clave = $valor;
  }
  function set_rol($valor)
  {
    $this->rol = $valor;
  }

  function login() {
    try {
      $sql = "SELECT * FROM usuario WHERE correo = :correo AND cedula = :cedula";

      $query = $this->conex->prepare($sql);
      $query->bindParam(':correo', $this->correo);
      $query->bindParam(':cedula', $this->cedula);
      $query->execute();


   if ($query->rowCount() > 0) {
        return $query->fetch(PDO::FETCH_ASSOC);
      } else {
        return null;
      }
    } catch (\PDOException $e) {
      return false;
    }
  }
}
