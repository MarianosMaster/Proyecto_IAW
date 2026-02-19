<?php
function connect_bd()
{
    $host = 'localhost';
    $dbname = 'geekvault';
    $username = 'root';
    $password = '';
    
    try {
        $pdo = new PDO("mysql:host=" . $host . ";dbname=" . $dbname, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec('SET NAMES "utf8"');
        return $pdo; 
    } catch (PDOException $e) {
        echo "Error en la conexión: " . $e->getMessage();
        return null;
    }
}
?>

