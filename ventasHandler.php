<?php
require_once 'autenticador.php';
require_once '../models/ventas.php';
require_once '../models/conexion.php';
require_once 'ventasController.php';
require_once 'productoController.php';
require_once 'clienteController.php';
$usuario_id = $_SESSION['usuario_id'];

$ventasController = new VentasController();
$productoController = new ProductoController();
$clienteController = new clienteController();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accion'])) {
        $accion = $_POST['accion'];

        $productoNombre = $_POST['producto_name']; 
        $clienteNombre = $_POST['cliente_name']; 

        // Obtén el ID del producto y cliente basado en el nombre
        $producto = $productoController->obtenerProductoPorNombre($productoNombre, $usuario_id);
        $cliente = $clienteController->obtenerclientePorNombre($clienteNombre, $usuario_id);

        if ($producto) {
            $producto_id = $producto->getID();
        } else {
            $_SESSION['error_message'] = "Producto no encontrado.";
            header('Location: ../templates/ventas.php');
            exit();
        }

        if ($cliente) {
            $cliente_id = $cliente->getID();
        } else {
            $_SESSION['error_message'] = "Cliente no encontrado.";
            header('Location: ../templates/ventas.php');
            exit();
        }

        switch ($accion) {
            case 'crear':
                $fecha = $_POST['fecha'];
                $total = $_POST['total'];
                $cantidad = $_POST['cantidad'];
                $precio = $_POST['precio'];
               

                $ventasController->crearVenta($fecha, $total, $cantidad, $precio, $producto_id, $usuario_id,  $cliente_id);
                header('Location: ../templates/ventas.php');
                break;

            case 'actualizar':
                $id = $_POST['id'];
                $fecha = $_POST['fecha'];
                $total = $_POST['total'];
                $cantidad = $_POST['cantidad'];
                $precio = $_POST['precio'];
                

                $ventasController->actualizarVenta($id, $fecha, $total, $cantidad, $precio, $producto_id, $usuario_id,  $cliente_id);
                header('Location: ../templates/ventas.php');
                break;

            case 'eliminar':
                $id = $_GET['id'];
                $ventasController->eliminarVenta($id);
                header('Location: ../templates/ventas.php');
                break;

            default:
                echo "Acción no válida";
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['accion']) && $_GET['accion'] === 'eliminar') {
        $id = $_GET['id'];
        $ventasController->eliminarVenta($id);
        header('Location: ../templates/ventas.php');
    }
}
?>
