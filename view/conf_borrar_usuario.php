<?php
include("../controller/conectar_bd.php");
include('../controller/sesiones.php');
minUsuario();

$title = "Borrar Usuario";
include("header.php");

// Obtien el DNI con el metodo GET a borrar
if (isset($_GET['id'])) {
    $dni = $_GET['id'];

    // Primero, obtengo el nombre del usuario antes de eliminarlo
    $stmt = $con->prepare("SELECT nombre, dni FROM usuarios WHERE dni = :dni");
    $stmt->execute([':dni' => $dni]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $nombreUsuario = $row['nombre'];
        $dniUsuario = $row['dni'];
    }
}

?>

<body class="container-fluid">
    <?php
    if (isset($row)) {
        echo '<form method="post" class="m-5" action="/controller/borrar_usuario.php">';
        echo '<p class="h1 pb-2">¿Estás seguro de que quieres desactivar al usuario ' . $nombreUsuario . '?</p>';
        echo '<input type="hidden" name="dni" value="' . $dniUsuario . '">';
        echo '<input disabled name="nombre" value="' . $nombreUsuario . '"><br>';
        echo '<input disabled name="nombre" value="' . $dniUsuario . '"><br>';
        echo '<input type="submit" class="btn btn-danger m-2 mt-4 rounded-0" name="desactivar" value="Desactivar usuario">';
        if ($_SESSION['rol'] === 1) {
            echo '<input type="submit" class="btn btn-danger m-2 mt-4 rounded-0" name="borrar" value="Eliminar usuario">';
        }
        echo '<input type="button" class="btn btn-primary m-2 mt-4 rounded-0" value="No. Volver" onclick="goBack()">';
        echo '</form>';
    } else {
        echo '<p class ="h1 text-center h-25 pt-5");">Error, no se proporcionó el DNI del usuario</p>';
        echo '<a href="panel_administrador.php"><input type="button" class="btn btn-color-primary m-5" value="Volver al panel de administrador"></a>';
    }

    include("footer.php");
    ?>
</body>

</html>