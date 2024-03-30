<?php
// Borrar producto despues del mensaje de confirmacion
include("../controller/conectar_bd.php");
session_start();

// Comprueba el producto_id a borrar
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id'])) {
        $producto_id = htmlspecialchars($_POST['id']);

        // Primero, obtengo el nombre del producto antes de eliminarlo
        $stmt = $con->prepare("SELECT nombre FROM productos WHERE producto_id = :producto_id");
        $stmt->execute([':producto_id' => $producto_id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            echo "No se encontró el producto con el ID ' . $producto_id . '  proporcionado";
            exit;
        }
        $nombreProducto = $row['nombre'];

        // Eliminamos el producto
        $stmt = $con->prepare("DELETE FROM productos WHERE producto_id = :producto_id");
        if ($stmt->execute([':producto_id' => $producto_id])) {
            // Guarda el mensaje en una variable de sesión
            $_SESSION['message'] = '<p class="h3 text-center"> El producto ' . $nombreProducto . ' se ha eliminado correctamente! <p>';
            header("Location: /view/gestion_inventario.php");
            exit;
        } else {
            $_SESSION['message'] = '<p class="h3 text-center">Error al eliminar el producto.</p>';
            header("Location: /view/gestion_inventario.php");
            exit();
        }
    } else {
        $_SESSION['message'] = '<p class="h3 text-center">No se ha proporcionado un producto_id.</p>';
        header("Location: /view/gestion_inventario.php");
        exit();
    }
} else {
    $_SESSION['message'] = '<p class="h3 text-center">Método de solicitud no válido.</p>';
    header("Location: /view/gestion_inventario.php");
    exit();
}

?>