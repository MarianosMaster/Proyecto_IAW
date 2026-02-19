<?php
session_start();
include('../funciones/funciones_bd.php');
include('../funciones/funciones.php');

if (!isset($_SESSION['user']) || $_SESSION['rol'] !== 'A') {
    header('Location: ../index.php');
    exit();
}

$pdo = connect_bd();
$producto = null;
$es_edicion = false;

if (isset($_GET['id'])) {
    $producto = obtener_producto_por_id($pdo, $_GET['id']);
    $es_edicion = true;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        if (actualizar_producto($pdo, $_POST['id'], $nombre, $descripcion, $precio, $stock)) {
            header('Location: dashboard_admin.php');
            exit();
        }
    } else {
        if (crear_producto($pdo, $nombre, $descripcion, $precio, $stock)) {
            header('Location: dashboard_admin.php');
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo $es_edicion ? 'Editar' : 'Añadir'; ?> Producto
    </title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="form-container">
        <h2>
            <?php echo $es_edicion ? 'Editar Producto' : 'Nuevo Producto'; ?>
        </h2>
        <form method="POST">
            <?php if ($es_edicion): ?>
                <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
            <?php endif; ?>

            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="nombre"
                    value="<?php echo $es_edicion ? htmlspecialchars($producto['nombre']) : ''; ?>" required>
            </div>

            <div class="form-group">
                <label>Descripción</label>
                <textarea name="descripcion"
                    required><?php echo $es_edicion ? htmlspecialchars($producto['descripcion']) : ''; ?></textarea>
            </div>

            <div class="form-group">
                <label>Precio (€)</label>
                <input type="number" step="0.01" name="precio"
                    value="<?php echo $es_edicion ? htmlspecialchars($producto['precio']) : ''; ?>" required>
            </div>

            <div class="form-group">
                <label>Stock</label>
                <input type="number" name="stock"
                    value="<?php echo $es_edicion ? htmlspecialchars($producto['stock']) : ''; ?>" required>
            </div>

            <button type="submit" class="btn-submit">
                <?php echo $es_edicion ? 'Guardar Cambios' : 'Crear Producto'; ?>
            </button>

            <div style="margin-top: 15px; text-align: center;">
                <a href="dashboard_admin.php" style="color: #666; text-decoration: none;">Cancelar</a>
            </div>
        </form>
    </div>
</body>

</html>