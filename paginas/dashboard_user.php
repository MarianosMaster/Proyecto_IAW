<?php
session_start();
include('../funciones/funciones_bd.php');
include('../funciones/funciones.php');

// Usuario Registrado o Admin
if (!isset($_SESSION['user'])) {
    header('Location: ../index.php');
    exit();
}

$pdo = connect_bd();
$busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';
// Si la barra de búsqueda no está vacía, busca el producto, si no, muestra todos los productos
if ($busqueda !== '') {
    $productos = buscar_producto_por_nombre($pdo, $busqueda);
} else {
    $productos = obtener_productos($pdo);
}
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
            <div class="logo" style="display:flex; align-items:center; gap: 15px;">
                <a href="dashboard_user.php"
                    style="display: flex; align-items: center; text-decoration: none; color: inherit; gap: 10px;">
                    <img src="../imagenes/logo.png" alt="Logo GeekVault" class="logo-img">
                    GeekVault
                </a>
                <!-- Barra de búsqueda -->
                <span
                    style="border-left: 2px solid #334155; padding-left: 15px; font-size: 1.1rem; text-transform: none; letter-spacing: normal; font-weight: 500;">Hola,
                    <?php echo htmlspecialchars($_SESSION['user']); ?></span>
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
        <div class="top-bar">
            <h1>Productos Disponibles</h1>
            <!-- Formulario de búsqueda -->
            <form method="GET" class="search-form" style="display: flex; gap: 10px; margin: 0;">
                <input type="text" name="busqueda" placeholder="Buscar producto..."
                    value="<?php echo htmlspecialchars($busqueda); ?>" style="margin: 0;">
                <button type="submit">Buscar</button>
                <?php if ($busqueda !== ''): ?>
                    <a href="dashboard_user.php" class="btn-secondary" style="padding: 8px 15px; width: auto;">Limpiar</a>
                <?php endif; ?>
            </form>
        </div>

        <!-- listado de productos -->
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
                <?php
            endforeach; ?>
        </div>
    </main>
</body>

</html>