<?php

namespace App\Modelo;
use App\conexion\conexion;
use PDO;
use PDOException;

class GestionMantenimientoModel extends conexion
{
  private $ID_MTTO;
  private $Nombre_Activo;
  private $Id_Activo;
  private $Empleado_Responable;
  private $Tipo_MTTO;
  private $Estado_MTTO;

  function set_Id_Activo($valor)
  {
    $this->Id_Activo = $valor;
  }
    function set_ID_MTTO($valor)
  {
    $this->ID_MTTO = $valor;
  }
  function set_Nombre_Activo($valor)
  {
    $this->Nombre_Activo = $valor;
  }
  function set_Empleado_Responable($valor)
  {
    $this->Empleado_Responable = $valor;
  }
  function set_Tipo_MTTO($valor)
  {
    $this->Tipo_MTTO = $valor;
  }
  function set_Estado_MTTO($valor)
  {
    $this->Estado_MTTO = $valor;
  }

  function registrar(){

    try {                                         //Agg estatu para eliminacion logica
      $sql = "INSERT INTO registro_mantenimiento( Nombre_Activo, Id_Activo, Empleado_Responable,Estado_MTTO, Tipo_MTTO,Fecha_Registro, status) 
              VALUES (:Nombre_Activo, :Id_Activo, :Empleado_Responable,:Estado_MTTO,:Tipo_MTTO, Now(),1)";
      $query = $this->conex->prepare($sql);
      $query->bindParam(':Nombre_Activo', $this->Nombre_Activo);
      $query->bindParam(':Id_Activo', $this->Id_Activo);
      $query->bindParam(':Empleado_Responable', $this->Empleado_Responable);
      $query->bindParam(':Tipo_MTTO', $this->Tipo_MTTO);
      $query->bindParam(':Estado_MTTO', $this->Estado_MTTO);

      return $query->execute();

    } catch (PDOException $e) {
      return false;
    }

  }

    function consultar(){
    try {
      $sql = "SELECT * FROM registro_mantenimiento WHERE status = 1";
      $query = $this->conex->prepare($sql);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      return null;
    }
  }

function modificar($ID_MTTO){
  try {
    $sql = "UPDATE registro_mantenimiento
            SET Empleado_Responable = :Empleado_Responable,
                Tipo_MTTO = :Tipo_MTTO,
                Estado_MTTO = :Estado_MTTO
            WHERE ID_MTTO = :ID_MTTO";
    $query = $this->conex->prepare($sql);
    $query->bindParam(':Empleado_Responable', $this->Empleado_Responable);
    $query->bindParam(':Tipo_MTTO', $this->Tipo_MTTO);
    $query->bindParam(':Estado_MTTO', $this->Estado_MTTO);
    $query->bindParam(':ID_MTTO', $ID_MTTO);
    return $query->execute();
  } catch (PDOException $e) {
    return false;
  }
}


  function buscar(){
    try {
      $sql = "SELECT * FROM registro_mantenimiento WHERE ID_MTTO = :ID_MTTO";
      $query = $this->conex->prepare($sql);
      $query->bindParam(':ID_MTTO', $this->ID_MTTO);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      return null;
    }
  }


  function eliminar(){
    try {      //cambie DALETE POR UPDATE PARA LA ELIMINACION LOGICA
      $sql = "UPDATE registro_mantenimiento SET status = 0 WHERE ID_MTTO = :ID_MTTO";
      $query = $this->conex->prepare($sql);
      $query->bindParam(':ID_MTTO', $this->ID_MTTO);
      return $query->execute();
    } catch (PDOException $e) {
      return false;
    }
  }



}
?>

?>