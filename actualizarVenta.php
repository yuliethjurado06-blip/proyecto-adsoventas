<?php
require_once '../includes/headerLogin.php';
require_once '../controllers/ventasController.php';
require_once '../controllers/productoController.php';
require_once '../controllers/clienteController.php';
require_once '../controllers/autenticador.php';
$usuario_id = $_SESSION['usuario_id'];

// Verificar si el ID está presente y es válido
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];
    $ventasController = new VentasController();
    $venta = $ventasController->obtenerVentaPorID($id,$usuario_id); // Obtener venta por ID

    if ($venta) {
        // Crear instancias de los controladores para llenar los menús desplegables
        $productoController = new ProductoController();
        $clienteController = new ClienteController();
        $productos = $productoController->obtenerTodosLosProductosPorID($usuario_id);
        $clientes = $clienteController->obtenerClientesPorUsuarioID($usuario_id);
        $productoNombre = '';
        foreach ($productos as $producto) {
            if ($producto->getID() == $venta->getProductoID()) {
                $productoNombre = $producto->getNombre();
                break;
            }
        }
        ?>
        <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
            <form class="col-4 p-3" action="../controllers/ventasHandler.php" method="POST">
                <h2 class="text-center" id="titulo">Actualizar Venta</h2>
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($venta->getID()); ?>">
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
                    <label for="cliente_id" class="form-label">Cliente</label>
                    <input type="text" class="form-control" name="cliente_name" id="cliente_id" list="clientes" value="<?php 
                        // Buscar el nombre del cliente correspondiente al ID almacenado en la compra
                        $clienteNombre = '';
                        foreach ($clientes as $cliente) {
                            if ($cliente->getID() == $venta->getClienteID()) {
                                $clienteNombre = $cliente->getNombre();
                                break;
                            }
                        }
                        echo htmlspecialchars($clienteNombre);
                    ?>" 
                    required>
                    <datalist id="clientes">
                        <?php foreach ($clientes as $cliente): ?>
                            <option value="<?php echo htmlspecialchars($cliente->getNombre()); ?>">
                        <?php endforeach; ?>
                    </datalist>
                </div>

                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input type="date" class="form-control" name="fecha" value="<?php echo htmlspecialchars($venta->getFecha()); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="cantidad" class="form-label">Cantidad</label>
                    <input type="number" class="form-control" name="cantidad" value="<?php echo htmlspecialchars($venta->getCantidad()); ?>" id="cantidad" required onchange="actualizarTotal()">
                </div>
                <div class="mb-3">
                    <label for="precio" class="form-label">Precio</label>
                    <input type="text" class="form-control readonly-textbox" id="precio" name="precio" value="<?php echo htmlspecialchars($venta->getPrecio()); ?>" readonly>
                    
                </div>
                <div class="mb-3">
                    <label for="total" class="form-label">Total</label>
                    <input type="number" class="form-control readonly-textbox"name="total" id="total" value="<?php echo htmlspecialchars($venta->getTotal()); ?>" readonly>
                    
                </div>
                <input type="hidden" name="usuario_id" value="<?php echo htmlspecialchars($usuario_id); ?>">
                <button type="submit" class="btn btn-primary" name="BtnActualizar" value="OK">Actualizar</button>
            </form>
        </div>
        
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
        echo "Venta no encontrada.";
    }
} else {
    echo "ID de venta no proporcionado.";
}
?>

<?php
require_once '../includes/footer.php';
?>
