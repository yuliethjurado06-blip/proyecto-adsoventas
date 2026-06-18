<?php
require_once 'autenticador.php';
require_once '../models/compras.php';  
require_once '../models/conexion.php'; 

class CompraController {
    private $db;

    public function __construct() {
        $conexion = new Conexion();
        $this->db = $conexion->getConexion();
    }

    // Crear una nueva compra
    public function crearCompra($Fecha, $Total, $Cantidad, $Precio, $ProductoID, $UsuarioID, $ProveedorID) {
        $sql = "INSERT INTO compras (Fecha, Total, Cantidad, Precio, ProductoID, UsuarioID, ProveedorID) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('sdisisi', $Fecha, $Total, $Cantidad, $Precio, $ProductoID, $UsuarioID, $ProveedorID);
        
        return $stmt->execute();
    }

    // Obtener una compra por ID
    public function obtenerCompraPorID($ID, $UsuarioID) {
        $sql = "SELECT * FROM compras WHERE ID = ? AND UsuarioID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('is', $ID, $UsuarioID);
        $stmt->execute();
        $resultado = $stmt->get_result()->fetch_assoc();
        if ($resultado) {
            return new Compra($resultado['ID'], $resultado['Fecha'], $resultado['Total'], $resultado['Cantidad'], $resultado['Precio'], $resultado['ProductoID'], $resultado['UsuarioID'], $resultado['ProveedorID']);
        }
        
        return null;
    }

    // Actualizar una compra
    public function actualizarCompra($ID, $Fecha, $Total, $Cantidad, $Precio, $ProductoID, $UsuarioID, $ProveedorID) {
        $sql = "UPDATE compras SET Fecha = ?, Total = ?, Cantidad = ?, Precio = ?, ProductoID = ?, ProveedorID = ? 
                WHERE ID = ? AND UsuarioID = ?";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('sdidiiis', $Fecha, $Total, $Cantidad, $Precio, $ProductoID, $ProveedorID, $ID, $UsuarioID);
        
        return $stmt->execute();
    }

    // Eliminar una compra
    public function eliminarCompra($ID, $UsuarioID) {
        $sql = "DELETE FROM compras WHERE ID = ? AND UsuarioID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('is', $ID, $UsuarioID);
        
        return $stmt->execute();
    }

    // Obtener todas las compras del usuario
    public function obtenerTodasLasComprasPorUsuario($UsuarioID) {
        $sql = "SELECT * FROM compras WHERE UsuarioID = ?";
        $stmt = $this->db->prepare($sql);
        
        if (!$stmt) {
            die("Error en la preparación de la consulta: " . $this->db->error);
        }

        $stmt->bind_param('s', $UsuarioID);
        $stmt->execute();
        
        $resultado = $stmt->get_result();

        $compras = [];
        while ($row = $resultado->fetch_assoc()) {
            $compras[] = new Compra($row['ID'], $row['Fecha'], $row['Total'], $row['Cantidad'], $row['Precio'], $row['ProductoID'], $row['UsuarioID'], $row['ProveedorID']);
        }
        
        $stmt->close();
        return $compras;
    }
}
?>
