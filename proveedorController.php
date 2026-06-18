<?php

require_once '../models/proveedor.php';  
require_once '../models/conexion.php';  

class ProveedorController {
    private $db;

    public function __construct() {
        $conexion = new Conexion();
        $this->db = $conexion->getConexion();
    }

    // Crear un nuevo proveedor
    public function crearProveedor($Nombre, $Direccion, $Telefono, $UsuarioID) {
        $sql = "INSERT INTO proveedor (Nombre, Direccion, Telefono, UsuarioID) 
                VALUES (?, ?, ?, ?)";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('ssss', $Nombre, $Direccion, $Telefono, $UsuarioID);
        
        return $stmt->execute();
    }

    // Obtener un proveedor por ID
    public function obtenerProveedorPorID($ID, $UsuarioID) {
        $sql = "SELECT * FROM proveedor WHERE ID = ? AND UsuarioID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('is', $ID, $UsuarioID);
        $stmt->execute();
        
        $resultado = $stmt->get_result()->fetch_assoc();
        if ($resultado) {
            return new Proveedor($resultado['ID'], $resultado['Nombre'], $resultado['Direccion'], $resultado['Telefono'], $resultado['UsuarioID']);
        }
        
        return null;
    }

    // Actualizar un proveedor
    public function actualizarProveedor($ID, $Nombre, $Direccion, $Telefono, $UsuarioID) {
        $sql = "UPDATE proveedor SET Nombre = ?, Direccion = ?, Telefono = ?, UsuarioID = ? 
                WHERE ID = ?";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('ssssi', $Nombre, $Direccion, $Telefono, $UsuarioID, $ID);
        
        return $stmt->execute();
    }

    // Eliminar un proveedor
    public function eliminarProveedor($ID) {
        $sql = "DELETE FROM proveedor WHERE ID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $ID);
        
        return $stmt->execute();
    }

    // Obtener todos los proveedores
    public function obtenerTodosLosProveedores() {
        $sql = "SELECT * FROM proveedor";
        $resultado = $this->db->query($sql);
        
        $proveedores = [];
        while ($row = $resultado->fetch_assoc()) {
            $proveedores[] = new Proveedor($row['ID'], $row['Nombre'], $row['Direccion'], $row['Telefono'], $row['UsuarioID']);
        }
        
        return $proveedores;
    }

    public function obtenerTodosLosProveedoresPorID($usuario_id) {
        $sql = "SELECT * FROM proveedor WHERE UsuarioID = ?";
        $stmt = $this->db->prepare($sql);
        
        if (!$stmt) {
            die("Error en la preparación de la consulta: " . $this->db->error);
        }
    
        $stmt->bind_param('s', $usuario_id);
        $stmt->execute();
        
        $resultado = $stmt->get_result();
    
        $proveedores = [];
        while ($row = $resultado->fetch_assoc()) {
            $proveedores[] = new Proveedor($row['ID'], $row['Nombre'], $row['Direccion'], $row['Telefono'], $row['UsuarioID']);
        }
        
        $stmt->close();
        return $proveedores;
    }

    public function obtenerProveedorPorNombre($nombre, $usuario_id) {
        $sql = "SELECT * FROM proveedor WHERE Nombre = ? AND UsuarioID = ?";
        $stmt = $this->db->prepare($sql);
        
        if (!$stmt) {
            die("Error en la preparación de la consulta: " . $this->db->error);
        }
    
        $stmt->bind_param('ss', $nombre, $usuario_id);
        $stmt->execute();
        
        $resultado = $stmt->get_result();
    
        if ($row = $resultado->fetch_assoc()) {
            return new Proveedor ($row['ID'], $row['Nombre'], $row['Direccion'], $row['Telefono'], $row['UsuarioID']);
        }
    
        $stmt->close();
        return null;
    }
}
