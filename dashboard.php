<?php
require_once '../controllers/autenticador.php';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario_nombre'])) {
    // Redirigir a la página de inicio de sesión si no está autenticado
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- Incluyendo fuentes desde Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:wght@100..900&family=Open+Sans:wght@300..800&family=Poppins:wght@100..900&display=swap" rel="stylesheet">

    <!-- Incluyendo CSS de Bootstrap desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Incluyendo hoja de estilos personalizada -->
    <link rel="stylesheet" href="../styles.css">
</head>

<body class="fondo">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand text-black font-weight-bold" href="#">NORLIAJEFF</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mi-menu"
                aria-controls="mi-menu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="mi-menu">
                <ul class="navbar-nav">
                    <li class="nav-item"><a href="../templates/cliente.php" class="nav-link">Clientes</a></li>
                    <li class="nav-item"><a href="../templates/compras.php" class="nav-link">Compras</a></li>
                    <li class="nav-item"><a href="../templates/proveedor.php" class="nav-link">Proveedores</a></li>
                    <li class="nav-item"><a href="../templates/productos.php" class="nav-link">Productos</a></li>
                    <li class="nav-item"><a href="../templates/ventas.php" class="nav-link">Ventas</a></li>
                    <li class="nav-item"><a href="../controllers/logout.php" class="nav-link">Salir</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Banner -->
    <div class="banner">
        <div class="content">
            <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?>!</h1>
            <p>Este es tu panel de control.</p>
        </div>
    </div>

    <!-- Imagen GIF centrada -->
    <div class="container mt-3"> <!-- Ajuste de margen superior aquí -->
        <div class="d-flex justify-content-center">
            <img src="../assets/Presentación1.gif" alt="Presentación" class="img-fluid">
        </div>
    </div>

    <!-- Contenido principal -->
    <div class="container mt-4">
        <div class="d-flex justify-content-center">
            <a href="../controllers/logout.php" class="btn btn-danger">Cerrar sesión</a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-center text-lg-start mt-5">
        <div class="text-center p-3">
            <p class="text-white mb-0">&copy; 2024 Derechos Reservados NORLIAJEFF</p>
            <div class="footer-links">
                <a class="text-white" href="https://github.com/liangreyes12" target="_blank" rel="noopener noreferrer">
                    <i class="fab fa-github"></i> Liang_Reyes
                </a>
                <a class="text-white" href="https://github.com/Cristhianm30" target="_blank" rel="noopener noreferrer">
                    <i class="fab fa-github"></i> Cristhian_Moreno
                </a>
            </div>
        </div>
    </footer>

    <!-- Incluir Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Incluir jQuery desde CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 

    <!-- Incluir Bootstrap 5 desde CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Scripts personalizados -->
    <!-- <script src="/Norliajeff/script.js"></script> -->
    
</body>
</html>
