<?php
require_once '../includes/headerLogin.php';
require_once '../controllers/clienteController.php';
require_once '../controllers/autenticador.php';
require_once '../models/cliente.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $clienteController = new ClienteController();
    $cliente = $clienteController->obtenerClientePorID($id,$_SESSION['usuario_id'] ); // Crear un nuevo método para obtener un cliente por ID
    if ($cliente) {
        ?>
        <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
            <form class="col-4 p-3" action="../controllers/clienteHandler.php" method="POST">
                <h2 class="text-center" id="titulo">Actualizar Cliente</h2>
                <input type="hidden" name="id" value="<?php echo $cliente->getID(); ?>">
                <input type="hidden" name="accion" value="actualizar"> <!-- Acción que indica que se está actualizando -->
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre del cliente</label>
                    <input type="text" class="form-control" name="nombre" value="<?php echo $cliente->getNombre(); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellido del cliente</label>
                    <input type="text" class="form-control" name="apellido" value="<?php echo $cliente->getApellido(); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="correo" class="form-label">Correo</label>
                    <input type="email" class="form-control" name="correo" value="<?php echo $cliente->getCorreo(); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="telefono" class="form-label">Telefono</label>
                    <input type="tel" id="telefono" class="form-control" name="telefono" value="<?php echo $cliente->getTelefono(); ?>" pattern="\d{10}" maxlength="10" title="El número de teléfono debe tener 10 dígitos." oninput="this.value = this.value.replace(/[^0-9]/g, '');"  required>
                </div>
                <div class="mb-3">
                    <label for="direccion" class="form-label">Direccion</label>
                    <input type="text" class="form-control" name="direccion" value="<?php echo $cliente->getDireccion(); ?>" required>
                </div>
                <input type="hidden" name="usuario_id" value="<?php echo htmlspecialchars($cliente->getUsuarioID()); ?>">
                <button type="submit" class="btn btn-primary" name="BtnActualizar" value="OK">Actualizar</button>
            </form>
        </div>
        <?php
    } else {
        echo "Cliente no encontrado.";
    }
} else {
    echo "ID de cliente no proporcionado.";
}
?>

<?php
    require_once '../includes/footer.php';
?>
