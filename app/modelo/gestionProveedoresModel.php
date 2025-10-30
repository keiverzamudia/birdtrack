<?php
namespace App\modelo;
use App\conexion\conexion;
use App\interfaces\laInterface;
use PDO;
use PDOException;



class gestionProveedoresModel extends conexion implements laInterface{


  private $cod_proveedor;
  private $Nombre_Proveedor;
  private $Direccion;
  private $Numero_telefono;
  private $Correo_elect;

  function set_cod_proveedor($valor)
  {
    $this->cod_proveedor = $valor;
  }
  function set_Nombre_Proveedor($valor)
  {
    $this->Nombre_Proveedor = $valor;
  }
  function set_Direccion($valor)
  {
    $this->Direccion = $valor;
  }
  function set_Numero_telefono($valor)
  {
    $this->Numero_telefono = $valor;
  }
  function set_Correo_elect($valor)
  {
    $this->Correo_elect = $valor;
  }


public function validarDatos()
{
  return !empty($this->Nombre_Proveedor) &&
         !empty($this->Direccion) &&
         !empty($this->Numero_telefono) &&
         !empty($this->Correo_elect);
}
  

public function consultar() {
    return $this->consultarProveedor();
  }

private function consultarProveedor()
  {
    
    try {
      $sql = "SELECT * FROM proveedor WHERE status = 1";
      $query = $this->conex->prepare($sql);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      return null;
    }
  }

public function confirmarRegistro(){

  return $this->registrar();  
}

 private function registrar()
  {
    if (!$this->validarDatos()) {
      return false;
    }

    try {
      $sql = "INSERT INTO proveedor ( Nombre_Proveedor, Direccion, Numero_telefono, Correo_elect,status)
     VALUES(:Nombre_Proveedor, :Direccion, :Numero_telefono, :Correo_elect, 1)";
      $query = $this->conex->prepare($sql);

      $query->bindParam(':Nombre_Proveedor', $this->Nombre_Proveedor);
      $query->bindParam(':Direccion', $this->Direccion);
      $query->bindParam(':Numero_telefono', $this->Numero_telefono);
      $query->bindParam(':Correo_elect', $this->Correo_elect);

      return $query->execute();
      
    } catch (PDOException $e) {
      error_log("Error en registrar(): " . $e->getMessage());
      return false;
    }
  }


 public function eliminar()
  {
    try {
      // Eliminación lógica: solo cambia el status a 0
      $sql = "UPDATE proveedor SET Status = 0 WHERE cod_proveedor = :cod_proveedor";
      $query = $this->conex->prepare($sql);
      $query->bindParam(':cod_proveedor', $this->cod_proveedor);
      return $query->execute();
    } catch (PDOException $e) {
      return false;
    }
  }




public function confirmarModificacion(){
  return $this->modificar();
}

 private function modificar()
  {
    if (!$this->validarDatos()) {
      return false;
    }
    try {
      $sql = "UPDATE proveedor
        SET  Nombre_Proveedor = :Nombre_Proveedor,
                    Direccion = :Direccion, 
              Numero_telefono = :Numero_telefono, 
                Correo_elect = :Correo_elect
            
              WHERE cod_proveedor = :cod_proveedor";

      $query = $this->conex->prepare($sql);
      
      $query->bindParam(':Nombre_Proveedor', $this->Nombre_Proveedor);
      $query->bindParam(':Direccion', $this->Direccion);
      $query->bindParam(':Numero_telefono', $this->Numero_telefono);
      $query->bindParam(':Correo_elect', $this->Correo_elect);
      $query->bindParam(':cod_proveedor', $this->cod_proveedor);
  // Execute and return the boolean result so callers can check success/failu re
      return $query->execute();

    } catch (PDOException $e) {
      return false;
    }
  }



  function buscar()
  {
    try {
      $sql = "SELECT * FROM proveedor WHERE cod_proveedor = :cod_proveedor";
      $query = $this->conex->prepare($sql);
      $query->bindParam(':cod_proveedor', $this->cod_proveedor);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      return null;
    }
  }


}


?>