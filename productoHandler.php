<?php
require_once 'autenticador.php';
require_once 'productoController.php';
$usuario_id = $_SESSION['usuario_id'];

$productoController = new ProductoController();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accion'])) {
        $accion = $_POST['accion'];

        switch ($accion) {
            case 'crear':
                $nombre = $_POST['nombre'];
                $descripcion = $_POST['descripcion'];
                $precio = $_POST['precio'];
                $stock = $_POST['stock'];             
                $productoController->crearProducto($nombre, $descripcion, $precio, $stock, $usuario_id);
                header('Location: ../templates/productos.php');
                exit;

            case 'actualizar':
                $id = $_POST['id'];
                $nombre = $_POST['nombre'];
                $descripcion = $_POST['descripcion'];
                $precio = $_POST['precio'];
                $stock = $_POST['stock'];
                
                $productoController->actualizarProducto($id, $nombre, $descripcion, $precio, $stock, $usuario_id);
                header('Location: ../templates/productos.php');
                exit;

            case 'eliminar':
                $id = $_POST['id'];
                $productoController->eliminarProducto($id, $usuario_id);
                header('Location: ../templates/productos.php');
                exit;

            default:
                echo "Acción no válida";
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['accion']) && $_GET['accion'] === 'eliminar') {
        $id = $_GET['id'];
        $productoController->eliminarProducto($id, $usuario_id);
        header('Location: ../templates/productos.php');
        exit;
    } else {
        echo "Acción no válida";
    }
} else {
    echo "Método de solicitud no válido";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productoNombre = $_POST['producto_name'];
    var_dump($productoNombre); // Esto te mostrará qué nombre de producto se está enviando
    $producto = $productoController->obtenerProductoPorNombre($productoNombre, $usuario_id);
    if ($producto === null) {
        echo "Producto no encontrado.";
    } else {
        echo "Producto encontrado: " . $producto->getNombre();
    }
}

?>
