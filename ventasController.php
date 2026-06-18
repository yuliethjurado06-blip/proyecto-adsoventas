<?php
require_once 'autenticador.php';
require_once '../models/ventas.php';
require_once '../models/conexion.php';

class VentasController {
    private $db;

    public function __construct() {
        $conexion = new Conexion();
        $this->db = $conexion->getConexion();
    }

    // Crear una nueva venta
    public function crearVenta($Fecha, $Total, $Cantidad, $Precio, $ProductoID, $UsuarioID, $ClienteID) {
        $sql = "INSERT INTO ventas (Fecha, Total, Cantidad, Precio, ProductoID, UsuarioID, ClienteID) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('sdidisi', $Fecha, $Total, $Cantidad, $Precio, $ProductoID, $UsuarioID, $ClienteID);
        
        return $stmt->execute();
    }

    // Obtener una venta por ID
    public function obtenerVentaPorID($ID, $UsuarioID) { 
        $sql = "SELECT * FROM ventas WHERE ID = ? AND UsuarioID = ?"; 
        $stmt = $this->db->prepare($sql); 
        $stmt->bind_param('is', $ID, $UsuarioID);
        $stmt->execute(); 
        $resultado = $stmt->get_result()->fetch_assoc(); 
        if ($resultado) { 
            return new Venta($resultado['ID'], $resultado['Fecha'], $resultado['Total'], $resultado['Cantidad'], $resultado['Precio'], $resultado['ProductoID'], $resultado['UsuarioID'], $resultado['ClienteID']);
        } 
        return null;
    }

    // Actualizar una venta
    public function actualizarVenta($ID, $Fecha, $Total, $Cantidad, $Precio, $ProductoID, $UsuarioID, $ClienteID) {
        $sql = "UPDATE ventas SET Fecha = ?, Total = ?, Cantidad = ?, Precio = ?, ProductoID = ?, UsuarioID = ?, ClienteID = ? 
                WHERE ID = ?";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('sdidisii', $Fecha, $Total, $Cantidad, $Precio, $ProductoID, $UsuarioID, $ClienteID, $ID);
        
        return $stmt->execute();
    }

    // Eliminar una venta
    public function eliminarVenta($ID) {
        $sql = "DELETE FROM ventas WHERE ID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $ID);
        
        return $stmt->execute();
    }

    // Obtener todas las ventas
    public function obtenerTodasLasVentas() {
        $sql = "SELECT * FROM ventas";
        $resultado = $this->db->query($sql);
        
        $ventas = [];
        while ($row = $resultado->fetch_assoc()) {
            $ventas[] = new Venta($row['ID'], $row['Fecha'], $row['Total'], $row['Cantidad'], $row['Precio'], $row['ProductoID'], $row['UsuarioID'], $row['ClienteID']);
        }
        
        return $ventas;
    }

    // Obtener todas las ventas por UsuarioID
    public function obtenerTodasLasVentasPorUsuarioID($usuario_id) {
        $sql = "SELECT * FROM ventas WHERE UsuarioID = ?";
        $stmt = $this->db->prepare($sql);
        
        if (!$stmt) {
            die("Error en la preparación de la consulta: " . $this->db->error);
        }
    
        $stmt->bind_param('s', $usuario_id);
        $stmt->execute();
        
        $resultado = $stmt->get_result();
    
        $ventas = [];
        while ($row = $resultado->fetch_assoc()) {
            $ventas[] = new Venta($row['ID'], $row['Fecha'], $row['Total'], $row['Cantidad'], $row['Precio'], $row['ProductoID'], $row['UsuarioID'], $row['ClienteID']);
        }
        
        $stmt->close();
        return $ventas;
    }
}

