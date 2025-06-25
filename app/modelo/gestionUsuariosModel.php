<?php
namespace App\modelo;
// require_once 'app/conexion/conexion.php';
use App\conexion\conexion;
use PDO;
use PDOException;

class gestionUsuariosModel extends conexion {

  private $ID_Activo;

  private $cedula;
  private $nombre;  
  private $departamento;
  private $cargo;
  private $correo;
  private $clave;


  function set_cedula($valor){
    $this->cedula = $valor;
  }
  function set_nombre($valor){
    $this->nombre = $valor;
  }
  function set_departamento($valor){
    $this->departamento = $valor;
  }
  function set_cargo($valor){
    $this->cargo = $valor;
  }
  function set_correo($valor){
    $this->correo = $valor;
  }
  function set_clave($valor){
    $this->clave = $valor;
  }
  function __construct(){
    parent::__construct();
  }

  
  function registrar(){
    try {
      $sql = "INSERT INTO empleado (cedula, nombre, departamento, cargo, correo, clave, status) 
              VALUES (:cedula, :nombre, :departamento, :cargo, :correo, :clave , 1)";
      $query = $this->conex->prepare($sql);
      $query->bindParam(':cedula', $this->cedula);
      $query->bindParam(':nombre', $this->nombre);
      $query->bindParam(':departamento', $this->departamento);
      $query->bindParam(':cargo', $this->cargo);
      $query->bindParam(':correo', $this->correo);
      $query->bindParam(':clave', $this->clave);
      return $query->execute();
    } catch (PDOException $e) {
      return false;
    }
  }
  
  function consultar(){
    try {
      $sql = "SELECT * FROM empleado WHERE status = 1";
      $query = $this->conex->prepare($sql);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      return null;
    }
  }

  function modificar($cedula){
    try {
      $sql = "UPDATE empleado
              SET cedula = :cedula,
                  nombre = :nombre,
                  departamento = :departamento,
                  cargo = :cargo,
                  correo = :correo,
                  clave = :clave
              WHERE cedula = :cedula";
      $query = $this->conex->prepare($sql);
      $query->bindParam(':cedula', $cedula);
      $query->bindParam(':nombre', $this->nombre);
      $query->bindParam(':departamento', $this->departamento);
      $query->bindParam(':cargo', $this->cargo);
      $query->bindParam(':correo', $this->correo);
      $query->bindParam(':clave', $this->clave);
      return $query->execute();
    } catch (PDOException $e) {
      return false;
    }
  }
  
  
  function buscar(){
    try {
      $sql = "SELECT * FROM empleado WHERE cedula = :cedula";
      $query = $this->conex->prepare($sql);
      $query->bindParam(':cedula', $this->cedula);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      return null;
    }
  }
  
  function eliminar(){
    try {

      $sql = "UPDATE empleado SET status = 0 WHERE cedula = :cedula";
      $query = $this->conex->prepare($sql);
      $query->bindParam(':cedula', $this->cedula);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      return false;
    }
  }
}





?>