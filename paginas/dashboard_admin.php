<?php
session_start();
include('../funciones/funciones_bd.php');
include('../funciones/funciones.php');
if (!isset($_SESSION['user']) || $_SESSION['rol'] !== 'A') {
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
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>

    </style>
</head>

<body>
    <header class="main-header">
        <div class="header-content">
            <div class="logo" style="display:flex; align-items:center; gap: 15px;">
                <a href="dashboard_admin.php"
                    style="display: flex; align-items: center; text-decoration: none; color: inherit; gap: 10px;">
                    <img src="../imagenes/logo.png" alt="Logo GeekVault" class="logo-img">
                    GeekVault
                </a>
                <span style="border-left: 2px solid #334155; padding-left: 15px; font-size: 1.1rem;">Panel Admin</span>
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
            <h1>Gestión de Productos</h1>
            <div class="top-actions" style="display: flex; gap: 20px; align-items: center;">
                <!-- Formulario de búsqueda -->
                <form method="GET" class="search-form" style="display: flex; gap: 10px; margin: 0;">
                    <input type="text" name="busqueda" placeholder="Buscar producto..."
                        value="<?php echo htmlspecialchars($busqueda); ?>" style="margin: 0;">
                    <button type="submit">Buscar</button>
                    <?php if ($busqueda !== ''): ?>
                        <a href="dashboard_admin.php" class="btn-secondary"
                            style="padding: 8px 15px; width: auto;">Limpiar</a>
                    <?php endif; ?>
                </form>
                <a href="gestion_productos.php" class="btn-add"><i class="fa-solid fa-plus"></i> Añadir Producto</a>
            </div>
        </div>

        <table class="products-table">
            <thead>

                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- listado de productos -->
                <?php foreach ($productos as $producto): ?>
                    <tr>
                        <td>
                            <?php echo $producto['id']; ?>
                        </td>
                        <td>
                            <?php echo $producto['nombre']; ?>
                        </td>
                        <td>
                            <?php echo $producto['descripcion']; ?>
                        </td>
                        <td>
                            <?php echo $producto['precio']; ?> €
                        </td>
                        <td>
                            <?php echo $producto['stock']; ?>

                        </td>
                        <td>
                            <!-- Botones de borrado y update -->
                            <a href="gestion_productos.php?id=<?php echo $producto['id']; ?>" class="btn-action btn-edit">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <a href="eliminar_producto.php?id=<?php echo $producto['id']; ?>" class="btn-action btn-delete"
                                onclick="return confirm('¿Estás seguro de querer borrar este producto?');">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php
                endforeach; ?>
            </tbody>
        </table>
    </main>
</body>

</html>