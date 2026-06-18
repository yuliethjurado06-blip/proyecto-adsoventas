<?php
require_once 'usuarioController.php'; // Ajusta la ruta según sea necesario

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accion'])) {
        $accion = $_POST['accion'];

        // Crear una instancia del controlador de usuario
        $usuarioController = new UsuarioController();

        session_start(); // Iniciar sesión para manejar mensajes de error

        switch ($accion) {
            case 'registrar':
                $nombre = $_POST['nombre'];
                $apellido = $_POST['apellido'];
                $email = $_POST['email'];
                $contrasena = $_POST['contrasena'];

                // Intentar crear el usuario
                $resultado = $usuarioController->crearUsuario($nombre, $apellido, $email, $contrasena);

                if ($resultado) {
                    // Redirigir al usuario a la página de inicio de sesión
                    header('Location: ../templates/login.php');
                    exit();
                } else {
                    $_SESSION['error'] = "Error al registrar el usuario. Por favor, inténtalo de nuevo.";
                    header('Location: ../templates/singUp.php');
                    exit();
                }

            case 'login':
                $email = $_POST['email'];
                $contrasena = $_POST['contrasena'];

                // Verificar las credenciales
                $usuario = $usuarioController->verificarCredenciales($email, $contrasena);

                if ($usuario !== null) {
                    $_SESSION['usuario_id'] = $usuario->getID();
                    $_SESSION['usuario_nombre'] = $usuario->getNombre();

                    header('Location: ../templates/dashboard.php');
                    exit();
                } else {
                    // Guardar mensaje de error en la sesión
                    $_SESSION['error'] = "Correo electrónico o contraseña incorrectos.";
                    header('Location: ../templates/login.php');
                    exit();
                }

            default:
                $_SESSION['error'] = "Acción no reconocida.";
                header('Location: ../templates/login.php');
                exit();
        }
    }
}
?>
