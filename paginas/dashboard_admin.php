<?php
session_start();
include('../funciones/funciones_bd.php');
include('../funciones/funciones.php');

// Verificación de seguridad: R7A (Solo Admin)
if (!isset($_SESSION['user']) || $_SESSION['rol'] !== 'A') {
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
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>

    </style>
</head>

<body>
    <header class="main-header">
        <div class="header-content">
            <div class="logo">Panel de Administración</div>
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
            <!-- Opción para usuarios con rol administrador: Añadir Producto -->
            <a href="gestion_productos.php" class="btn-add"><i class="fa-solid fa-plus"></i> Añadir Producto</a>
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
                            <!-- R7A: Admin tiene control total (Modificar y Borrar) -->
                            <a href="gestion_productos.php?id=<?php echo $producto['id']; ?>" class="btn-action btn-edit">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <a href="eliminar_producto.php?id=<?php echo $producto['id']; ?>" class="btn-action btn-delete"
                                onclick="return confirm('¿Estás seguro de querer borrar este producto?');">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>

</html>