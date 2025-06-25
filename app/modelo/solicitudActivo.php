<?php
namespace App\modelo;
// require_once 'app/conexion/conexion.php';
use App\conexion\conexion;
use PDO;
use PDOException;

class solicitudActivo extends conexion {

  private $ID_Activo;

  private $Id_orden;
  private $Nombre_Activo;  
  private $Estado;
  private $Nombre_Usuario;
  private $Cedula;
  private $Fecha_de_Asignacion;
  private $ID_info;


  function set_ID_Activo($valor){
    $this->ID_Activo = $valor;
  }
  function set_Nombre_Activo($valor){
    $this->Nombre_Activo = $valor;
  }
  function set_Estado($valor){
    $this->Estado = $valor;
  }
  function set_Nombre_Usuario($valor){
    $this->Nombre_Usuario = $valor;
  }
  function set_Cedula($valor){
    $this->Cedula = $valor;
  }
  function set_id($valor){
    $this->Id_orden = $valor;
  }
  function __construct(){
    parent::__construct();
  }

  
  function registrar(){
    try {
      $sql = "INSERT INTO solicitud(ID_Activo, Nombre_Activo, Estado, Nombre_Usuario, Cedula, Fecha_de_Asignacion,status) 
              VALUES (:ID_Activo, :Nombre_Activo, :Estado, :Nombre_Usuario, :Cedula,NOW(),1)";
      $query = $this->conex->prepare($sql);
      $query->bindParam(':ID_Activo', $this->ID_Activo);
      $query->bindParam(':nombre_activo', $this->Nombre_Activo);
      $query->bindParam(':estado', $this->Estado);
      $query->bindParam(':nombre_usuario', $this->Nombre_Usuario);
      $query->bindParam(':cedula', $this->Cedula);
      return $query->execute();
    } catch (PDOException $e) {
      return false;
    }
  }
  
  function consultar(){
  try {
      $sql = "SELECT * FROM solicitud WHERE status = 1";
      $query = $this->conex->prepare($sql);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      return null;
    }
  }
  
  function modificar($id){
    try {
      $sql = "UPDATE solicitud 
              SET ID_Activo = :id_activo,
                  Nombre_Activo = :nombre_activo,
                  Estado = :estado,
                  Nombre_Usuario = :nombre_usuario,
                  Cedula = :cedula
              WHERE Id_orden = :id";
      $query = $this->conex->prepare($sql);
      $query->bindParam(':id_activo', $this->ID_Activo);
      $query->bindParam(':nombre_activo', $this->Nombre_Activo);
      $query->bindParam(':estado', $this->Estado);
      $query->bindParam(':nombre_usuario', $this->Nombre_Usuario);
      $query->bindParam(':cedula', $this->Cedula);
      $query->bindParam(':id', $id);
      return $query->execute();
    } catch (PDOException $e) {
      return false;
    }
  }
  
  
  function buscar(){
    try {
      $sql = "SELECT * FROM solicitud WHERE Id_orden = :id";
      $query = $this->conex->prepare($sql);
      $query->bindParam(':id', $this->Id_orden);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      return null;
    }
  }
  

  function eliminar(){
    try {      //cambie DALETE POR UPDATE PARA LA ELIMINACION LOGICA
      $sql = "UPDATE solicitud SET status = 0 WHERE Id_orden = :id";
      $query = $this->conex->prepare($sql);
      $query->bindParam(':id', $this->Id_orden);
      return $query->execute();
    } catch (PDOException $e) {
      return false;
    }
  }


}




?>