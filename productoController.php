<?php

require_once '../models/producto.php';  
require_once '../models/conexion.php';  

class ProductoController {
    private $db;

    public function __construct() {
        $conexion = new Conexion();
        $this->db = $conexion->getConexion();
    }

    // Crear un nuevo producto
    public function crearProducto($Nombre, $Descripcion, $Precio, $Stock, $usuario_id) {
        $sql = "INSERT INTO productos (Nombre, Descripcion, Precio, Stock, UsuarioID) 
                VALUES (?, ?, ?, ?, ?)";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('ssdis', $Nombre, $Descripcion, $Precio, $Stock, $usuario_id);
        
        return $stmt->execute();
    }

    // Obtener un producto por ID
    public function obtenerProductoPorID($ID, $usuario_id) {
        $sql = "SELECT * FROM productos WHERE ID = ? AND UsuarioID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('is', $ID, $usuario_id);
        $stmt->execute();
        
        $resultado = $stmt->get_result()->fetch_assoc();
        if ($resultado) {
            return new Producto($resultado['ID'], $resultado['Nombre'], $resultado['Descripcion'], $resultado['Precio'], $resultado['Stock']);
        }
        
        return null;
    }

    // Actualizar un producto.
    public function actualizarProducto($ID, $Nombre, $Descripcion, $Precio, $Stock, $usuario_id) {
        $sql = "UPDATE productos SET Nombre = ?, Descripcion = ?, Precio = ?, Stock = ? WHERE ID = ? AND UsuarioID = ?";

        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('ssdiis', $Nombre, $Descripcion, $Precio, $Stock, $ID, $usuario_id);
        
        return $stmt->execute();
    }

    // Eliminar un producto
    public function eliminarProducto($ID, $usuario_id) {
        $sql = "DELETE FROM productos WHERE ID = ? AND UsuarioID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('is', $ID, $usuario_id);
        
        return $stmt->execute();
    }
    

    // Obtener todos los productos del usuario
    public function obtenerTodosLosProductosPorID($usuario_id) {
        $sql = "SELECT * FROM productos WHERE UsuarioID = ?";
        $stmt = $this->db->prepare($sql);
        
        if (!$stmt) {
            die("Error en la preparación de la consulta: " . $this->db->error);
        }

        $stmt->bind_param('s', $usuario_id);
        $stmt->execute();
        
        $resultado = $stmt->get_result();

        $productos = [];
        while ($row = $resultado->fetch_assoc()) {
            $productos[] = new Producto($row['ID'], $row['Nombre'], $row['Descripcion'], $row['Precio'], $row['Stock']);
        }
        
        $stmt->close();
        return $productos;
    }
    public function obtenerProductoPorNombre($nombre, $usuario_id) {
        $sql = "SELECT * FROM productos WHERE Nombre = ? AND UsuarioID = ?";
        $stmt = $this->db->prepare($sql);
        
        if (!$stmt) {
            die("Error en la preparación de la consulta: " . $this->db->error);
        }
    
        $stmt->bind_param('ss', $nombre, $usuario_id);
        $stmt->execute();
        
        $resultado = $stmt->get_result();
    
        if ($row = $resultado->fetch_assoc()) {
            return new Producto($row['ID'], $row['Nombre'], $row['Descripcion'], $row['Precio'], $row['Stock']);
        }
    
        $stmt->close();
        return null;
    }
}
?>
