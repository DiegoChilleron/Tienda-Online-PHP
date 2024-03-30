<?php
include("../controller/conectar_bd.php");
include("../controller/sesiones.php");
minEmpleado();
$title = "Borrar Producto";
include("header.php");

// Obtien el prodcto_id con el metodo GET a borrar
if (isset($_GET['id'])) {
    $numpedido = $_GET['id'];

    // Primero, obtengo los datos del pedido antes de eliminarlo
    $stmt = $con->prepare("SELECT numpedido, dnicuenta FROM pedidos WHERE numpedido = :numpedido");
    $stmt->execute([':numpedido' => $numpedido]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $pedido = $row['numpedido'];
    }
}

?>

<body class="container-fluid">
    <?php
    if (isset($row)) {
        echo '<form method="post" class="m-5" action="/controller/borrar_pedido.php">';
        echo '<p class="h1">¿Estás seguro de que quieres eliminar el pedido?</p>';
        echo '<input type="hidden" name="numpedido" value="' . $row['numpedido'] . '">';
        echo '<input disabled name="numpedido" value="' . $row['numpedido'] . '"><br><br>';
        echo '<input disabled name="dnicuenta" value="' . $row['dnicuenta'] . '"><br>';
        echo '<input type="submit" class="btn btn-danger m-2 mt-4 rounded-0" name="eliminar" value="Sí, quiero eliminar">';
        echo '<a href="panel_administrador.php"><input type="button" class="btn btn-primary m-2 mt-4 rounded-0" value="No. Volver al panel de administrador"></a>';
        echo '</form>';
    } else {
        echo '<p class ="h1 text-center h-25 pt-5");">Error, no se proporcionó el ID del pedido</p>';
        echo '<a href="panel_administrador.php"><input type="button" class="btn btn-color-primary m-5" value="Volver al panel de administrador"></a>';
    }

    include("footer.php");
    ?>
</body>

</html>