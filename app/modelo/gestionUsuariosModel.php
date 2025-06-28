<?php

namespace App\modelo;

use \App\conexion\conexion;
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
      $sql = "INSERT INTO empleado (cedula_empleado, Nombre_Empleado, id_departamento, id_cargo, correo_electronico,Fecha_creacion ,Status) 
              VALUES (:cedula, :nombre, :departamento, :cargo, :correo, NOW(), '1')";
      $query = $this->conex->prepare($sql);
      $query->bindParam(':cedula', $this->cedula);
      $query->bindParam(':nombre', $this->nombre);
      $query->bindParam(':departamento', $this->departamento);
      $query->bindParam(':cargo', $this->cargo);
      $query->bindParam(':correo', $this->correo);
      return $query->execute();
   } catch (PDOException $e) {
    return false;
   }
}
  
  function consultar(){
    try {
      $sql = "SELECT empleado.*, cargo.Nombre_Cargo AS Cargo, departamento.Nombre_Departamento AS Departamento
      FROM empleado 
	  INNER JOIN cargo ON empleado.id_cargo = cargo.id_cargo 
    INNER JOIN departamento ON empleado.id_departamento = departamento.id_departamento WHERE empleado.status = 1";
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
              SET cedula_empleado = :cedula,
                  Nombre_empleado = :nombre,
                  id_departamento = :departamento,
                  id_cargo = :cargo,
                  correo_electronico = :correo
                  
              WHERE cedula_empleado= :cedula";
      $query = $this->conex->prepare($sql);
      $query->bindParam(':cedula', $cedula);
      $query->bindParam(':nombre', $this->nombre);
      $query->bindParam(':departamento', $this->departamento);
      $query->bindParam(':cargo', $this->cargo);
      $query->bindParam(':correo', $this->correo);
     
      return $query->execute();
   } catch (PDOException $e) {
     return false;
   }
  }
  
  
  function buscar(){
    try {
      $sql = "SELECT * FROM empleado WHERE cedula_empleado = :cedula";
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

      $sql = "UPDATE empleado SET status = 0 WHERE cedula_empleado = :cedula";
      $query = $this->conex->prepare($sql);
      $query->bindParam(':cedula', $this->cedula);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      return false;
    }
  }

    
}

class CargoModel extends conexion {

  private $id_cargo;
  private $nombre_cargo;

  function set_id_cargo($valor){
    $this->id_cargo = $valor;
  }

  function set_nombre_cargo($valor){
    $this->nombre_cargo = $valor;
  }

  function consultarcargo(){
    try {
      $sql = "SELECT * FROM cargo WHERE status = 1";
      $query = $this->conex->prepare($sql);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      return null;
    }
  }


  function registrarcargo(){
    try {
      $sql = "INSERT INTO cargo(id_cargo, Nombre_Cargo) VALUES (null, :nombre )";
      $query = $this->conex->prepare($sql);
      $query->bindParam(':nombre', $this->nombre_cargo);
      return $query->execute();
    } catch (PDOException $e) {
    return false;
    }
  }

  function eliminarcargo(){
   try {
     $sql = "UPDATE cargo SET status = 0 WHERE id_cargo = :id";
     $query = $this->conex->prepare($sql);
     $query->bindParam(':id', $this->id_cargo);
     return $query->execute();
    } catch (PDOException $e) {
      return false;
     }
   }
  function modificarCargo(){
    try {
      $sql = "UPDATE cargo SET Nombre_Cargo = :nombre WHERE id_cargo = :id_cargo";
      $query = $this->conex->prepare($sql);
      $query->bindParam(':nombre', $this->nombre_cargo);
      $query->bindParam(':id_cargo', $this->id_cargo);
      return $query->execute();
    } catch (PDOException $e) {
      return false;
    }
  }

}

class DepartamentoModel extends conexion {

  private $id_departamento;
  private $nombre_departamento;
  private $descripcion_departamento;

  function set_id_departamento($valor){
    $this->id_departamento = $valor;
  }

  function set_nombre_departamento($valor){
    $this->nombre_departamento = $valor;
  }

  function set_descripcion_departamento($valor){
    $this->descripcion_departamento = $valor;
  }

   function consultardep(){
    try {
      $sql = "SELECT * FROM departamento WHERE Status = 1";
      $query = $this->conex->prepare($sql);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      return null;
    }
  }
   function registrarDep(){
    try {
      $sql =$sql = "INSERT INTO departamento(id_departamento, Nombre_Departamento, Descripcion_Departamento, Status) 
        VALUES (null, :nombre, :descripcion, '1')";
      $query = $this->conex->prepare($sql);
      $query->bindParam(':nombre', $this->nombre_departamento);
      $query->bindParam(':descripcion', $this->descripcion_departamento);
      return $query->execute();
    } catch (PDOException $e) {
    return false;
    }
  }
  
  
  function eliminarDep(){
   try {
     $sql = "UPDATE departamento SET Status = 0 WHERE id_departamento = :id";
     $query = $this->conex->prepare($sql);
     $query->bindParam(':id', $this->id_departamento);
     return $query->execute();
    } catch (PDOException $e) {
      return false;
     }
   }
  function modificarDep() {
  try {
    $sql = "UPDATE departamento 
            SET Nombre_Departamento = :nombre, Descripcion_Departamento = :descripcion 
            WHERE id_departamento = :id_departamento";
    
    $query = $this->conex->prepare($sql);
    $query->bindParam(':nombre', $this->nombre_departamento);
    $query->bindParam(':descripcion', $this->descripcion_departamento);
    $query->bindParam(':id_departamento', $this->id_departamento);
    
    return $query->execute();
  } catch (PDOException $e) {
    return false;
  }
}
}








?>