<!DOCTYPE html>
<?php
include('../funciones/funciones_bd.php');
include('../funciones/funciones.php');
session_start();
$pdo = connect_bd();
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <header class="main-header">
        <div class="header-content">
            <div class="logo">GeekVault</div>
            <nav>
                <ul>
                    <li><a href="../index.php">Inicio</a></li>
                    <li><a href="../paginas/contacto.php">Contacto</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main>
        <div class="register-container">
            <h1>Crea tu nueva cuenta</h1>

            <form method="POST">

                <div class="input-group">
                    <input type="text" name="name" placeholder=" " required>
                    <label>Usuario</label>
                    <i class="fa-solid fa-user"></i>
                </div>

                <div class="input-group">
                    <input type="email" name="email" placeholder=" " required>
                    <label>Email</label>
                    <i class="fa-solid fa-envelope"></i>
                </div>

                <div class="input-group">
                    <input type="password" name="password" placeholder=" " required>
                    <label>Contraseña</label>
                    <i class="fa-solid fa-lock"></i>
                </div>
                <div class="terms">
                    <input type="checkbox" name="terms" required>
                    <label>Acepto los términos y condiciones</label>
                </div>

                <button type="submit" class="btn-register">
                    Crear cuenta
                </button>

            </form>

            <div class="register-footer">
                Already have an account? <a href="../index.php">Login</a>
            </div>
        </div>
    </main>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        insert_user_bd($pdo);
    }
    ?>

</body>

</html>