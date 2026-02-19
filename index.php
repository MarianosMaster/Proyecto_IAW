<?php
include('funciones/funciones_bd.php');
session_start();
$_SESSION['token'] = bin2hex(random_bytes(32));
$pdo = connect_bd();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Placeholder</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <header class="main-header">
        <div class="header-content">
            <div class="logo">Proyecto IAW</div>
            <nav>
                <ul>
                    <li><a href="#">Inicio</a></li>
                    <li><a href="#">Documentación</a></li>
                    <li><a href="#">Contacto</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="login-container">
            <h1>Iniciar Sesión</h1>
            <?php if (isset($_SESSION['error'])): ?>
                <div class="error-message">
                    <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php endif; ?>
            <form action="./paginas/login.php" method="POST">
                <input type="text" name="username" placeholder="Usuario" required>
                <input type="password" name="password" placeholder="Contraseña" required>
                <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">

                <button type="submit" class="btn btn-primary">
                    Entrar
                </button>
            </form>




            <h4 style="margin-bottom: 0;">No tienes una cuenta?</h4>

            <a href="./paginas/register.php" class="btn btn-secondary">
                Regístrate
            </a>


            <?php if (isset($pdo)): ?>
                <div class="status">
                    ✓ Conectado a la base de datos
                </div>
            <?php endif; ?>
        </div>
    </main>
</body>

</html>