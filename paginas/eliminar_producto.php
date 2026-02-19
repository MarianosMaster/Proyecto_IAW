<?php
session_start();
include('../funciones/funciones_bd.php');
include('../funciones/funciones.php');

if (!isset($_SESSION['user']) || $_SESSION['rol'] !== 'A') {
    die("Acceso denegado");
}

if (isset($_GET['id'])) {
    $pdo = connect_bd();
    borrar_producto($pdo, $_GET['id']);
}

header('Location: dashboard_admin.php');
exit();
?>