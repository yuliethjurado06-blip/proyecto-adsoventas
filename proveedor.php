<?php
require_once '../includes/headerLogin.php';
require_once '../controllers/proveedorController.php';
require_once '../controllers/autenticador.php';

// El usuario_id se obtiene de la sesión para asegurar que se muestran los datos correctos
$usuario_id = $_SESSION['usuario_id'];
$controller = new ProveedorController();
$proveedores = $controller->obtenerTodosLosProveedoresPorID($usuario_id);
?>

<main class="main">
    <section>
        <div class="container-fluid row">
            <!-- Formulario para registrar o actualizar proveedor -->
            <form class="col-4 p-3" action="../controllers/proveedorHandler.php" method="POST">
                <h2 class="text-center" id="titulo">Registro de Proveedor</h2>
                <!-- Campos del formulario -->
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre del proveedor</label>
                    <input type="text" class="form-control" name="nombre" required autofocus>
                </div>
                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input type="text" class="form-control" name="direccion" required>
                </div>
                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="tel" class="form-control" name="telefono" pattern="\d{10}" maxlength="10" title="El número de teléfono debe tener 10 dígitos." oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
                </div>
                <input type="hidden" name="usuario_id" value="<?php echo htmlspecialchars($usuario_id); ?>">
                <input type="hidden" name="accion" value="crear">
                <button type="submit" class="btn btn-primary" name="BtnRegistrar" value="OK">Registrar</button>
            </form>

            <!-- Tabla para listar proveedores -->
            <div class="col-8 p-4">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Dirección</th>
                                <th scope="col">Teléfono</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (is_array($proveedores) || is_object($proveedores)): ?>
                                <?php foreach ($proveedores as $proveedor): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($proveedor->getID()); ?></td>
                                        <td><?php echo htmlspecialchars($proveedor->getNombre()); ?></td>
                                        <td><?php echo htmlspecialchars($proveedor->getDireccion()); ?></td>
                                        <td><?php echo htmlspecialchars($proveedor->getTelefono()); ?></td>
                                        <td>
                                            <a href='actualizarProveedor.php?id=<?php echo htmlspecialchars($proveedor->getID()); ?>' class='btn btn-secondary'>
                                                <i class='fa-solid fa-pen-to-square'></i>
                                            </a>
                                            <a href='../controllers/proveedorHandler.php?accion=eliminar&id=<?php echo htmlspecialchars($proveedor->getID()); ?>' class='btn btn-danger' onclick='return confirm("¿Estás seguro de que deseas eliminar este proveedor?")'>
                                                <i class='fa-solid fa-trash'></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="5">No hay proveedores para mostrar.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
require_once '../includes/footer.php';
?>
