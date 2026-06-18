<?php
require_once '../includes/headerLogin.php';
require_once '../controllers/proveedorController.php';
require_once '../controllers/autenticador.php';
require_once '../models/proveedor.php';
$usuario_id = $_SESSION['usuario_id'];
// Verificar si el ID está presente y es válido
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];
    $proveedorController = new ProveedorController();
    $proveedor = $proveedorController->obtenerProveedorPorID($id,$usuario_id ); // Obtener proveedor por ID

    if ($proveedor) {
        ?>
        <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
            <form class="col-4 p-3" action="../controllers/proveedorHandler.php" method="POST">
                <h2 class="text-center" id="titulo">Actualizar Proveedor</h2>
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($proveedor->getID()); ?>">
                <input type="hidden" name="accion" value="actualizar"> <!-- Acción que indica que se está actualizando -->
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre del proveedor</label>
                    <input type="text" class="form-control" name="nombre" value="<?php echo htmlspecialchars($proveedor->getNombre()); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input type="text" class="form-control" name="direccion" value="<?php echo htmlspecialchars($proveedor->getDireccion()); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="tel" class="form-control" name="telefono" value="<?php echo htmlspecialchars($proveedor->getTelefono()); ?>" pattern="\d{10}" maxlength="10" title="El número de teléfono debe tener 10 dígitos." oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
                </div>
                <input type="hidden" name="usuario_id" value="<?php echo htmlspecialchars($proveedor->getUsuarioID()); ?>">
                <button type="submit" class="btn btn-primary" name="BtnActualizar" value="OK">Actualizar</button>
            </form>
        </div>
        <?php
    } else {
        echo "Proveedor no encontrado.";
    }
} else {
    echo "ID de proveedor no proporcionado.";
}
?>

<?php
    require_once '../includes/footer.php';
?>
