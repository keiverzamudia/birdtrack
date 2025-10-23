<?php
namespace App\Modelo;
use App\conexion\conexion;
use App\interfaces\laInterface;
use PDO;
use PDOException;


class tipoMantenimientoModel extends conexion 
{

    private $ID_TIPO_MTTO;
    private $NOMBRE_TIPO_MTTO;
    private $DESCRIPCION;

    public function set_ID_TIPO_MTTO($valor)
    {

        $this->ID_TIPO_MTTO = $valor;
    }
    public function set_nombre_tipo_mtto($valor)
    {
        $this->NOMBRE_TIPO_MTTO = $valor;
    }

    public function set_descripcion($valor)
    {
        $this->DESCRIPCION = $valor;
    }


    function registrar()
    {

        try {

            $sql = "INSERT INTO tipo_mantenimiento( Nombre, Descripcion)
            VALUES (:Nombre, :Descripcion)";
            $query = $this->conex->prepare($sql);
            $query->bindParam(':Nombre', $this->NOMBRE_TIPO_MTTO);
            $query->bindParam(':Descripcion', $this->DESCRIPCION);


            return $query->execute();

        } catch (PDOException $e) {
            return false;
        }

    }



    public function consultar()
    {

        try {
            $sql = "SELECT * FROM tipo_mantenimiento";
            $query = $this->conex->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }




    function eliminar()
    {
        try {
            //cambie DALETE POR UPDATE PARA LA ELIMINACION LOGICA
            $sql = "DELETE FROM tipo_mantenimiento WHERE id_tipo_mantenimiento = :id_tipo_mantenimiento";
            $query = $this->conex->prepare($sql);
            $query->bindParam(':id_tipo_mantenimiento', $this->ID_TIPO_MTTO);
            return $query->execute();
        } catch (PDOException $e) {
            return false;
        }
    }


    
    public function modificar($id)
    {
        try {
            $sql = "UPDATE tipo_mantenimiento SET
Nombre = :Nombre,
Descripcion = :Descripcion
WHERE id_tipo_mantenimiento = :id_tipo_mantenimiento";
            $query = $this->conex->prepare($sql);
            $query->bindParam(':Nombre', $this->NOMBRE_TIPO_MTTO);
            $query->bindParam(':Descripcion', $this->DESCRIPCION);
            $query->bindParam(':id_tipo_mantenimiento', $this->ID_TIPO_MTTO);
            return $query->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

}




?>