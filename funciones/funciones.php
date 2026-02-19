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




/**
 * R6: Función para obtener todos los productos.
 * Utiliza PDO para realizar una consulta segura.
 */
function obtener_productos($pdo)
{
    try {
        // Preparamos la consulta SQL para seleccionar todos los productos
        $sql = "SELECT * FROM productos";
        $stmt = $pdo->query($sql);
        // Devolvemos el resultado como un array asociativo
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error al obtener productos: " . $e->getMessage();
        return [];
    }
}

/**
 * R6A: Función para obtener un producto específico por su ID.
 * Utiliza sentencias preparadas para mayor seguridad.
 */
function obtener_producto_por_id($pdo, $id)
{
    try {
        $sql = "SELECT * FROM productos WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error al obtener el producto: " . $e->getMessage();
        return null;
    }
}

/**
 * R3: Función para insertar un nuevo producto en la base de datos.
 * Solo accesible por administradores (controlado en el frontend/lógica de página).
 */
function crear_producto($pdo, $nombre, $descripcion, $precio, $stock)
{
    try {
        // Asumimos categoria_id y proveedor_id = 1 por defecto para cumplir con la FK si existe
        $sql = "INSERT INTO productos (nombre, descripcion, precio, stock, categoria_id, proveedor_id) 
                VALUES (:nombre, :descripcion, :precio, :stock, 1, 1)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':nombre', $nombre);
        $stmt->bindValue(':descripcion', $descripcion);
        $stmt->bindValue(':precio', $precio);
        $stmt->bindValue(':stock', $stock);
        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        echo "Error al crear producto: " . $e->getMessage();
        return false;
    }
}

/**
 * R4: Función para modificar un producto existente.
 */
function actualizar_producto($pdo, $id, $nombre, $descripcion, $precio, $stock)
{
    try {
        $sql = "UPDATE productos SET nombre = :nombre, descripcion = :descripcion, precio = :precio, stock = :stock 
                WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':nombre', $nombre);
        $stmt->bindValue(':descripcion', $descripcion);
        $stmt->bindValue(':precio', $precio);
        $stmt->bindValue(':stock', $stock);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        echo "Error al actualizar producto: " . $e->getMessage();
        return false;
    }
}

/**
 * R5: Función para borrar un producto.
 */
function borrar_producto($pdo, $id)
{
    try {
        $sql = "DELETE FROM productos WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        echo "Error al borrar producto: " . $e->getMessage();
        return false;
    }
}

/**
 * R2: Función para modificar el perfil del usuario (nombre y contraseña).
 * Devuelve true si la actualización fue exitosa.
 */
function actualizar_perfil($pdo, $usuario_actual, $nuevo_usuario, $nueva_password)
{
    try {
        // Hasheamos la nueva contraseña
        $password_hash = password_hash($nueva_password, PASSWORD_DEFAULT);

        $sql = "UPDATE usuarios SET user = :nuevo_usuario, password = :password WHERE user = :usuario_actual";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':nuevo_usuario', $nuevo_usuario);
        $stmt->bindValue(':password', $password_hash);
        $stmt->bindValue(':usuario_actual', $usuario_actual);
        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        echo "Error al actualizar perfil: " . $e->getMessage();
        return false;
    }
}
?>