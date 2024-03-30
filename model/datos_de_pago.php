<?php
//Datos de pago

include("../controller/conectar_bd.php");

session_start();

// Comprueba si hay un mensaje,lo muestra y lo borra
$mensaje_error = '';
if (isset($_SESSION['message'])) {
    $mensaje_error = $_SESSION['message'];
    unset($_SESSION['message']);
}

// Comprueba si hay datos de envio
if (
    !empty($_POST['pedido_dni']) && !empty($_POST['pedido_nombre']) &&
    !empty($_POST['pedido_apellidos']) && !empty($_POST['pedido_direccion']) &&
    !empty($_POST['pedido_localidad']) && !empty($_POST['pedido_provincia']) &&
    !empty($_POST['pedido_pais'])

) {
    // Obtiene las variables de los datos pasados en POST
    $pedido_dni = htmlspecialchars($_POST['pedido_dni']);
    $pedido_nombre = htmlspecialchars($_POST['pedido_nombre']);
    $pedido_apellidos = htmlspecialchars($_POST['pedido_apellidos']);
    $pedido_direccion = htmlspecialchars($_POST['pedido_direccion']);
    $pedido_localidad = htmlspecialchars($_POST['pedido_localidad']);
    $pedido_provincia = htmlspecialchars($_POST['pedido_provincia']);
    $pedido_pais = htmlspecialchars($_POST['pedido_pais']);

    // Validaciones
    $campos = array();


    if ($pedido_dni == "" || !preg_match("/^[0-9]{8}[A-Za-z]$/", $pedido_dni)) {
        array_push($campos, $_SESSION['message'] = '<p class="h3 text-center">Introduzca un DNI válido</p>');
        header('location: /view/form_de_envio.php');
        exit;
    } else {
        $numeros = substr($pedido_dni, 0, -1);
        $letra = strtoupper(substr($pedido_dni, -1));
        $letras_validas = "TRWAGMYFPDXBNJZSQVHLCKE";
        $letra_calculada = $letras_validas[$numeros % 23];

        if ($letra != $letra_calculada) {
            array_push($campos, $_SESSION['message'] = '<p class="h3 text-center">La letra del DNI no es válida</p>');
            header('location: /view/form_de_envio.php');
            exit;
        }
    }

    if ($pedido_nombre == "") {
        array_push($campos, $_SESSION['message'] = '<p class="h3 text-center">Introduzca un nombre.</p>');
        header('location: /view/form_de_envio.php');
        exit;
    }

    if ($pedido_apellidos == "") {
        array_push($campos, $_SESSION['message'] = '<p class="h3 text-center">Introduzca los apellidos.</p>');
        header('location: /view/form_de_envio.php');
        exit;
    }

    if ($pedido_direccion == "") {
        array_push($campos, $_SESSION['message'] = '<p class="h3 text-center">Introduce una dirección.</p>');
        header('location: /view/form_de_envio.php');
        exit;
    }

    if ($pedido_localidad == "") {
        array_push($campos, $_SESSION['message'] = '<p class="h3 text-center">Introduce una localidad.</p>');
        header('location: /view/form_de_envio.php');
        exit;
    }

    if ($pedido_provincia == "") {
        array_push($campos, $_SESSION['message'] = '<p class="h3 text-center">Introduce una provincia.</p>');
        header('location: /view/form_de_envio.php');
        exit;
    }

    if ($pedido_pais == "") {
        array_push($campos, $_SESSION['message'] = '<p class="h3 text-center">Selecciona un país de origen.</p>');
        header('location: /view/form_de_envio.php');
        exit;
    }

    if (count($campos) > 0) {
        echo "<div class='error'>";
        for ($i = 0; $i < count($campos); $i++) {
            echo "<li>" . $campos[$i] . "</li>";
        }
    }

    // Obtiene datos de la cuenta del cliente o del invitado
    if (isset($_SESSION['dni'])) {
        $dnicuenta = $_SESSION['dni'];

        try {
            $stmt = $con->prepare('SELECT * FROM usuarios WHERE dni = ?');
            $stmt->execute([$dnicuenta]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            $nombre = $user['nombre'];
            $usuario = $user['usuario'];
            $apellidos = $user['apellidos'];
            $direccion = $user['direccion'];
            $localidad = $user['localidad'];
            $provincia = $user['provincia'];
            $pais = $user['pais'];
            $sexo = $user['sexo'];
            $telefono = $user['telefono'];
            $email = $user['email'];
            $rol = $user['rol'];
            $activo = $user['activo'];
        } catch (PDOException $e) {
            exit('Error al conectar con la base de datos: ' . $e->getMessage());
        }
    } else {

        $dnicuenta = "00000000A";
        $nombre = $pedido_nombre;
        $usuario = "";
        $apellidos =  $pedido_apellidos;
        $direccion = $pedido_direccion;
        $localidad = $pedido_localidad;
        $provincia = $pedido_provincia;
        $pais = $pedido_pais;
        $sexo = "";
        $telefono = "";
        $email = "";
    }

    // Obtiene datos del pedido

    $productos_en_carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : array();
    $productos = array();
    $subtotal = 0.00;

    if ($productos_en_carrito) {
        $array_to_question_marks = implode(',', array_fill(0, count($productos_en_carrito), '?'));
        $stmt = $con->prepare('SELECT * FROM productos WHERE producto_id IN (' . $array_to_question_marks . ')');
        $stmt->execute(array_keys($productos_en_carrito));
        $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($productos as $producto) {
            $subtotal += (float)$producto['precio'] * (int)$productos_en_carrito[$producto['producto_id']];
        }
    }
}
