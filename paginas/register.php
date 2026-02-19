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
</head>

<body>
    <form method="POST">
        <input type="text" name="name" placeholder="Nombre" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit">Registrarse</button>
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        insert_user_bd($pdo);
    }
    ?>
</body>

</html>