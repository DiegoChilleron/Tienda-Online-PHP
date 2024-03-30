<?php
include("../controller/conectar_bd.php");
include("../controller/sesiones.php");
minEmpleado();

$title = "Borrar Categoria";
include("header.php");

// Obtien el codigo con el metodo GET a borrar
if (isset($_GET['id'])) {
    $cat_codigo = $_GET['id'];

    // Primero, obtengo el nombre de la categoria antes de eliminarla
    $stmt = $con->prepare("SELECT codigo, nombre FROM categorias WHERE codigo = :codigo");
    $stmt->execute([':codigo' => $cat_codigo]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $id_categoria = $row['codigo'];
    }
}

?>

<body class="container-fluid">
    <?php
    if (isset($row)) {
        echo '<form method="post" class="m-5" action="/controller/borrar_categoria.php">';
        echo '<p class="h1 pb-2">¿Estás seguro de que quieres desactivar la categoría ' . $row['nombre'] . '?</p>';
        echo '<input type="hidden" name="codigo" value="' . $row['codigo'] . '">';
        echo '<input disabled name="codigo" value="' . $row['codigo'] . '"><br>';
        echo '<input disabled name="nombre" value="' . $row['nombre'] . '"><br>';
        echo '<input type="submit" class="btn btn-danger m-2 mt-4 rounded-0" name="desactivar" value="Desactivar categoría">';
        
        echo '<input type="button" class="btn btn-primary m-2 mt-4 rounded-0" value="No. Volver" onclick="goBack()">';
        echo '</form>';
    } else {
        echo '<p class ="h1 text-center h-25 pt-5");">Error, no se proporcionó el código de la categoría</p>';
        echo '<a href="panel_administrador.php"><input type="button" class="btn btn-color-primary m-5" value="Volver al Panel"></a>';
    }

    include("footer.php");
    ?>
</body>

</html>