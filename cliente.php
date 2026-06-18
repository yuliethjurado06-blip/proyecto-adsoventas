<?php
require_once '../includes/headerLogin.php';
require_once '../controllers/clienteController.php';
require_once '../controllers/autenticador.php';
$usuario_id = $_SESSION['usuario_id'];

$controller = new ClienteController();
$clientes = $controller->obtenerTodosLosClientesPorID($usuario_id);
?>

<main class="main">
    <section>
        <div class="container-fluid row">
            <form class="col-4 p-3" action="../controllers/clienteHandler.php" method="POST">
                <h2 class="text-center" id="titulo">Registro de Cliente</h2>
                <!-- Aquí va el formulario como antes -->
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nombre del cliente</label>
                    <input type="text" class="form-control" name="nombre" required autofocus>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Apellido del cliente</label>
                    <input type="text" class="form-control" name="apellido" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Correo</label>
                    <input type="email" class="form-control" name="correo" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Telefono</label>
                    <input type="tel" class="form-control" name="telefono" pattern="\d{10}" maxlength="10" title="El número de teléfono debe tener 10 dígitos." oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Direccion</label>
                    <input type="text" class="form-control" name="direccion" required>
                </div>
                <input type="hidden" name="usuario_id" value="<?php echo $usuario_id; ?>">
                <input type="hidden" name="accion" value="crear">
                <button type="submit" class="btn btn-primary" name="BtnRegistrar" value="OK">Registrar</button>
            </form>

            <div class="col-8 p-4">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Apellido</th>
                                <th scope="col">Telefono</th>
                                <th scope="col">Direccion</th>
                                <th scope="col">Correo</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (is_array($clientes) || is_object($clientes)): ?>
                                <?php foreach ($clientes as $cliente): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($cliente->getID()); ?></td>
                                        <td><?php echo htmlspecialchars($cliente->getNombre()); ?></td>
                                        <td><?php echo htmlspecialchars($cliente->getApellido()); ?></td>
                                        <td><?php echo htmlspecialchars($cliente->getTelefono()); ?></td>
                                        <td><?php echo htmlspecialchars($cliente->getDireccion()); ?></td>
                                        <td><?php echo htmlspecialchars($cliente->getCorreo()); ?></td>
                                        <td>
                                            <a href='actualizarCliente.php?id=<?php echo htmlspecialchars($cliente->getID()); ?>' class='btn btn-secondary'>
                                                <i class='fa-solid fa-pen-to-square'></i>
                                            </a>
                                            <a href='../controllers/clienteHandler.php?accion=eliminar&id=<?php echo htmlspecialchars($cliente->getID()); ?>' class='btn btn-danger' onclick='return confirm("¿Estás seguro de que deseas eliminar este cliente?")'>
                                                <i class='fa-solid fa-trash'></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="7">No hay clientes para mostrar.</td></tr>
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
