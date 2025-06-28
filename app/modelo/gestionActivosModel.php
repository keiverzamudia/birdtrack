<?php

namespace App\modelo;

use \App\conexion\conexion;
use PDO;
use PDOException;

class gestionActivosModel extends conexion {

  private $id_activo;

  private $id_tipo;

  private $id_ubicacion;
  private $nombre;
  private $descripcion;
  private $fecha_adquisicion;

  private $status; 

  function set_id_activo($valor){
    $this->id_activo = $valor;
  }

   function set_id_ubicacion($valor){
    $this->id_ubicacion = $valor;
  }

  function set_id_tipo($valor){
    $this->id_tipo = $valor;
  }
 
  function set_nombre($valor){
    $this->nombre = $valor;
  }
  function set_descripcion($valor){
    $this->descripcion = $valor;
  }
  function set_fecha_adquisicion($valor){
    $this->fecha_adquisicion = $valor;
  }
 

  function registrar(){

    try {                                         //Agg estatu para eliminacion logica
      $sql = "INSERT INTO activos(id_activo, id_tipo_activo, id_ubicacion, Nombre_Activo, Descripcion_Activo, Estado_Activo, fecha_adquisicion, Status) 
              VALUES (null, :id_tipo, :id_ubicacion, :nombre, :descripcion, Estado_Activo, :fecha_adquisicion, 1)";
      $query = $this->conex->prepare($sql);
      $query->bindParam(':id_tipo', $this->id_tipo);
      $query->bindParam(':id_ubicacion', $this->id_ubicacion);
      $query->bindParam(':nombre', $this->nombre);
      $query->bindParam(':descripcion', $this->descripcion);
      $query->bindParam(':fecha_adquisicion', $this->fecha_adquisicion);
    
      return $query->execute();

    } catch (PDOException $e) {
      return false;
    }

  }

  function consultar(){
    try {                                //Agg el WHERE para Eliminacion logica
      $sql = "SELECT activos.*, tipo_activos.Nombre AS tipo, ubicacion_activos.Nombre as ubicacion FROM activos
      JOIN tipo_activos ON activos.id_tipo_activo = tipo_activos.id_tipo_activo 
      JOIN ubicacion_activos ON activos.id_ubicacion = ubicacion_activos.id_Ubicacion 
      WHERE activos.status = 1";
      $query = $this->conex->prepare($sql);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      return null;
    }
  }

function modificar($id){
  try {
    $sql = "UPDATE activos
            SET id_tipo_activo = :id_tipo,
                id_ubicacion = :id_ubicacion,
                Nombre_Activo = :Nombre,
                Descripcion_Activo = :descripcion,
                fecha_adquisicion = :fecha_adquisicion
            WHERE id_activo = :id";
    $query = $this->conex->prepare($sql);
    $query->bindParam(':id_tipo', $this->id_tipo);
    $query->bindParam(':id_ubicacion', $this->id_ubicacion);
    $query->bindParam(':Nombre', $this->nombre);
    $query->bindParam(':descripcion', $this->descripcion);
    $query->bindParam(':fecha_adquisicion', $this->fecha_adquisicion);
    $query->bindParam(':id', $id);
    return $query->execute();
  } catch (PDOException $e) {
    return false;
  }
}

  function buscar(){
    try {
      $sql = "SELECT * FROM activos WHERE id_activo = :id";
      $query = $this->conex->prepare($sql);
      $query->bindParam(':id', $this->id_activo);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      return null;
    }
  }

  function eliminar(){
    try {      //cambie DALETE POR UPDATE PARA LA ELIMINACION LOGICA
      $sql = "UPDATE activos SET Status = 0 WHERE id_activo = :id";
      $query = $this->conex->prepare($sql);
      $query->bindParam(':id', $this->id_activo);
      return $query->execute();
    } catch (PDOException $e) {
      return false;
    }
  }

  //lo agg hoy 24
  function cargarTiposActivos(){
    try {
        $sql = "SELECT * FROM tipo_activos WHERE Status = 1 ORDER BY Nombre ASC";
        $query = $this->conex->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        
        return null;
    }
  }
//lo agg hoy 24
 function cargarUbicaciones(){
        try {
            $sql = "SELECT id_ubicacion, nombre FROM ubicacion_activos ORDER BY nombre ASC";
            $query = $this->conex->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            
            return null;
        }
    }
}

class TipoActivoModel extends conexion {

  private $id_tipo;
  private $nombre_tipo;
  private $descripcion_tipo;

  function set_id_tipo($valor){
    $this->id_tipo = $valor;
  }

  function set_nombre_tipo($valor){
    $this->nombre_tipo = $valor;
  }
  function set_descripcion_tipo($valor){
    $this->descripcion_tipo = $valor;
  }

  function registrarTipoActivo(){
   try {
      $sql = "INSERT INTO tipo_activos(id_tipo_activo, Nombre, Descripcion_tipo, Status) VALUES (null, :nombre, :descripcion, 1)";
      $query = $this->conex->prepare($sql);
      $query->bindParam(':nombre', $this->nombre_tipo);
      $query->bindParam(':descripcion', $this->descripcion_tipo);
      return $query->execute();
    } catch (PDOException $e) {
      return false;
    }
  }

  function eliminarTipoActivo(){
    try {
      $sql = "UPDATE tipo_activos SET Status = 0 WHERE id_tipo_activo = :id_tipo";
      $query = $this->conex->prepare($sql);
      $query->bindParam(':id_tipo', $this->id_tipo);
      return $query->execute();
    } catch (PDOException $e) {
      return false;
    }
  }
function editarTipoActivo(){
    try {
      $sql = "UPDATE tipo_activos SET Nombre = :nombre_tipo, Descripcion_tipo = :descripcion WHERE id_tipo_activo = :id_tipo";
      $query = $this->conex->prepare($sql);
      $query->bindParam(':nombre_tipo', $this->nombre_tipo);
      $query->bindParam(':descripcion', $this->descripcion_tipo);
      $query->bindParam(':id_tipo', $this->id_tipo);
      return $query->execute();
    } catch (PDOException $e) {
      return false;
    }
  }

}




