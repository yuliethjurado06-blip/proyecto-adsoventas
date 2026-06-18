<?php
require_once 'autenticador.php';
require_once '../models/compras.php';
require_once '../models/conexion.php';
require_once 'compraController.php';
require_once 'productoController.php';
require_once 'proveedorController.php';
$usuario_id = $_SESSION['usuario_id'];

$compraController = new CompraController();
$productoController = new ProductoController();
$proveedorController = new ProveedorController();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accion'])) {
        $accion = $_POST['accion'];
        
        $productoNombre = $_POST['producto_name']; // Cambiado de 'producto' a 'producto_name'
        $proveedorNombre = $_POST['proveedor_name']; // Cambiado de 'proveedor' a 'proveedor_name'

        // Obtén el ID del producto y proveedor basado en el nombre
        $producto = $productoController->obtenerProductoPorNombre($productoNombre, $usuario_id);
        $proveedor = $proveedorController->obtenerProveedorPorNombre($proveedorNombre, $usuario_id);

        if ($producto) {
            $producto_id = $producto->getID();
        } else {
            $_SESSION['error_message'] = "Producto no encontrado.";
            header('Location: ../templates/compras.php');
            exit();
        }

        if ($proveedor) {
            $proveedor_id = $proveedor->getID();
        } else {
            $_SESSION['error_message'] = "Proveedor no encontrado.";
            header('Location: ../templates/compras.php');
            exit();
        }

        switch ($accion) {
            case 'crear':
                $fecha = $_POST['fecha'];
                $total = $_POST['total'];
                $cantidad = $_POST['cantidad'];
                $precio = $_POST['precio'];
                
                $compraController->crearCompra($fecha, $total, $cantidad, $precio, $producto_id, $usuario_id, $proveedor_id);
                header('Location: ../templates/compras.php');
                break;

            case 'actualizar':
                $id = $_POST['id'];
                $fecha = $_POST['fecha'];
                $total = $_POST['total'];
                $cantidad = $_POST['cantidad'];
                $precio = $_POST['precio'];

                $compraController->actualizarCompra($id, $fecha, $total, $cantidad, $precio, $producto_id, $usuario_id, $proveedor_id);
                header('Location: ../templates/compras.php');
                break;

            case 'eliminar':
                $id = $_POST['id'];
                $compraController->eliminarCompra($id, $usuario_id);
                header('Location: ../templates/compras.php');
                break;

            default:
                echo "Acción no válida";
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['accion']) && $_GET['accion'] === 'eliminar') {
        $id = $_GET['id'];
        $compraController->eliminarCompra($id, $usuario_id);
        header('Location: ../templates/compras.php');
    }
}
?>
