<?php

/**
 * Registra un nuevo usuario en la base de datos a partir de un formulario POST.
 * Tras hacerlo, redirige al índice.
 *
 * @param PDO $pdo Instancia de la conexión a la base de datos.
 * @return void No devuelve valor, realiza una redirección de cabecera.
 */
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
 * Obtiene la lista completa de todos los productos.
 *
 * @param PDO $pdo Instancia de la conexión a la base de datos.
 * @return array Lista de productos como array asociativo.
 */
function obtener_productos($pdo)
{
    try {
        $sql = "SELECT * FROM productos";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error al obtener productos: " . $e->getMessage();
        return [];
    }
}

/**
 * Busca productos cuyo nombre coincida de forma dinámica, es decir, que contenga alguna letra o conjunto de letras.
 *
 * @param PDO    $pdo    Instancia de la conexión a la base de datos.
 * @param string $nombre El término o nombre parcial a buscar.
 * @return array Conjunto de resultados que coinciden con la búsqueda.
 */
function buscar_producto_por_nombre($pdo, $nombre)
{
    try {
        $sql = "SELECT * FROM productos WHERE nombre LIKE :nombre";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':nombre', '%' . $nombre . '%');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error al buscar productos: " . $e->getMessage();
        return [];
    }
}


/**
 * Inserta un nuevo producto en el catálogo.
 *
 * @param PDO    $pdo         Instancia de la conexión a la base de datos.
 * @param string $nombre      Nombre del producto.
 * @param string $descripcion Detalles del producto.
 * @param float  $precio      Precio del producto.
 * @param int    $stock       Cantidad de unidades disponibles.
 * @return bool  True si se creó correctamente, false si falló.
 */

function crear_producto($pdo, $nombre, $descripcion, $precio, $stock)
{
    try {
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
 * Actualiza los datos de un producto existente.
 *
 * @param PDO    $pdo         Instancia de la conexión a la base de datos.
 * @param int    $id          ID del producto a modificar.
 * @param string $nombre      Nuevo nombre.
 * @param string $descripcion Nueva descripción.
 * @param float  $precio      Nuevo precio.
 * @param int    $stock       Nuevo stock.
 * @return bool  True si se actualizó con éxito, false en caso contrario.
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
 * Elimina permanentemente un producto de la base de datos.
 *
 * @param PDO $pdo Instancia de la conexión a la base de datos.
 * @param int $id  Identificador del producto.
 * @return bool True si el borrado fue exitoso, false si falló.
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
 * Actualiza el nombre de usuario y la contraseña en la base de datos.
 *
 * Esta función cifra la nueva contraseña y actualiza el registro correspondiente.
 *
 * @param PDO    $pdo             Instancia de la conexión a la base de datos.
 * @param string $usuario_actual  El nombre de usuario actual para identificar el registro.
 * @param string $nuevo_usuario   El nuevo nombre de usuario que se desea establecer.
 * @param string $nueva_password  La nueva contraseña (será cifrada).
 * @return bool Devuelve true si la actualización fue exitosa, false en caso de error.
 */
function actualizar_perfil($pdo, $usuario_actual, $nuevo_usuario, $nueva_password)
{
    try {
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