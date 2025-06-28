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
  private $Empleado_Responsable;
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
  function set_Empleado_Responsable($valor)
  {
    $this->Empleado_Responsable = $valor;
  }
  function set_Tipo_MTTO($valor)
  {
    $this->Tipo_MTTO = $valor;
  }
  function set_Estado_MTTO($valor)
  {
    $this->Estado_MTTO = $valor;
  }

  function registrar()
  {

    try {
      //Agg estatu para eliminacion logica

      $sql = "INSERT INTO `activo_mantenimiento` 
(`id_mantenimiento`, `id_activo`, `id_tipo_mantenimiento`, `cedula_empleado`, `Estado`, `Fecha`, `Status`)     
VALUES (Null, :Id_Activo, :Tipo_MTTO, :cedula_empleado, 'PENDIENTE', Now(), 1)";
      $query = $this->conex->prepare($sql);
      $query->bindParam(':Id_Activo', $this->Id_Activo);
      $query->bindParam(':Tipo_MTTO', $this->Tipo_MTTO);
      $query->bindParam(':cedula_empleado', $this->Empleado_Responsable);
      return $query->execute();

    } catch (PDOException $e) {
      return false;
    }

  }

   function consultar()
  {
    try {
      $sql = "SELECT 
      activo_mantenimiento.id_mantenimiento, 
      activos.Nombre_Activo AS nombre_activo, 
      activos.id_activo,
      activo_mantenimiento.cedula_empleado, 
      tipo_mantenimiento.Nombre AS tipo_mtto,
      activo_mantenimiento.Estado, 
      activo_mantenimiento.Fecha
    FROM activo_mantenimiento
      LEFT JOIN activos ON activo_mantenimiento.id_activo = activos.id_activo
      LEFT JOIN tipo_mantenimiento ON activo_mantenimiento.id_tipo_mantenimiento = tipo_mantenimiento.id_tipo_mantenimiento
    WHERE activo_mantenimiento.Status = 1";
      $query = $this->conex->prepare($sql);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      return null;
    }
  }

function modificar($ID_MTTO)
  {
    try {
      $sql = "UPDATE activo_mantenimiento
            SET cedula_empleado = :Empleado_Responable,
                id_tipo_mantenimiento = :Tipo_MTTO,
                Estado = :Estado_MTTO
            WHERE id_mantenimiento = :ID_MTTO";
      $query = $this->conex->prepare($sql);
      $query->bindParam(':Empleado_Responable', $this->Empleado_Responsable);
      $query->bindParam(':Tipo_MTTO', $this->Tipo_MTTO);
      $query->bindParam(':Estado_MTTO', $this->Estado_MTTO);
      $query->bindParam(':ID_MTTO', $ID_MTTO);
      return $query->execute();
    } catch (PDOException $e) {
      return false;
    }
  }


  function buscar()
  {
    try {
      $sql = "SELECT * FROM activo_mantenimiento WHERE id_mantenimiento = :ID_MTTO";
      $query = $this->conex->prepare($sql);
      $query->bindParam(':ID_MTTO', $this->ID_MTTO);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      return null;
    }
  }


  function eliminar()
  {
    try {      //cambie DALETE POR UPDATE PARA LA ELIMINACION LOGICA
      $sql = "UPDATE activo_mantenimiento SET Status = 0 WHERE id_mantenimiento = :ID_MTTO";
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