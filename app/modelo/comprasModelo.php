<?php

namespace App\modelo;
// require_once 'app/conexion/conexion.php';
use App\conexion\Conexion;
use App\interfaces\laInterface;
use PDO;
use PDOException;


class comprasModelo extends conexion implements laInterface
{
  private $id_compra;
  private $cod_proveedor;
  private $cedula_empleado;
  private $Detalle_Compra;
  private $Cantidad;
  private $Costo;
  private $Fecha_Compra;

  function set_id_compra($valor)
  {
    $this->id_compra = $valor;
  }
  function set_cod_proveedor($valor)
  {
    $this->cod_proveedor = $valor;
  }
  function set_cedula_empleado($valor)
  {
    $this->cedula_empleado = $valor;
  }
  function set_Detalle_Compra($valor)
  {
    $this->Detalle_Compra = $valor;
  }
  function set_Costo($valor)
  {
    $this->Costo = $valor;
  }
  function set_Cantidad($valor)
  {
    $this->Cantidad = $valor;
  }
  function set_Fecha_Compra($valor)
  {
    $this->Fecha_Compra = $valor;
  }


  public function validarDatos()
  {

    return !empty($this->cod_proveedor) &&
      !empty($this->cedula_empleado) &&
      !empty($this->Detalle_Compra) &&
      !empty($this->Cantidad) &&
      !empty($this->Costo) &&
      !empty($this->Fecha_Compra);
  }
  

  public function confirmarRegistro()
  {
    return $this->registrar();
  }

  
  private function registrar()
  {
    if (!$this->validarDatos()) {
      return false;
    }

    try {
      $sql = "INSERT INTO compra(cod_proveedor, cedula_empleado, Detalle_Compra, Cantidad, Costo,Fecha_Compra,status)
     VALUES( :cod_proveedor, :cedula_empleado, :Detalle_Compra,:Cantidad,:Costo,:Fecha_Compra,1)";
      $query = $this->conex->prepare($sql);

      $query->bindParam(':cod_proveedor', $this->cod_proveedor);
      $query->bindParam(':cedula_empleado', $this->cedula_empleado);
      $query->bindParam(':Detalle_Compra', $this->Detalle_Compra);
      $query->bindParam(':Cantidad', $this->Cantidad);
      $query->bindParam(':Costo', $this->Costo);
      $query->bindParam(':Fecha_Compra', $this->Fecha_Compra);

      return $query->execute();
    } catch (PDOException $e) {
      error_log("Error SQL: " . $e->getMessage());
      return false;
    }
  }

  public function confirmarModificacion()
  {
    return $this->modificar();
  }

   private function modificar()
  {
   if (!$this->validarDatos()) {
      return false;
    }
    try {
      $sql = "UPDATE compra
              SET  
               cod_proveedor  = :cod_proveedor , 
             cedula_empleado  = :cedula_empleado , 
               Detalle_Compra = :Detalle_Compra,
                     Cantidad = :Cantidad,
                        Costo = :Costo,
                 Fecha_Compra = :Fecha_Compra

                WHERE id_compra  = :id_compra";


      $query = $this->conex->prepare($sql);


      $query->bindParam(':id_compra', $this->id_compra);
      $query->bindParam(':cod_proveedor', $this->cod_proveedor);
      $query->bindParam(':cedula_empleado', $this->cedula_empleado);
      $query->bindParam(':Detalle_Compra', $this->Detalle_Compra);
      $query->bindParam(':Cantidad', $this->Cantidad);
      $query->bindParam(':Costo', $this->Costo);
      $query->bindParam(':Fecha_Compra', $this->Fecha_Compra);

      return $query->execute();
    } catch (PDOException $e) {
      error_log("Error SQL al editar compra: " . $e->getMessage());
      return false;
    }
  }



  function eliminar()
  {
    try {      //cambie DALETE POR UPDATE PARA LA ELIMINACION LOGICA
      $sql = "UPDATE compra SET status = 0 
      WHERE id_compra = :id_compra ";
      $query = $this->conex->prepare($sql);
      $query->bindParam(':id_compra', $this->id_compra);
      return $query->execute();
    } catch (PDOException $e) {
      return false;
    }
  }



  function consultar()
  {
    try {                                //Agg el WHERE para Eliminacion logica
      $sql = "SELECT compra.*, empleado.Nombre_Empleado AS Empleado, proveedor.Nombre_proveedor as Proveedor 
      FROM compra
      JOIN empleado ON compra.cedula_empleado = empleado.cedula_empleado
      JOIN proveedor ON compra.cod_proveedor = proveedor.cod_proveedor
      WHERE compra.status = 1";
      $query = $this->conex->prepare($sql);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      return null;
    }
  }



  function buscar()
  {
    try {
      $sql = "SELECT * FROM compra WHERE id_compra = :id_compra";
      $query = $this->conex->prepare($sql);
      $query->bindParam(':id_compra', $this->id_compra);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      return null;
    }
  }




  function encargado()
  {
    try {
      $sql = "SELECT empleado.cedula_empleado, empleado.Nombre_Empleado AS Nombre
        FROM empleado
        WHERE empleado.id_cargo = 1;";
      $query = $this->conex->prepare($sql);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      return null;
    }
  }



  function proveedor()
  {
    try {
      $sql = "SELECT proveedor.cod_proveedor, proveedor.Nombre_Proveedor AS Nombre
            FROM proveedor
            WHERE proveedor.Status = 1;";
      $query = $this->conex->prepare($sql);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      return null;
    }
  }
}
