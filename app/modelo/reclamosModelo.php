<?php
namespace App\modelo;
use App\conexion\conexion;
use PDO;
use PDOException;

class reclamosModelo extends conexion {
    private $id_reclamo;
    private $cedula_empleado;
    private $id_activo;
    private $descripcion;
    private $fecha_reclamo;
    private $status;

    // Setters
    function set_id_reclamo($valor) {
        $this->id_reclamo = $valor;
    }
    
    function set_cedula_empleado($valor) {
        $this->cedula_empleado = $valor;
    }
    
    function set_id_activo($valor) {
        $this->id_activo = $valor;
    }
    
    function set_descripcion($valor) {
        $this->descripcion = $valor;
    }
    
    function set_fecha_reclamo($valor) {   
        $this->fecha_reclamo = $valor;
    }
    
    function set_status($valor) {
        $this->status = $valor;
    }

    // Getters
    function get_id_reclamo() {
        return $this->id_reclamo;
    }
    
    function get_cedula_empleado() {
        return $this->cedula_empleado;
    }
    
    function get_id_activo() {
        return $this->id_activo;
    }
    
    function get_descripcion() {
        return $this->descripcion;
    }
    
    function get_fecha_reclamo() {
        return $this->fecha_reclamo;
    }
    
    function get_status() {
        return $this->status;
    }

    // Método para registrar un reclamo
    function registrar() {
        try {
            $sql = "INSERT INTO reclamo_activo (cedula_empleado, id_activo, Descripcion, Fecha_reclamo) 
                    VALUES (:cedula_empleado, :id_activo, :descripcion, :fecha_reclamo)";
            $query = $this->conex->prepare($sql);
            $query->bindParam(':cedula_empleado', $this->cedula_empleado);
            $query->bindParam(':id_activo', $this->id_activo);
            $query->bindParam(':descripcion', $this->descripcion);
            $query->bindParam(':fecha_reclamo', $this->fecha_reclamo);
            return $query->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    // Método para consultar todos los reclamos
    function consultar() {
        try {
            $sql = "SELECT RA.*, E.Nombre_Empleado, A.Nombre_Activo, A.Descripcion_Activo
                    FROM reclamo_activo AS RA 
                    LEFT JOIN empleado AS E ON RA.cedula_empleado = E.cedula_empleado
                    LEFT JOIN activos AS A ON RA.id_activo = A.id_activo
                    ORDER BY RA.Fecha_reclamo DESC";
            $query = $this->conex->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return null;
        }
    }

    // Método para consultar un reclamo específico
    function consultar_por_id() {
        try {
            $sql = "SELECT RA.*, E.Nombre_Empleado, A.Nombre_Activo, A.Descripcion_Activo
                    FROM reclamo_activo AS RA 
                    LEFT JOIN empleado AS E ON RA.cedula_empleado = E.cedula_empleado
                    LEFT JOIN activos AS A ON RA.id_activo = A.id_activo
                    WHERE RA.id_reclamo = :id_reclamo";
            $query = $this->conex->prepare($sql);
            $query->bindParam(':id_reclamo', $this->id_reclamo);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return null;
        }
    }

    // Método para actualizar un reclamo
    function actualizar() {
        try {
            $sql = "UPDATE reclamo_activo 
                    SET cedula_empleado = :cedula_empleado, 
                        id_activo = :id_activo, 
                        Descripcion = :descripcion, 
                        Fecha_reclamo = :fecha_reclamo
                    WHERE id_reclamo = :id_reclamo";
            $query = $this->conex->prepare($sql);
            $query->bindParam(':id_reclamo', $this->id_reclamo);
            $query->bindParam(':cedula_empleado', $this->cedula_empleado);
            $query->bindParam(':id_activo', $this->id_activo);
            $query->bindParam(':descripcion', $this->descripcion);
            $query->bindParam(':fecha_reclamo', $this->fecha_reclamo);
            return $query->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    // Método para eliminar un reclamo
    function eliminar() {
        try {
            $sql = "DELETE FROM reclamo_activo WHERE id_reclamo = :id_reclamo";
            $query = $this->conex->prepare($sql);
            $query->bindParam(':id_reclamo', $this->id_reclamo);
            return $query->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    // Método para obtener activos asignados en general
    function obtener_activos_asignados() {
        try {
            $sql = "SELECT DISTINCT A.id_activo, A.Nombre_Activo, A.Descripcion_Activo, 
                           A.Estado_Activo, A.Fecha_adquisicion,
                           TA.Nombre as Tipo_Activo,
                           UA.Nombre as Ubicacion,
                           E.Nombre_Empleado as Empleado_Asignado,
                           ASI.Fecha_asignacion,
                           ASI.Descripcion_Asignacion
                    FROM activos A
                    LEFT JOIN tipo_activos TA ON A.id_tipo_activo = TA.id_tipo_activo
                    LEFT JOIN ubicacion_activos UA ON A.id_ubicacion = UA.id_Ubicacion
                    LEFT JOIN asignacion ASI ON A.id_activo = ASI.id_activo AND ASI.Status = 1
                    LEFT JOIN empleado E ON ASI.cedula_empleado = E.cedula_empleado
                    WHERE A.Status = 1 
                    AND A.Estado_Activo != 'Disponible'
                    ORDER BY A.Nombre_Activo";
            $query = $this->conex->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return null;
        }
    }

    // Método para obtener activos disponibles (no asignados)
    function obtener_activos_disponibles() {
        try {
            $sql = "SELECT A.id_activo, A.Nombre_Activo, A.Descripcion_Activo, 
                           A.Estado_Activo, A.Fecha_adquisicion,
                           TA.Nombre as Tipo_Activo,
                           UA.Nombre as Ubicacion
                    FROM activos A
                    LEFT JOIN tipo_activos TA ON A.id_tipo_activo = TA.id_tipo_activo
                    LEFT JOIN ubicacion_activos UA ON A.id_ubicacion = UA.id_Ubicacion
                    WHERE A.Status = 1 
                    AND A.Estado_Activo = 'Disponible'
                    ORDER BY A.Nombre_Activo";
            $query = $this->conex->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return null;
        }
    }

    // Método para obtener todos los activos (asignados y disponibles)
    function obtener_todos_los_activos() {
        try {
            $sql = "SELECT A.id_activo, A.Nombre_Activo, A.Descripcion_Activo, 
                           A.Estado_Activo, A.Fecha_adquisicion,
                           TA.Nombre as Tipo_Activo,
                           UA.Nombre as Ubicacion,
                           E.Nombre_Empleado as Empleado_Asignado,
                           ASI.Fecha_asignacion,
                           ASI.Descripcion_Asignacion
                    FROM activos A
                    LEFT JOIN tipo_activos TA ON A.id_tipo_activo = TA.id_tipo_activo
                    LEFT JOIN ubicacion_activos UA ON A.id_ubicacion = UA.id_Ubicacion
                    LEFT JOIN asignacion ASI ON A.id_activo = ASI.id_activo AND ASI.Status = 1
                    LEFT JOIN empleado E ON ASI.cedula_empleado = E.cedula_empleado
                    WHERE A.Status = 1
                    ORDER BY A.Nombre_Activo";
            $query = $this->conex->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return null;
        }
    }

    // Método para obtener reclamos por empleado
    function obtener_reclamos_por_empleado() {
        try {
            $sql = "SELECT RA.*, E.Nombre_Empleado, A.Nombre_Activo, A.Descripcion_Activo
                    FROM reclamo_activo AS RA 
                    LEFT JOIN empleado AS E ON RA.cedula_empleado = E.cedula_empleado
                    LEFT JOIN activos AS A ON RA.id_activo = A.id_activo
                    WHERE RA.cedula_empleado = :cedula_empleado
                    ORDER BY RA.Fecha_reclamo DESC";
            $query = $this->conex->prepare($sql);
            $query->bindParam(':cedula_empleado', $this->cedula_empleado);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return null;
        }
    }

    // Método para obtener reclamos por activo
    function obtener_reclamos_por_activo() {
        try {
            $sql = "SELECT RA.*, E.Nombre_Empleado, A.Nombre_Activo, A.Descripcion_Activo
                    FROM reclamo_activo AS RA 
                    LEFT JOIN empleado AS E ON RA.cedula_empleado = E.cedula_empleado
                    LEFT JOIN activos AS A ON RA.id_activo = A.id_activo
                    WHERE RA.id_activo = :id_activo
                    ORDER BY RA.Fecha_reclamo DESC";
            $query = $this->conex->prepare($sql);
            $query->bindParam(':id_activo', $this->id_activo);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return null;
        }
    }
}