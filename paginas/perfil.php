<?php
session_start();
include('../funciones/funciones_bd.php');
include('../funciones/funciones.php');

if (!isset($_SESSION['user'])) {
    header('Location: ../index.php');
    exit();
}

$mensaje = '';
$tipo_mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nuevo_usuario = trim($_POST['username']);
    $nueva_pass = trim($_POST['password']);

    if (!empty($nuevo_usuario) && !empty($nueva_pass)) {
        $pdo = connect_bd();
        // R2: Modificación de nombre de usuario y contraseña
        if (actualizar_perfil($pdo, $_SESSION['user'], $nuevo_usuario, $nueva_pass)) {
            $_SESSION['user'] = $nuevo_usuario; // Actualizamos la sesión
            $mensaje = "Perfil actualizado con éxito.";
            $tipo_mensaje = "success";
        } else {
            $mensaje = "Error al actualizar. Quizás el nombre ya existe.";
            $tipo_mensaje = "error";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>

<body>
    <div class="profile-container">
        <h2 style="text-align: center; margin-bottom: 25px;">Editar Perfil</h2>

        <?php if ($mensaje): ?>
            <div class="alert <?php echo $tipo_mensaje; ?>">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label>Nombre de Usuario</label>
                <div style="position: relative;">
                    <i class="fa-solid fa-user" style="position: absolute; left: 10px; top: 13px; color: #aaa;"></i>
                    <input type="text" name="username" value="<?php echo htmlspecialchars($_SESSION['user']); ?>"
                        style="padding-left: 35px;" required>
                </div>
            </div>

            <div class="form-group">
                <label>Nueva Contraseña</label>
                <div style="position: relative;">
                    <i class="fa-solid fa-lock" style="position: absolute; left: 10px; top: 13px; color: #aaa;"></i>
                    <input type="password" name="password" placeholder="Ingresa nueva contraseña"
                        style="padding-left: 35px;" required>
                </div>
            </div>

            <button type="submit" class="btn-update">Actualizar Perfil</button>
        </form>

        <a href="<?php echo ($_SESSION['rol'] === 'A') ? 'dashboard_admin.php' : 'dashboard_user.php'; ?>"
            class="back-link">
            <i class="fa-solid fa-arrow-left"></i> Volver al Dashboard
        </a>
    </div>
</body>

</html>