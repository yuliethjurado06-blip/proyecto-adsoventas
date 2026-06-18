<?php

require_once '../models/cliente.php';  
require_once '../models/conexion.php';  

class ClienteController {
    private $db;

    public function __construct() {
        $conexion = new Conexion();
        $this->db = $conexion->getConexion();
    }

    // Crear un nuevo cliente
    public function crearCliente($Nombre, $Apellido, $Correo, $Direccion, $Telefono, $usuario_id) {
        $sql = "INSERT INTO cliente (Nombre, Apellido, Correo, Direccion, Telefono, UsuarioID) 
                VALUES (?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('ssssss', $Nombre, $Apellido, $Correo, $Direccion, $Telefono, $usuario_id);
        
        return $stmt->execute();
    }

    // Obtener un cliente por ID
    public function obtenerClientePorID($ID, $usuario_id) {
        $sql = "SELECT * FROM cliente WHERE ID = ? AND UsuarioID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('is', $ID, $usuario_id);
        $stmt->execute();
        
        $resultado = $stmt->get_result()->fetch_assoc();
        if ($resultado) {
            return new Cliente($resultado['ID'], $resultado['Nombre'], $resultado['Apellido'], $resultado['Correo'], $resultado['Direccion'], $resultado['Telefono'], $resultado['UsuarioID']);
        }
        
        return null;
    }

    // Actualizar un cliente
    public function actualizarCliente($ID, $Nombre, $Apellido, $Correo, $Direccion, $Telefono, $usuario_id) {
        $sql = "UPDATE cliente SET Nombre = ?, Apellido = ?, Correo = ?, Direccion = ?, Telefono = ?, UsuarioID = ? 
                WHERE ID = ?";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('ssssssi', $Nombre, $Apellido, $Correo, $Direccion, $Telefono, $usuario_id, $ID);
        
        return $stmt->execute();
    }

    // Eliminar un cliente
    public function eliminarCliente($ID) {
        $sql = "DELETE FROM cliente WHERE ID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $ID);
        
        return $stmt->execute();
    }

    // Obtener todos los clientes
    public function obtenerTodosLosClientes() {
        $sql = "SELECT * FROM cliente";
        $resultado = $this->db->query($sql);
        
        $clientes = [];
        while ($row = $resultado->fetch_assoc()) {
            $clientes[] = new Cliente($row['ID'], $row['Nombre'], $row['Apellido'], $row['Correo'], $row['Direccion'], $row['Telefono'], $row['UsuarioID']);
        }
        
        return $clientes;
    }

    public function obtenerTodosLosClientesPorID($usuario_id) {
        $sql = "SELECT * FROM cliente WHERE UsuarioID = ?";
        $stmt = $this->db->prepare($sql);
        
        if (!$stmt) {
            die("Error en la preparación de la consulta: " . $this->db->error);
        }
    
        $stmt->bind_param('s', $usuario_id);
        $stmt->execute();
        
        $resultado = $stmt->get_result();
    
        $clientes = [];
        while ($row = $resultado->fetch_assoc()) {
            $clientes[] = new Cliente($row['ID'], $row['Nombre'], $row['Apellido'], $row['Correo'], $row['Direccion'], $row['Telefono'], $row['UsuarioID']);
        }
        
        $stmt->close();
        return $clientes;
    }

    public function obtenerClientesPorUsuarioID($usuario_id) {
        $sql = "SELECT * FROM cliente WHERE UsuarioID = ?";
        $stmt = $this->db->prepare($sql);
        
        if (!$stmt) {
            die("Error en la preparación de la consulta: " . $this->db->error);
        }
    
        $stmt->bind_param('s', $usuario_id);
        $stmt->execute();
        
        $resultado = $stmt->get_result();
    
        $clientes = [];
        while ($row = $resultado->fetch_assoc()) {
            $clientes[] = new Cliente($row['ID'], $row['Nombre'], $row['Apellido'], $row['Correo'], $row['Direccion'], $row['Telefono'], $row['UsuarioID']);
        }
        
        $stmt->close();
        return $clientes;
    }

    public function obtenerclientePorNombre($nombre, $usuario_id) {
        $sql = "SELECT * FROM cliente WHERE Nombre = ? AND UsuarioID = ?";
        $stmt = $this->db->prepare($sql);
        
        if (!$stmt) {
            die("Error en la preparación de la consulta: " . $this->db->error);
        }
    
        $stmt->bind_param('ss', $nombre, $usuario_id);
        $stmt->execute();
        
        $resultado = $stmt->get_result();
    
        if ($row = $resultado->fetch_assoc()) {
            return new Cliente ($row['ID'], $row['Nombre'], $row['Apellido'], $row['Correo'], $row['Direccion'], $row['Telefono'], $row['UsuarioID']);
        }
    
        $stmt->close();
        return null;
    }

    
}
