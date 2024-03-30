<?php
//Modificar usuario - Introduccion y validacion de los datos del usuario en el formulario de modificacion

include("../controller/conectar_bd.php");
include("../controller/sesiones.php");
minEmpleado();

if (isset($_REQUEST['id'])) {
    $numpedido_a_consultar = $_REQUEST['id'];

    try {
        $stmt = $con->prepare('SELECT * FROM pedidos WHERE numpedido = ?');
        $stmt->execute([$numpedido_a_consultar]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $numpedido = $user['numpedido'];
        $dnicuenta = $user['dnicuenta'];
        $dni = $user['dni'];
        $nombre = $user['nombre'];
        $apellidos = $user['apellidos'];
        $direccion = $user['direccion'];
        $localidad = $user['localidad'];
        $provincia = $user['provincia'];
        $pais = $user['pais'];
        $producto_id = $user['producto_id'];
        $cantidad = $user['cantidad'];
        $precio_total = $user['precio_total'];
        $metodo_de_pago = $user['metodo_de_pago'];
        $estado = $user['estado'];
    } catch (PDOException $e) {
        exit('Error al conectar con la base de datos: ' . $e->getMessage());
    }

} else {
    echo '<p class="h3 text-center">No se encontró el pedido. </p>';
}
