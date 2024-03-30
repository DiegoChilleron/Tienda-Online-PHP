
<?php
// Borrar usuario despues del mensaje de confirmacion
include("../controller/conectar_bd.php");
session_start();

// Comprueba el DNI a borrar
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['dni'])) {
        $dni = htmlspecialchars($_POST['dni']);

        // Comprueba que no se borre a si mismo
        if ($_SESSION['rol'] == 1 && $_POST['dni'] == $_SESSION['dni']) {
            $_SESSION['message'] = '<p class="h3 text-center"> El usuario ' . $nombreUsuario . ' no puede borrarse a si mismo! <p>';
            header("Location: /view/gestion_usuarios.php");
            exit;
        }

        // Primero, obtengo el nombre del usuario antes de eliminarlo
        $stmt = $con->prepare("SELECT nombre FROM usuarios WHERE dni = :dni");
        $stmt->execute([':dni' => $dni]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            echo "No se encontró un usuario con el DNI proporcionado";
            exit;
        }
        $nombreUsuario = $row['nombre'];

        //Desactivar usuario
        if (isset($_POST['desactivar'])) {

            $stmt = $con->prepare("UPDATE usuarios SET activo = :activo WHERE dni = :dni");
            $activo = 0;
            if ($stmt->execute([':activo' => $activo, ':dni' => $dni])) {

                // Guarda el mensaje en una variable de sesión
                $_SESSION['message'] = '<p class="h3 text-center"> El usuario ' . $nombreUsuario . ' se ha desactivado correctamente! <p>';
                header('Location: logout.php ');
                exit;
            } else {
                $_SESSION['message'] = '<p class="h3 text-center">Error al eliminar al usuario.</p>';
                header("Location: /view/panel_administrador.php");
                exit();
            }
        }

        // Borrar usuario
        if (isset($_POST['borrar']) && $_SESSION['rol'] === 1) {

            // Primero, compruebo que no tiene pedidos hechos
            $stmt = $con->prepare("SELECT dnicuenta FROM pedidos WHERE dnicuenta = :dnicuenta");
            $stmt->execute([':dnicuenta' => $dni]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                $_SESSION['message'] = '<p class="h3 text-center"> El usuario ' . $nombreUsuario . ' tiene un pedido hecho, no se puede eliminar! <p>';
                header('Location: /view/panel_administrador.php ');
                exit;
            }

            // Eliminamos al usuario
            $stmt = $con->prepare("DELETE FROM usuarios WHERE dni = :dni");
            if ($stmt->execute([':dni' => $dni])) {
                $_SESSION['message'] = '<p class="h3 text-center"> El usuario ' . $nombreUsuario . ' se ha eliminado correctamente! <p>';
                header('Location: /view/panel_administrador.php ');
                exit;
            } else {
                $_SESSION['message'] = '<p class="h3 text-center">Error al eliminar al usuario.</p>';
                header("Location: /view/panel_administrador.php");
                exit();
            }
        }
    } else {
        $_SESSION['message'] = '<p class="h3 text-center">Método de solicitud no válido.</p>';
        header("Location: /view/panel_administrador.php");
        exit();
    }
}
?>
