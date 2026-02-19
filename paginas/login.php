<?php
session_start();
include('../funciones/funciones_bd.php');
$pdo = connect_bd();
if (isset($_POST['token'])) {
    if (isset($pdo)) {
        $user = trim($_POST['username']);
        $pass = trim($_POST['password']);


        $sql = "SELECT user, password, rol, mail FROM usuarios WHERE user = :usuario";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':usuario', $user);
        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);



        if ($usuario && password_verify($pass, $usuario['password'])) {
            $_SESSION['user'] = $usuario['user'];
            $_SESSION['rol'] = $usuario['rol'];
            $_SESSION['mail'] = $usuario['mail'];

            if ($usuario['rol'] === 'A') {
                header('Location: ./dashboard_admin.php');
            } else {
                header('Location: ./dashboard_user.php');
            }
            exit();
        } else {
            $_SESSION['error'] = 'Usuario o contraseña incorrectos';
            header('Location: ../index.php');
            exit();
        }
    } else {
        $_SESSION['error'] = 'Error de conexión a la base de datos';
        header('Location: ../index.php');
        exit();
    }
} else {
    $_SESSION['error'] = 'Acceso no autorizado';
    header('Location: ../index.php');
    exit();
}
