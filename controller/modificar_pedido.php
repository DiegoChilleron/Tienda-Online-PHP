<?php
// Editar un pedido despues del "formulario de editar pedido"

include("conectar_bd.php");
session_start();

// Comprobación que ningún campo esté vacío y que todos los campos existan.
if (
    empty($_POST['numpedido']) || empty($_POST['dnicuenta'])
    || empty($_POST['dni']) || empty($_POST['nombre'])
    || empty($_POST['apellidos']) || empty($_POST['direccion'])
    || empty($_POST['localidad']) || empty($_POST['provincia'])
    || empty($_POST['pais']) || empty($_POST['producto_id'])
    || empty($_POST['cantidad']) || empty($_POST['precio_total'])
    || empty($_POST['metodo_de_pago']) || empty($_POST['estado'])

) {
    $_SESSION['message'] = '<p class="h3 text-center">Rellene todos los campos, por favor.</p>';
    header('Location: /view/form_editar_pedido.php');
    exit;
}

// Crea las variables de los datos pasados en POST
$numpedido = htmlspecialchars($_POST['numpedido']);
$dnicuenta = htmlspecialchars($_POST['dnicuenta']);
$dni = htmlspecialchars($_POST['dni']);
$nombre = htmlspecialchars($_POST['nombre']);
$apellidos = htmlspecialchars($_POST['apellidos']);
$direccion = htmlspecialchars($_POST['direccion']);
$localidad = htmlspecialchars($_POST['localidad']);
$provincia = htmlspecialchars($_POST['provincia']);
$pais = htmlspecialchars($_POST['pais']);
$producto_id = htmlspecialchars($_POST['producto_id']);
$cantidad = htmlspecialchars($_POST['cantidad']);
$precio_total = htmlspecialchars($_POST['precio_total']);
$metodo_de_pago = htmlspecialchars($_POST['metodo_de_pago']);
$estado = htmlspecialchars($_POST['estado']);

// Validaciones
$campos = array();

if ($dnicuenta == "" || !preg_match("/^[0-9]{8}[A-Za-z]$/", $dnicuenta)) {
    array_push($campos, $_SESSION['message'] = '<p class="h3 text-center">Introduzca un DNI válido</p>');
    header('location: /view/form_editar_pedido.php');
    exit;
} else {
    $numeros = substr($dnicuenta, 0, -1);
    $letra = strtoupper(substr($dnicuenta, -1));
    $letras_validas = "TRWAGMYFPDXBNJZSQVHLCKE";
    $letra_calculada = $letras_validas[$numeros % 23];

    if ($letra != $letra_calculada) {
        array_push($campos, $_SESSION['message'] = '<p class="h3 text-center">La letra del DNI no es válida</p>');
        header('location: /view/form_editar_pedido.php');
        exit;
    }
}

if ($dni == "" || !preg_match("/^[0-9]{8}[A-Za-z]$/", $dni)) {
    array_push($campos, $_SESSION['message'] = '<p class="h3 text-center">Introduzca un DNI válido</p>');
    header('location: /view/form_editar_pedido.php');
    exit;
}
if ($nombre == "") {
    array_push($campos, $_SESSION['message'] = '<p class="h3 text-center">Introduzca un nombre.</p>');
    header('location: /view/form_editar_pedido.php');
    exit;
}

if ($apellidos == "") {
    array_push($campos, $_SESSION['message'] = '<p class="h3 text-center">Introduzca un apellido.</p>');
    header('location: /view/form_editar_pedido.php');
    exit;
}
if ($localidad == "") {
    array_push($campos, $_SESSION['message'] = '<p class="h3 text-center">Introduzca una localidad.</p>');
    header('location: /view/form_editar_pedido.php');
    exit;
}

if ($provincia == "") {
    array_push($campos, $_SESSION['message'] = '<p class="h3 text-center">Introduzca una provincia.</p>');
    header('location: /view/form_editar_pedido.php');
    exit;
}

if ($cantidad == "") {
    array_push($campos, $_SESSION['message'] = '<p class="h3 text-center">Introduzca una cantidad.</p>');
    header('location: /view/form_editar_pedido.php');
    exit;
}

if ($precio_total == "") {
    array_push($campos, $_SESSION['message'] = '<p class="h3 text-center">Introduzca un precio total.</p>');
    header('location: /view/form_editar_pedido.php');
    exit;
}

if ($metodo_de_pago == "") {
    array_push($campos, $_SESSION['message'] = '<p class="h3 text-center">Introduzca el método de pago.</p>');
    header('location: /view/form_editar_pedido.php');
    exit;
}

if ($estado == "") {
    array_push($campos, $_SESSION['message'] = '<p class="h3 text-center">Introduzca un estado.</p>');
    header('location: /view/form_editar_pedido.php');
    exit;
}

if (count($campos) > 0) {
    echo "<div class='error'>";
    for ($i = 0; $i < count($campos); $i++) {
        echo "<li>" . $campos[$i] . "</li>";
    }
    echo "</div>";
} else {
    echo "<div class='correcto'>Datos correctos</div>";
}

// Actualiza el pedido en la base de datos
$stmt = $con->prepare("UPDATE pedidos SET numpedido = :numpedido, dnicuenta = :dnicuenta, dni = :dni, nombre = :nombre, apellidos = :apellidos, direccion = :direccion, localidad = :localidad, provincia = :provincia, pais = :pais, producto_id = :producto_id, cantidad = :cantidad, precio_total = :precio_total, metodo_de_pago = :metodo_de_pago, estado = :estado WHERE numpedido = :numpedido");
$stmt->bindParam(':numpedido', $numpedido);
$stmt->bindParam(':dnicuenta', $dnicuenta);
$stmt->bindParam(':dni', $dni);
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
    header('Location: /view/form_editar_pedido.php');
    exit;
} else {
    $_SESSION['message'] = "<p> Pedido modificado correctamente! </p>";
    header('location: /view/gestion_pedidos.php');
    exit;
}

?>