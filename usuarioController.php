<?php

require_once '../models/usuario.php';  
require_once '../models/conexion.php';  

class UsuarioController {
    private $db;

    public function __construct() {
        $conexion = new Conexion();
        $this->db = $conexion->getConexion();
    }

    // Crear un nuevo usuario
    public function crearUsuario($Nombre, $Apellido, $Email, $Contrasena) {
        $sql = "INSERT INTO usuario (Nombre, Apellido, Email, Contrasena) VALUES (?, ?, ?, ?)";
        
        // Encriptamos la contraseña antes de guardarla
        $hashedContrasena = password_hash($Contrasena, PASSWORD_DEFAULT);
    
        $stmt = $this->db->prepare($sql);
    
        if (!$stmt) {
            // Si la preparación de la consulta falla, muestra el error
            die("Error en la preparación de la consulta: " . $this->db->error);
        }
    
        $stmt->bind_param('ssss', $Nombre, $Apellido, $Email, $hashedContrasena);
        
        return $stmt->execute();
    }
    

    // Obtener un usuario por ID
    public function obtenerUsuarioPorID($ID) {
        $sql = "SELECT * FROM usuario WHERE ID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $ID);
        $stmt->execute();
        
        $resultado = $stmt->get_result()->fetch_assoc();
        if ($resultado) {
            return new Usuario($resultado['ID'], $resultado['Nombre'], $resultado['Apellido'], $resultado['Email'], $resultado['Contrasena']);
        }
        
        return null;
    }

    // Actualizar un usuario
    public function actualizarUsuario($ID, $Nombre, $Apellido, $Email, $Contrasena) {
        $sql = "UPDATE usuario SET Nombre = ?, Apellido = ?, Email = ?, Contrasena = ? 
                WHERE ID = ?";
        
        // Encriptamos la contraseña antes de guardarla
        $hashedContrasena = password_hash($Contrasena, PASSWORD_DEFAULT);

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('ssssi', $Nombre, $Apellido, $Email, $hashedContrasena, $ID);
        
        return $stmt->execute();
    }

    // Eliminar un usuario
    public function eliminarUsuario($ID) {
        $sql = "DELETE FROM usuario WHERE ID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $ID);
        
        return $stmt->execute();
    }

    // Obtener todos los usuarios
    public function obtenerTodosLosUsuarios() {
        $sql = "SELECT * FROM usuario";
        $resultado = $this->db->query($sql);
        
        $usuarios = [];
        while ($row = $resultado->fetch_assoc()) {
            $usuarios[] = new Usuario($row['ID'], $row['Nombre'], $row['Apellido'], $row['Email'], $row['Contrasena']);
        }
        
        return $usuarios;
    }

    // Verificar credenciales de un usuario (para login)
    public function verificarCredenciales($Email, $Contrasena) {
        $sql = "SELECT * FROM usuario WHERE Email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('s', $Email);
        $stmt->execute();
        
        $resultado = $stmt->get_result()->fetch_assoc();
        if ($resultado && password_verify($Contrasena, $resultado['Contrasena'])) {
            return new Usuario($resultado['ID'], $resultado['Nombre'], $resultado['Apellido'], $resultado['Email'], $resultado['Contrasena']);
        }
        
        return null;
    }
}
