<?php
function insert_user_bd($pdo)
{
    try {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $rol = "R";
        $sql = "INSERT INTO usuarios (user, password, rol, mail) VALUES(:user, :password, :rol, :mail)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user', $name);
        $stmt->bindParam(':mail', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':rol', $rol);
        $stmt->execute();
        header('Location: ../index.php');
        exit();
    } catch (PDOException $excepcion) {
        echo "Error en el registro" . $excepcion->getMessage();
    }
}

function listar_db($pdo)
{
    try {
        $sql = "SELECT * FROM proveedores";
        $lista = $pdo->query($sql);
        echo "<h4>Lista de contactos</h4>";
        while ($contacto = $lista->fetch()) {
            echo "Nombre: " . $contacto['nombre'] . "<br>";
            echo " Email: " . $contacto['mail'] . "<br>";
            echo " Teléfono: " . $contacto['telefono'] . "<br>";
        }
    } catch (PDOException $excepcion) {
        echo "Error en la consulta de tipo " . $excepcion->getMessage();
    }
}


function update_db($pdo)
{
    try {
        $sql = "UPDATE proveedor SET emailContacto='maybe@gmail.com' WHERE
emailContacto='jose@gmail.com'";
        $filasModificadas = $pdo->exec($sql);
        echo "Se han modificado $filasModificadas filas<br/>";
    } catch (PDOException $excepcion) {
        echo "Error en la modificación de tipo " . $excepcion->getMessage();
    }
}

function delete_db($pdo)
{
    try {
        $sql = "DELETE FROM agenda WHERE nombreContacto='Lucas'";
        $filasBorradas = $pdo->exec($sql);
        echo "Se han borrado $filasBorradas filas<br/>";
    } catch (PDOException $excepcion) {
        echo "Error en el borrado de tipo " . $excepcion->getMessage();
    }
}
?>