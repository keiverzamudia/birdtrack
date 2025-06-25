<?php
namespace App\modelo;
// require_once 'app/conexion/conexion.php';
use App\conexion\Conexion;
use PDO;
use PDOException;

class comprasModelo extends conexion{

  private $Id_compra;
  private $Nro_Factura;
  private $Fecha;
  private $Cantidad;
  private $Nombre_activo;
  private $proveedor;

  function set_Id_compra($valor){
    $this->Id_compra  = $valor;
  }
  function set_Nro_Factura($valor){
    $this->Nro_Factura = $valor;
  }
  function set_Fecha($valor){
    $this->Fecha = $valor;
  }
  function set_Cantidad($valor){
    $this->Cantidad = $valor;
  }
  function set_Nombre_activo($valor){
    $this->Nombre_activo = $valor;
  }

  function set_proveedor ($valor){
    $this->proveedor = $valor;
  }

  function __construct(){
    parent::__construct();
  }

  //$proveedor['proveedor']

  function registrar(){
    try {
    $sql = "INSERT INTO compra(Id_compra ,Nro_Factura, Fecha, cantidad, Nombre_activo, proveedor,status)
     VALUES(null,:Nro_Factura, :Fecha, :cantidad, :Nombre_activo, :proveedor,1)";
    $query = $this->conex->prepare($sql);

    $query->bindParam('Nro_Factura', $this->Nro_Factura);
    $query->bindParam('Fecha', $this->Fecha);
    $query->bindParam('cantidad', $this->Cantidad);
    $query->bindParam('Nombre_activo', $this->Nombre_activo);
    $query->bindParam('proveedor', $this->proveedor); 

    return $query->execute();
    }
    catch (PDOException $e) {
      return false;
    }
  }
  

  
  function consultar(){
    try {                                //Agg el WHERE para Eliminacion logica
      $sql = "SELECT * FROM compra WHERE status = 1";
      $query = $this->conex->prepare($sql);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      return null;
    }
  }

  
  function modificar($Id_compra ){
    try {
       $sql = "UPDATE compra
              SET  Nro_Factura = :Nro_Factura,
                         Fecha = :Fecha, 
                      Cantidad = :cantidad, 
                 Nombre_activo = :Nombre_activo,
                     proveedor = :proveedor
          
                WHERE Id_compra = '$Id_compra '";
   $query = $this->conex->prepare($sql);
    $query->bindParam('Nro_Factura', $this->Nro_Factura);
    $query->bindParam('Fecha', $this->Fecha);
    $query->bindParam('cantidad', $this->Cantidad);
    $query->bindParam('Nombre_activo', $this->Nombre_activo);
      $query->bindParam('proveedor', $this->proveedor);
    $query->execute();  

    } catch (PDOException $e) {
      return false;
    }
   
  }
  
  
  function buscar(){
    try {
      $sql = "SELECT * FROM compra WHERE Id_compra = :Id_compra";
      $query = $this->conex->prepare($sql);
      $query->bindParam(':Id_compra', $this->Id_compra);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      return null;
    }
  }

  

    function eliminar(){
    try {      //cambie DALETE POR UPDATE PARA LA ELIMINACION LOGICA
      $sql = "UPDATE compra SET status = 0 WHERE Id_compra = :Id_compra ";
      $query = $this->conex->prepare($sql);
      $query->bindParam(':Id_compra', $this->Id_compra );
      return $query->execute();
    } catch (PDOException $e) {
      return false;
    }
  }

}




