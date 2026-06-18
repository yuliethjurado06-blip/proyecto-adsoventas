<?php
require_once '../includes/headerLogin.php';
require_once '../controllers/productoController.php';
require_once '../controllers/proveedorController.php'; // Necesario si vas a mostrar proveedores en el formulario
require_once '../controllers/autenticador.php';
require_once '../models/producto.php';

// Verificar si el ID está presente y es válido
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];
    $productoController = new ProductoController();
    $producto = $productoController->obtenerProductoPorID($id, $_SESSION['usuario_id']); // Obtener producto por ID

    if ($producto) {
        // Crear una instancia del controlador de proveedores para llenar el menú desplegable
        $proveedorController = new ProveedorController();
        $proveedores = $proveedorController->obtenerTodosLosProveedoresPorID($_SESSION['usuario_id']);
        ?>
        <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
            <form class="col-4 p-3" action="../controllers/productoHandler.php" method="POST">
                <h2 class="text-center" id="titulo">Actualizar Producto</h2>
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($producto->getID()); ?>">
                <input type="hidden" name="accion" value="actualizar"> <!-- Acción que indica que se está actualizando -->
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre del producto</label>
                    <input type="text" class="form-control" name="nombre" value="<?php echo htmlspecialchars($producto->getNombre()); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <input type="text" class="form-control" name="descripcion" value="<?php echo htmlspecialchars($producto->getDescripcion()); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="precio" class="form-label">Precio</label>
                    <input type="number" class="form-control" name="precio" value="<?php echo htmlspecialchars($producto->getPrecio()); ?>" step="0.01" required>
                </div>
                <div class="mb-3">
                    <label for="stock" class="form-label">Cantidad</label>
                    <input type="number" class="form-control" name="stock" value="<?php echo htmlspecialchars($producto->getStock()); ?>" required>
                </div>
                
                <input type="hidden" name="usuario_id" value="<?php echo htmlspecialchars($_SESSION['usuario_id']); ?>">
                <button type="submit" class="btn btn-primary" name="BtnActualizar" value="OK">Actualizar</button>
            </form>
        </div>
        <?php
    } else {
        echo "Producto no encontrado.";
    }
} else {
    echo "ID de producto no proporcionado.";
}
?>

<?php
require_once '../includes/footer.php';
?>
