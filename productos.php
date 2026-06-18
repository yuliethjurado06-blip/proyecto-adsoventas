<?php
require_once '../includes/headerLogin.php';
require_once '../controllers/productoController.php';
require_once '../controllers/autenticador.php';

// El usuario_id se obtiene de la sesión para asegurar que se muestran los datos correctos
$usuario_id = $_SESSION['usuario_id'];

// Crear instancias de los controladores
$productoController = new ProductoController();




// Obtener todos los productos del usuario
$productos = $productoController->obtenerTodosLosProductosPorID($usuario_id);
?>

<main class="main">
    <section>
        <div class="container-fluid row">
            <!-- Formulario para registrar o actualizar producto -->
            <form class="col-4 p-3" action="../controllers/productoHandler.php" method="POST">
                <h2 class="text-center" id="titulo">Registro de Producto</h2>
                <!-- Campos del formulario -->
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre del producto</label>
                    <input type="text" class="form-control" name="nombre" required autofocus>
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <input type="text" class="form-control" name="descripcion" required>
                </div>
                <div class="mb-3">
                    <label for="precio" class="form-label">Precio</label>
                    <input type="number" class="form-control" name="precio" step="0.01" required>
                </div>
                <div class="mb-3">
                    <label for="stock" class="form-label">Cantidad</label>
                    <input type="number" class="form-control" name="stock" required>
                </div>                
                <input type="hidden" name="usuario_id" value="<?php echo htmlspecialchars($usuario_id); ?>">
                <input type="hidden" name="accion" value="crear">
                <button type="submit" class="btn btn-primary" name="BtnRegistrar" value="OK">Registrar</button>
            </form>

            <!-- Tabla para listar productos -->
            <div class="col-8 p-4">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Cantidad</th>
                                
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($productos) && (is_array($productos) || is_object($productos))): ?>
                                <?php foreach ($productos as $producto): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($producto->getID()); ?></td>
                                        <td><?php echo htmlspecialchars($producto->getNombre()); ?></td>
                                        <td><?php echo htmlspecialchars($producto->getDescripcion()); ?></td>
                                        <td><?php echo htmlspecialchars($producto->getPrecio()); ?></td>
                                        <td><?php echo htmlspecialchars($producto->getStock()); ?></td>
                                        
                                        <td>
                                            <a href='actualizarProducto.php?id=<?php echo htmlspecialchars($producto->getID()); ?>' class='btn btn-secondary'>
                                                <i class='fa-solid fa-pen-to-square'></i>
                                            </a>
                                            <a href='../controllers/productoHandler.php?accion=eliminar&id=<?php echo htmlspecialchars($producto->getID()); ?>' class='btn btn-danger' onclick='return confirm("¿Estás seguro de que deseas eliminar este producto?")'>
                                                <i class='fa-solid fa-trash'></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="7">No hay productos para mostrar.</td></tr>
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
