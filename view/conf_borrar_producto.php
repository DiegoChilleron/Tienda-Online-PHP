<?php
include("../controller/conectar_bd.php");
include("../controller/sesiones.php");
minEmpleado();

$title = "Borrar Producto";
include("header.php");

// Obtien el prodcto_id con el metodo GET a borrar
if (isset($_GET['id'])) {
    $producto_id = $_GET['id'];

    // Primero, obtengo el nombre del producto antes de eliminarlo
    $stmt = $con->prepare("SELECT producto_id, nombre FROM productos WHERE producto_id = :producto_id");
    $stmt->execute([':producto_id' => $producto_id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $id_producto = $row['producto_id'];
    }
}

?>

<body class="container-fluid">
    <?php
    if (isset($row)) {
        echo '<form method="post" class="m-5" action="/controller/borrar_producto.php">';
        echo '<p class="h1">¿Estás seguro de que quieres eliminar?</p>';
        echo '<input type="hidden" name="id" value="' . $row['producto_id'] . '">';
        echo '<input disabled name="nombre" value="' . $row['nombre'] . '"><br>';
        echo '<input type="submit" class="btn btn-danger m-2 mt-4 rounded-0" name="eliminar" value="Sí, quiero eliminar">';
        echo '<a href="panel_administrador.php"><input type="button" class="btn btn-primary m-2 mt-4 rounded-0" value="No. Volver al panel de administrador"></a>';
        echo '</form>';
    } else {
        echo '<p class ="h1 text-center h-25 pt-5");">Error, no se proporcionó el ID del producto</p>';
        echo '<a href="panel_administrador.php"><input type="button" class="btn btn-color-primary m-5" value="Volver al panel de administrador"></a>';
    }

    include("footer.php");
    ?>
</body>

</html>