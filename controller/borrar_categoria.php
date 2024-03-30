<?php
// Borrar categoria despues del mensaje de confirmacion

include("../controller/conectar_bd.php");
session_start();

// Comprueba el codigo a borrar

if (isset($_POST['codigo'])) {
    $codigo = htmlspecialchars($_POST['codigo']);

    // Primero, obtengo el nombre del categoria antes de eliminarlo
    $stmt = $con->prepare("SELECT nombre FROM categorias WHERE codigo = :codigo");
    $stmt->execute([':codigo' => $codigo]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$row) {
        echo "No se encontró un categoria con el codigo proporcionado";
        exit;
    }
    $nombreCategoria = $row['nombre'];

    //Desactivar categoria
    if (isset($_POST['desactivar'])) {

        $stmt = $con->prepare("UPDATE categorias SET activo = :activo WHERE codigo = :codigo");
        $activo = 0;
        if ($stmt->execute([':activo' => $activo, ':codigo' => $codigo])) {

            // Guarda el mensaje en una variable de sesión
            $_SESSION['message'] = '<p class="h3 text-center"> La categoria ' . $nombreCategoria . ' se ha desactivado correctamente! <p>';
            header("Location: /view/gestion_categorias.php");
            exit;
        } else {
            $_SESSION['message'] = '<p class="h3 text-center">Error al eliminar categoria.</p>';
            header("Location: /view/gestion_categorias.php");
            exit();
        }
    }
} else {
    $_SESSION['message'] = '<p class="h3 text-center">Método de solicitud no válido.</p>';
    header("Location: /view/gestion_categorias.php");
    exit();
}
?>
