<?php

namespace App\modelo;

use App\conexion\conexion;
use App\interfaces\laInterface;
use PDO;
use PDOException;

class asignacionActivoModel extends conexion
{

  private $id_asignacion;
  private $id_activo;

  private $cedula_empleado ;
  private $Descripcion_Asignacion;
  private $Fecha_asignacion;



  function set_id_asignacion($valor)
  {
    $this->id_asignacion = $valor;
  }

  function get_id_asignacion()
  {
    return $this->id_asignacion;
  }

  function set_id_activo($valor)
  {
    $this->id_activo = $valor;
  }
  function set_cedula_empleado($valor)
  {
    $this->cedula_empleado = $valor;
  }
  function set_Descripcion_Asignacion($valor)
  {
    $this->Descripcion_Asignacion = $valor;
  }
  function set_Fecha_asignacion($valor)
  {
    $this->Fecha_asignacion = $valor;
  }



  function registrar()
  {
    try {
      $sql = "INSERT INTO asignacion ( id_activo, cedula_empleado, Descripcion_Asignacion, Fecha_asignacion,Status) VALUES (:id_activo, :cedula_empleado, :Descripcion_Asignacion, :Fecha_asignacion, 1)";
      $query = $this->conex->prepare($sql);
      $query->bindParam(':id_activo', $this->id_activo);
      $query->bindParam(':cedula_empleado', $this->cedula_empleado);
      $query->bindParam(':Descripcion_Asignacion', $this->Descripcion_Asignacion);
      $query->bindParam(':Fecha_asignacion',  $this->Fecha_asignacion);
      return $query->execute();
    } catch (PDOException $e) {
      return false;
    }
  }
  


  function consultar()
  {
    try {
      $sql = "SELECT ASI.*, E.*, AC.*
FROM asignacion AS ASI 
	LEFT JOIN empleado AS E ON ASI.cedula_empleado = E.cedula_empleado
	LEFT JOIN activos AS AC ON ASI.id_activo = AC.id_activo
  WHERE ASI.Status = 1";
      $query = $this->conex->prepare($sql);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      return null; // O lanzar la excepción para manejarla más arriba
    }
  }


  function modificar($id)
  {
    try {
      $sql = "UPDATE asignacion 
              SET id_activo  = :id_activo,
                  cedula_empleado  = :cedula_empleado,
                  Descripcion_Asignacion = :Descripcion_Asignacion,
                  Fecha_asignacion = :Fecha_asignacion
              WHERE id_asignacion  = :id";
      $query = $this->conex->prepare($sql);
      $query->bindParam(':id_activo', $this->id_activo);
      $query->bindParam(':cedula_empleado', $this->cedula_empleado);
      $query->bindParam(':Descripcion_Asignacion', $this->Descripcion_Asignacion);
      $query->bindParam(':Fecha_asignacion', $this->Fecha_asignacion);
      $query->bindParam(':id', $id);
      return $query->execute();
    } catch (PDOException $e) {
      return false;
    }
  }



  function buscar()
  {
    try {
      $sql = "SELECT * FROM asignacion WHERE id_asignacion = :id_asignacion";
      $query = $this->conex->prepare($sql);
      $query->bindParam(':id_asignacion', $this->id_asignacion);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      return null;
    }
  }


  function eliminar()
  {
    try {      //cambie DALETE POR UPDATE PARA LA ELIMINACION LOGICA
      $sql = "UPDATE asignacion SET status = 0 WHERE id_asignacion  = :id";
      $query = $this->conex->prepare($sql);
      $query->bindParam(':id', $this->id_asignacion);
      return $query->execute();
    } catch (PDOException $e) {
      return false;
    }
  }
}
