<?php
    require_once '../includes/header.php';
?>


<main class="vh-100 d-flex justify-content-center align-items-center mt-5 mb-5">
    <div class="formulario-degradado">
        <h2 class="mb-4">Formulario de Registro</h2>
        <form id="registro-form" action="..\controllers\usuarioHandler.php" method="post">
            <div class="form-group mb-3">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" style="max-width: 100%;" required autofocus>
            </div>
            <div class="form-group mb-3">
                <label for="apellido">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" style="max-width: 100%;" required>
            </div>
            <div class="form-group mb-3">
                <label for="email">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" style="max-width: 100%;" required>
            </div>
            <div class="form-group mb-3">
                <label for="contraseña">Contraseña</label>
                <input type="password" class="form-control" id="contraseña" name="contrasena" style="max-width: 100%;" required>
            </div>
            <button type="submit" class="btn btn-primary w-25 mx-auto mb-3">OK</button>
            <br>
            <a href="Login.php">¿Ya tienes cuenta?</a> 
            <input type="hidden" name="accion" value="registrar">
        </form>
    </div>
</main>



<?php
    require_once '../includes/footer.php';
?>