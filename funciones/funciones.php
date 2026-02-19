<?php
function insert_user_bd($pdo)
{
    try {
        $filasInsertadas = $pdo->exec("INSERT INTO usuarios VALUES(NULL,'Juan', 'mail.com', '555', 'test')");
        echo "Se ha añadido $filasInsertadas filas <br />";
    } catch (PDOException $excepcion) {
        echo "Error" . $excepcion->getMessage();
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