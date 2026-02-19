<?php
session_start();
include('../funciones/funciones_bd.php');
include('../funciones/funciones.php');

// Verificación de seguridad: Usuario Registrado o Admin
if (!isset($_SESSION['user'])) {
    header('Location: ../index.php');
    exit();
}

$pdo = connect_bd();
$productos = obtener_productos($pdo);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Usuario</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>

    </style>
</head>

<body>
    <header class="main-header">
        <div class="header-content">
            <div class="logo">Hola,
                <?php echo htmlspecialchars($_SESSION['user']); ?>
            </div>
            <nav>
                <ul>
                    <li><a href="perfil.php"> <i class="fa-solid fa-user"></i> Mi Perfil</a></li>
                    <li><a href="logout.php"> <i class="fa-solid fa-sign-out-alt"></i> Cerrar Sesión</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="dashboard-container">
        <h1>Productos Disponibles</h1>
        <!-- R7B: Usuario registrado solo puede consultar información (R6) -->
        <div class="products-grid">
            <?php foreach ($productos as $producto): ?>
                <div class="product-card">
                    <div class="product-title">
                        <?php echo htmlspecialchars($producto['nombre']); ?>
                    </div>
                    <p>
                        <?php echo htmlspecialchars($producto['descripcion']); ?>
                    </p>
                    <div class="product-price">
                        <?php echo htmlspecialchars($producto['precio']); ?> €
                    </div>
                    <div class="product-stock">Stock:
                        <?php echo htmlspecialchars($producto['stock']); ?> unid.
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
</body>

</html>