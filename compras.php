<?php
    require_once '../controllers/autenticador.php';
    require_once "../includes/headerLogin.php";
    require_once '../controllers/compraController.php';
    require_once '../controllers/productoController.php';
    require_once '../controllers/proveedorController.php';

    $usuario_id = $_SESSION['usuario_id'];
    $compraController = new CompraController();
    $productoController = new ProductoController();
    $proveedorController = new ProveedorController();

    // Obtén las compras, productos y proveedores del usuario logueado
    $compras = $compraController->obtenerTodasLasComprasPorUsuario($usuario_id);
    $productos = $productoController->obtenerTodosLosProductosPorID($usuario_id);
    $proveedores = $proveedorController->obtenerTodosLosProveedoresPorID($usuario_id);

    // Verifica si hay un mensaje de error
    $error_message = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : '';
    unset($_SESSION['error_message']); // Limpia el mensaje de error después de mostrarlo
?>

<main class="main">
    <section>
        <div class="container-fluid row">
            <form class="col-4 p-3" action="../controllers/compraHandler.php" method="POST">
                <h2 class="text-center" id="titulo">Registro de Compra</h2>

                <?php if ($error_message): ?>
                <script>
                    alert("<?php echo htmlspecialchars($error_message); ?>");
                </script>
                <?php endif; ?>

                <div class="mb-3">
                    <label for="producto_id" class="form-label">Producto</label>
                    <input type="text" class="form-control" name="producto_name" id="producto_id" list="productos" onchange="actualizarPrecio(this.value)" required>
                    <datalist id="productos">
                        <?php foreach ($productos as $producto): ?>
                            <option value="<?php echo htmlspecialchars($producto->getNombre()); ?>" data-precio="<?php echo $producto->getPrecio(); ?>">
                        <?php endforeach; ?>
                    </datalist>
                </div>

                <div class="mb-3">
                    <label for="proveedor_id" class="form-label">Proveedor</label>
                    <input type="text" class="form-control" name="proveedor_name" id="proveedor_id" list="proveedores" required>
                    <datalist id="proveedores">
                        <?php foreach ($proveedores as $proveedor): ?>
                            <option value="<?php echo htmlspecialchars($proveedor->getNombre()); ?>">
                        <?php endforeach; ?>
                    </datalist>
                </div>

                

                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input type="date" class="form-control" name="fecha" required autofocus>
                </div>
                
                <div class="mb-3">
                    <label for="cantidad" class="form-label">Cantidad</label>
                    <input type="number" class="form-control" name="cantidad" id="cantidad" required oninput="calcularTotal()">
                </div>

                <div class="mb-3">
                    <label for="precio" class="form-label">Precio</label>
                    <input type="number" id="precio" class="form-control readonly-textbox" name="precio" value="" required oninput="calcularTotal()" readonly>
                </div>
                
                <div class="mb-3">
                    <label for="total" class="form-label">Total</label>
                    <input type="number" step="0.01" class="form-control readonly-textbox" name="total" id="total" readonly>
                </div>

                <input type="hidden" name="usuario_id" value="<?php echo htmlspecialchars($usuario_id); ?>">
                <input type="hidden" name="accion" value="crear">
                <button type="submit" class="btn btn-primary" name="BtnRegistrar" value="OK">Registrar</button>
            </form>

            <script>
                function calcularTotal() {
                    var cantidad = document.getElementById('cantidad').value;
                    var precio = document.getElementById('precio').value;
                    var total = document.getElementById('total');

                    // Asegúrate de que ambos valores sean numéricos antes de calcular
                    if (!isNaN(cantidad) && !isNaN(precio) && cantidad !== '' && precio !== '') {
                        total.value = (cantidad * precio).toFixed(2);
                    } else {
                        total.value = ''; // Limpia el valor si falta algún campo
                    }
                }

                // Ejecutar la función para configurar el valor inicial si hay valores predeterminados
                document.addEventListener('DOMContentLoaded', function() {
                    calcularTotal();
                });
            </script>

            <script>
                function actualizarPrecio(productoNombre) {
                    const datalist = document.getElementById('productos');
                    const opciones = datalist.children;

                    let precio = '';
                    // Buscar el precio correspondiente al producto seleccionado
                    for (let i = 0; i < opciones.length; i++) {
                        if (opciones[i].value === productoNombre) {
                            precio = opciones[i].getAttribute('data-precio');
                            break;
                        }
                    }

                    // Actualizar el campo precio
                    document.getElementById('precio').value = precio || '0.00';
                }
            </script>


            <div class="col-8 p-4">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Producto</th>
                                <th scope="col">Proveedor</th>
                                <th scope="col">Fecha</th>                                
                                <th scope="col">Cantidad</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Total</th>
                                
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($compras)): ?>
                                <?php foreach ($compras as $compra): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($compra->getID()); ?></td>
                                        <td>
                                            <?php
                                                $producto = $productoController->obtenerProductoPorID($compra->getProductoID(), $usuario_id);
                                                echo htmlspecialchars($producto ? $producto->getNombre() : 'No disponible');
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                $proveedor = $proveedorController->obtenerProveedorPorID($compra->getProveedorID(), $usuario_id);
                                                echo htmlspecialchars($proveedor ? $proveedor->getNombre() : 'No disponible');
                                            ?>
                                        </td>
                                        <td><?php echo htmlspecialchars($compra->getFecha()); ?></td>
                                        <td><?php echo htmlspecialchars($compra->getCantidad()); ?></td>
                                        <td><?php echo htmlspecialchars($compra->getPrecio()); ?></td>
                                        <td><?php echo htmlspecialchars($compra->getTotal()); ?></td>
                                        
                                        <td>
                                            <a href='actualizarCompras.php?id=<?php echo htmlspecialchars($compra->getID()); ?>' class='btn btn-secondary'>
                                                <i class='fa-solid fa-pen-to-square'></i>
                                            </a>
                                            <a href='../controllers/compraHandler.php?accion=eliminar&id=<?php echo htmlspecialchars($compra->getID()); ?>' class='btn btn-danger' onclick='return confirm("¿Estás seguro de que deseas eliminar esta compra?")'>
                                                <i class='fa-solid fa-trash'></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="8">No hay compras para mostrar.</td></tr>
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
