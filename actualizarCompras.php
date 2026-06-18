<?php
require_once '../includes/headerLogin.php';
require_once '../controllers/compraController.php';
require_once '../controllers/productoController.php';
require_once '../controllers/proveedorController.php';
require_once '../controllers/autenticador.php';
$usuario_id = $_SESSION['usuario_id'];

// Verificar si el ID está presente y es válido
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];
    $compraController = new CompraController();
    $compra = $compraController->obtenerCompraPorID($id, $usuario_id); // Obtener compra por ID

    if ($compra) {
        // Crear instancias de los controladores para llenar los menús desplegables
        $productoController = new ProductoController();
        $proveedorController = new ProveedorController();
        $productos = $productoController->obtenerTodosLosProductosPorID($usuario_id);
        $proveedores = $proveedorController->obtenerTodosLosProveedoresPorID($usuario_id);
        // Buscar el nombre del producto correspondiente al ID almacenado en la compra
        $productoNombre = '';
        foreach ($productos as $producto) {
            if ($producto->getID() == $compra->getProductoID()) {
                $productoNombre = $producto->getNombre();
                break;
            }
        }
        ?>
        <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
            <form class="col-4 p-3" action="../controllers/compraHandler.php" method="POST">
                <h2 class="text-center" id="titulo">Actualizar Compra</h2>
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($compra->getID()); ?>">
                <input type="hidden" name="accion" value="actualizar"> <!-- Acción que indica que se está actualizando -->
                <div class="mb-3">
                    <label for="producto_id" class="form-label">Producto</label>
                    <input type="text" class="form-control" name="producto_name" id="producto_id" list="productos" value="<?php echo htmlspecialchars($productoNombre); ?>" onchange="actualizarPrecioYTotal()" required>
                    <datalist id="productos">
                        <?php foreach ($productos as $producto): ?>
                            <option value="<?php echo htmlspecialchars($producto->getNombre()); ?>" 
                                    data-precio="<?php echo $producto->getPrecio(); ?>"
                                    data-id="<?php echo $producto->getID(); ?>">
                        <?php endforeach; ?>
                    </datalist>
                </div>
                    <div class="mb-3">
                        <label for="proveedor_id" class="form-label">Proveedor</label>
                        <input type="text" class="form-control" name="proveedor_name" id="proveedor_id" list="proveedores" value="<?php 
                                // Buscar el nombre del proveedor correspondiente al ID almacenado en la compra
                                $proveedorNombre = '';
                                foreach ($proveedores as $proveedor) {
                                    if ($proveedor->getID() == $compra->getProveedorID()) {
                                        $proveedorNombre = $proveedor->getNombre();
                                        break;
                                    }
                                }
                                echo htmlspecialchars($proveedorNombre);
                            ?>" 
                            required>
                        <datalist id="proveedores">
                            <?php foreach ($proveedores as $proveedor): ?>
                                <option value="<?php echo htmlspecialchars($proveedor->getNombre()); ?>">
                            <?php endforeach; ?>
                        </datalist>
                    </div>
                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input type="date" class="form-control" name="fecha" value="<?php echo htmlspecialchars($compra->getFecha()); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="cantidad" class="form-label">Cantidad</label>
                    <input type="number" class="form-control" name="cantidad" value="<?php echo htmlspecialchars($compra->getCantidad()); ?>" id="cantidad" required onchange="actualizarTotal()">
                </div>
                <div class="mb-3">
                    <label for="precio" class="form-label">Precio</label>
                    <input type="text" class="form-control readonly-textbox" id="precio" name="precio" value="<?php echo htmlspecialchars($compra->getPrecio()); ?>" readonly>
                    
                </div>
                <div class="mb-3">
                    <label for="total" class="form-label">Total</label>
                    <input type="number" class="form-control readonly-textbox"name="total" id="total" value="<?php echo htmlspecialchars($compra->getTotal()); ?>" readonly>
                    
                </div>
                
                
                <input type="hidden" name="usuario_id" value="<?php echo htmlspecialchars($usuario_id); ?>">
                <button type="submit" class="btn btn-primary" name="BtnActualizar" value="OK">Actualizar</button>
            </form>
        </div>

        <!-- Script para actualizar el precio y el total -->
        <script>
            function actualizarPrecioYTotal() {
                const datalist = document.getElementById('productos');
                const opciones = datalist.children;
                const productoNombre = document.getElementById('producto_id').value;
                let precio = '';
                let productoID = '';

                // Buscar el precio y el ID correspondiente al producto seleccionado
                for (let i = 0; i < opciones.length; i++) {
                    if (opciones[i].value === productoNombre) {
                        precio = opciones[i].getAttribute('data-precio');
                        productoID = opciones[i].getAttribute('data-id');
                        break;
                    }
                }

                // Actualizar el precio en el campo visible y en el campo oculto
                document.getElementById('precio').value = precio || '0.00';
                

                // Actualizar total automáticamente
                actualizarTotal();
            }

            function actualizarTotal() {
                const cantidad = parseFloat(document.getElementById('cantidad').value) || 0;
                const precio = parseFloat(document.getElementById('precio').value) || 0;
                const total = cantidad * precio;

                // Actualizar el campo total y el campo oculto
                document.getElementById('total').value = total.toFixed(2);
                
            }

            // Llamar a la función para inicializar el total cuando la página cargue
            document.addEventListener('DOMContentLoaded', function() {
                actualizarPrecioYTotal();  // Inicializa el precio y total al cargar la página
            });
        </script>

<?php
    } else {
        echo "Compra no encontrada.";
    }
} else {
    echo "ID de compra no proporcionado.";
}
?>

<?php
require_once '../includes/footer.php';
?>
