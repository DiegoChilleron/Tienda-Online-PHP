<?php
// Borrar producto despues del mensaje de confirmacion
include("../controller/conectar_bd.php");
session_start();

// Comprueba el producto_id a borrar
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['numpedido'])) {
        $numpedido = htmlspecialchars($_POST['numpedido']);

        // Primero, obtengo el nombre del producto antes de eliminarlo
        $stmt = $con->prepare("SELECT numpedido FROM pedidos WHERE numpedido = :numpedido");
        $stmt->execute([':numpedido' => $numpedido]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            echo "No se encontró el producto con el ID ' . $numpedido . '  proporcionado";
            exit;
        }
        $pedido = $row['numpedido'];

        // Eliminamos el pedido
        $stmt = $con->prepare("DELETE FROM pedidos WHERE numpedido = :numpedido");
        if ($stmt->execute([':numpedido' => $numpedido])) {
            // Guarda el mensaje en una variable de sesión
            $_SESSION['message'] = '<p class="h3 text-center"> El pedido ' . $numpedido . ' se ha eliminado correctamente! <p>';
            header('Location: /view/panel_administrador.php ');
            exit;
        } else {
            $_SESSION['message'] = '<p class="h3 text-center">Error al eliminar el pedido.</p>';
            header("Location: /view/panel_administrador.php");
            exit();
        }
    } else {
        $_SESSION['message'] = '<p class="h3 text-center">No se ha proporcionado un Número de pedido.</p>';
        header("Location: /view/panel_administrador.php");
        exit();
    }
} else {
    $_SESSION['message'] = '<p class="h3 text-center">Método de solicitud no válido.</p>';
    header("Location: /view/panel_administrador.php");
    exit();
}

?>