<?php
// Procesar el pedido y guardarlo en la base de datos

include("conectar_bd.php");
session_start();

if (
    empty($_SESSION['carrito']) || empty($_POST['pedido_dni']) ||
    empty($_POST['pedido_nombre']) ||  empty($_POST['pedido_apellidos'])  ||
    empty($_POST['pedido_direccion']) || empty($_POST['pedido_localidad']) ||
    empty($_POST['pedido_provincia']) || empty($_POST['pedido_pais']) ||
    empty($_POST['metodo_de_pago']) || empty($_POST['dnicuenta'])

) {
    $_SESSION['message'] = '<p class="h3 text-center"> Ha habido un error.</p>';
    header('Location: /view/datos_de_pago.php');
    exit;
}

// Obtiene las variables de los datos pasados en POST
$numpedido = date('YmdHis');
$dnicuenta = htmlspecialchars($_POST['dnicuenta']);
$dnienvio = htmlspecialchars($_POST['pedido_dni']);
$nombre = htmlspecialchars($_POST['pedido_nombre']);
$apellidos = htmlspecialchars($_POST['pedido_apellidos']);
$direccion = htmlspecialchars($_POST['pedido_direccion']);
$localidad = htmlspecialchars($_POST['pedido_localidad']);
$provincia = htmlspecialchars($_POST['pedido_provincia']);
$pais = htmlspecialchars($_POST['pedido_pais']);
$metodo_de_pago = htmlspecialchars($_POST['metodo_de_pago']);

// Estado del pedido dependiendo del método de pago
if (($metodo_de_pago == 1) || ($metodo_de_pago == 2) || ($metodo_de_pago == 3) || ($metodo_de_pago == 4)) {
    $estado = 3;
} else {
    $estado = 2;
}

// Obtiene los datos del carrito
$productos_en_carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : array();
$productos = array();
$subtotal = 0.00;

if ($productos_en_carrito) {
    $array_to_question_marks = implode(',', array_fill(0, count($productos_en_carrito), '?'));
    $stmt = $con->prepare('SELECT * FROM productos WHERE producto_id IN (' . $array_to_question_marks . ')');
    $stmt->execute(array_keys($productos_en_carrito));
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($productos as $producto) {
        $cantidad = $productos_en_carrito[$producto['producto_id']];
        $subtotal += (float)$producto['precio'] * (int)$cantidad;
        $producto_id = $producto['producto_id'];
        $precio_total = $subtotal;
    }
}

// Introduce los valores en la base de datos
$stmt = $con->prepare("INSERT INTO pedidos VALUES (:numpedido, :dnicuenta, :dni, :nombre, :apellidos, :direccion, :localidad, :provincia, :pais, :producto_id, :cantidad, :precio_total, :metodo_de_pago, :estado)");
$stmt->bindParam(':numpedido', $numpedido);
$stmt->bindParam(':dnicuenta', $dnicuenta);
$stmt->bindParam(':dni', $dnienvio);
$stmt->bindParam(':nombre', $nombre);
$stmt->bindParam(':apellidos', $apellidos);
$stmt->bindParam(':direccion', $direccion);
$stmt->bindParam(':localidad', $localidad);
$stmt->bindParam(':provincia', $provincia);
$stmt->bindParam(':pais', $pais);
$stmt->bindParam(':producto_id', $producto_id);
$stmt->bindParam(':cantidad', $cantidad);
$stmt->bindParam(':precio_total', $precio_total);
$stmt->bindParam(':metodo_de_pago', $metodo_de_pago);
$stmt->bindParam(':estado', $estado);
$stmt->execute();

// Comprueba si no hay errores
$error = $stmt->errorInfo();
if (!empty($error[2])) {
    $_SESSION['message'] = '<p class="h3 text-center"> Ha habido un error {$error[2]}  </p>';
    header('Location: /view/datos_de_pago.php');
    exit;
} else {
    $_SESSION['carrito'] = null;
    header("location: /view/pedido_completado.php");
    exit;
}
?>