<?php
namespace App\modelo;
use \App\conexion\conexion;
use PDO; 
use PDOException;

class perfilAdm extends conexion {
    protected $con;
    private $id_usuario;
    private $cedula;
    private $nombre;
    private $apellidos;
    private $telefono;
    private $correo;
    private $clave;
    private $rol;
    private $id_tipo_usuario;
    private $perfil;
    private $status;

    // Setters
    function set_id_usuario($valor) {
        $this->id_usuario = $valor;
    }
    function set_cedula($valor) {
        $this->cedula = $valor;
    }
    function set_nombre($valor) {
        $this->nombre = $valor;
    }
    function set_apellidos($valor) {
        $this->apellidos = $valor;
    }
    function set_telefono($valor) {
        $this->telefono = $valor;
    }
    function set_correo($valor) {
        $this->correo = $valor;
    }
    function set_clave($valor) {
        $this->clave = $valor;
    }
    function set_rol($valor) {
        $this->rol = $valor;
    }
    function set_id_tipo_usuario($valor) {
        $this->id_tipo_usuario = $valor;
    }
    function set_perfil($valor) {
        $this->perfil = $valor;
    }
    function set_status($valor) {
        $this->status = $valor;
    }

    // Obtener datos del usuario por ID
    function obtenerUsuarioPorId($id_usuario) {
        try {
            $sql = "SELECT * FROM usuario WHERE id_usuario = :id_usuario";
            $query = $this->conex->prepare($sql);
            $query->bindParam(':id_usuario', $id_usuario);
            $query->execute();

            if ($query->rowCount() > 0) {
                return $query->fetch(PDO::FETCH_ASSOC);
            } else {
                return null;
            }
        } catch (PDOException $e) {
            return false;
        }
    }

    // Actualizar datos del usuario
    function actualizarPerfil() {
        try {
            $sql = "UPDATE usuario SET 
                    nombre = :nombre, 
                    apellidos = :apellidos, 
                    telefono = :telefono, 
                    correo = :correo,
                    cedula = :cedula
                    WHERE id_usuario = :id_usuario";

            $query = $this->conex->prepare($sql);
            $query->bindParam(':nombre', $this->nombre);
            $query->bindParam(':apellidos', $this->apellidos);
            $query->bindParam(':telefono', $this->telefono);
            $query->bindParam(':correo', $this->correo);
            $query->bindParam(':cedula', $this->cedula);
            $query->bindParam(':id_usuario', $this->id_usuario);

            return $query->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    // Cambiar contraseña
    function cambiarClave() {
        try {
            $sql = "UPDATE usuario SET clave = :clave WHERE id_usuario = :id_usuario";
            $query = $this->conex->prepare($sql);
            $query->bindParam(':clave', $this->clave);
            $query->bindParam(':id_usuario', $this->id_usuario);

            return $query->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    // Verificar si el correo ya existe (para validación)
    function verificarCorreoExistente($correo, $id_usuario_excluir = null) {
        try {
            $sql = "SELECT COUNT(*) as count FROM usuario WHERE correo = :correo";
            if ($id_usuario_excluir) {
                $sql .= " AND id_usuario != :id_usuario_excluir";
            }
            
            $query = $this->conex->prepare($sql);
            $query->bindParam(':correo', $correo);
            if ($id_usuario_excluir) {
                $query->bindParam(':id_usuario_excluir', $id_usuario_excluir);
            }
            $query->execute();

            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result['count'] > 0;
        } catch (PDOException $e) {
            return false;
        }
    }

    // Verificar si la cédula ya existe (para validación)
    function verificarCedulaExistente($cedula, $id_usuario_excluir = null) {
        try {
            $sql = "SELECT COUNT(*) as count FROM usuario WHERE cedula = :cedula";
            if ($id_usuario_excluir) {
                $sql .= " AND id_usuario != :id_usuario_excluir";
            }
            
            $query = $this->conex->prepare($sql);
            $query->bindParam(':cedula', $cedula);
            if ($id_usuario_excluir) {
                $query->bindParam(':id_usuario_excluir', $id_usuario_excluir);
            }
            $query->execute();

            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result['count'] > 0;
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>
