<?php
namespace App\modelo;
// require_once 'app/conexion/conexion.php';
use App\conexion\Conexion;
use PDO;
use PDOException;

class comprasModelo extends conexion
{

  private $id_compra;
  private $cod_proveedor ;
  private $cedula_empleado ;
  private $Detalle_Compra;
  private $Cantidad;
  private $Costo;
  private $Fecha_Compra;

  function set_Id_compra($valor)
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





  function registrar()
  {
    try {
      $sql = "INSERT INTO compra(id_compra  ,cod_proveedor , cedula_empleado , Detalle_Compra, Cantidad, Costo,Fecha_Compra,status)
     VALUES(null,:id_compra, :cod_proveedor, :cedula_empleado, :Detalle_Compra,:Cantidad,:Costo,:Fecha_Compra,1)";
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
      return false;
    }
  }



  function consultar()
  {
    try {                                //Agg el WHERE para Eliminacion logica
      $sql = "SELECT `compra`.* FROM `compra`;";
      $query = $this->conex->prepare($sql);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      return null;
    }
  }


  function modificar($Id_compra)
  {
    try {
      $sql = "UPDATE compra
              SET  id_compra  = :id_compra ,
                         cod_proveedor  = :cod_proveedor , 
                      cedula_empleado  = :cedula_empleado , 
                 Detalle_Compra = :Detalle_Compra,
                     Cantidad = :Cantidad,
                 Costo = :Costo,
                     Fecha_Compra = :Fecha_Compra
          
                WHERE id_compra  = '$Id_compra '";
      $query = $this->conex->prepare($sql);
      $query->bindParam(':id_compra', $this->id_compra);
      $query->bindParam(':cod_proveedor', $this->cod_proveedor);
      $query->bindParam(':cedula_empleado', $this->cedula_empleado);
      $query->bindParam(':Cantidad', $this->Cantidad);
      $query->bindParam(':Costo', $this->Costo);
      $query->bindParam(':Fecha_Compra', $this->Fecha_Compra);

      $query->execute();

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



  function eliminar()
  {
    try {      //cambie DALETE POR UPDATE PARA LA ELIMINACION LOGICA
      $sql = "UPDATE compra SET status = 0 WHERE id_compra = :id_compra ";
      $query = $this->conex->prepare($sql);
      $query->bindParam(':id_compra', $this->id_compra);
      return $query->execute();
    } catch (PDOException $e) {
      return false;
    }
  }

}




