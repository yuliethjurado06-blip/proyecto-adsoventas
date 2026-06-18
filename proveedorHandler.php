<?php
require_once 'autenticador.php';
require_once 'proveedorController.php'; // Asegúrate de que la ruta sea correcta
$usuario_id = $_SESSION['usuario_id'];
$proveedorController = new ProveedorController();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accion'])) {
        $accion = $_POST['accion'];

        switch ($accion) {
            case 'crear':
                $nombre = $_POST['nombre'];
                $direccion = $_POST['direccion'];
                $telefono = $_POST['telefono'];
                $usuarioID = $_POST['usuario_id'];
                $proveedorController->crearProveedor($nombre, $direccion, $telefono, $usuarioID);
                header('Location: ../templates/proveedor.php');
                break;

            case 'actualizar':
                $id = $_POST['id'];
                $nombre = $_POST['nombre'];
                $direccion = $_POST['direccion'];
                $telefono = $_POST['telefono'];
                $usuarioID = $_POST['usuario_id'];
                $proveedorController->actualizarProveedor($id, $nombre, $direccion, $telefono, $usuarioID);
                header('Location: ../templates/proveedor.php');
                break;

            case 'eliminar':
                $id = $_GET['id'];
                $proveedorController->eliminarProveedor($id);
                header('Location: ../templates/proveedor.php');
                break;

            default:
                echo "Acción no válida";
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['accion'])) {
        $accion = $_GET['accion'];

        switch ($accion) {
            case 'eliminar':
                $id = $_GET['id'];
                $proveedorController->eliminarProveedor($id);
                header('Location: ../templates/proveedor.php');
                break;

            default:
                echo "Acción no válida";
        }
    }
} else {
    echo "Método HTTP no soportado";
}
?>
