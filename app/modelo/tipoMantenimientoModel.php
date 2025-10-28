<?php
namespace App\Modelo;
use App\conexion\conexion;
use PDO;
use PDOException;

class tipoMantenimientoModel extends conexion
{
    private $ID_TIPO_MTTO;
    private $NOMBRE_TIPO_MTTO;
    private $DESCRIPCION;

    public function set_Id_Tipo_Mtto($valor)
    {
        $this->ID_TIPO_MTTO = $valor;
    }
    public function set_Nombre_Tipo_mtto($valor)
    {
        $this->NOMBRE_TIPO_MTTO = $valor;
    }
    public function set_Descripcion($valor)
    {
        $this->DESCRIPCION = $valor;
    }

    public function registrar()
    {
        try {
            $sql = "INSERT INTO tipo_mantenimiento (id_tipo_mantenimiento, Nombre, Descripcion, STATUS)
                    VALUES (NULL, :Nombre, :Descripcion, 1)";
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
            // traer solo activos (STATUS = 1)
            $sql = "SELECT * FROM `tipo_mantenimiento` WHERE STATUS = 1";
            $query = $this->conex->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function eliminar()
    {
        try {
            if (!filter_var($this->ID_TIPO_MTTO, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]])) {
                return false;
            }
            $sql = "UPDATE `tipo_mantenimiento` SET `STATUS` = 0 WHERE id_tipo_mantenimiento = :id_tipo_mantenimiento";
            $query = $this->conex->prepare($sql);
            $query->bindParam(':id_tipo_mantenimiento', $this->ID_TIPO_MTTO, PDO::PARAM_INT);
            return $query->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function modificar()
    {
        try {
            if (!filter_var($this->ID_TIPO_MTTO, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]])) {
                return false;
            }
            $sql = "UPDATE tipo_mantenimiento SET
                        Nombre = :Nombre,
                        Descripcion = :Descripcion
                    WHERE id_tipo_mantenimiento = :id_tipo_mantenimiento";
            $query = $this->conex->prepare($sql);
            $query->bindParam(':Nombre', $this->NOMBRE_TIPO_MTTO);
            $query->bindParam(':Descripcion', $this->DESCRIPCION);
            $query->bindParam(':id_tipo_mantenimiento', $this->ID_TIPO_MTTO, PDO::PARAM_INT);
            return $query->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>