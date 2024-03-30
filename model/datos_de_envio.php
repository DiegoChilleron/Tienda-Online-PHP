<?php
//Modificar usuario - Introduccion y validacion de los datos del usuario en el formulario de modificacion

include("../controller/conectar_bd.php");

session_start();
// Comprueba si hay un mensaje,lo muestra y lo borra
$mensaje_error = '';
if (isset($_SESSION['message'])) {
    $mensaje_error = $_SESSION['message'];
    unset($_SESSION['message']);
}

// Si hay sesion hace una consulta con el dni y obtiene todos los datos (datos de la cuenta)
if (isset($_SESSION['dni'])) {
    $dnicuenta = $_SESSION['dni'];

    try {
        $stmt = $con->prepare('SELECT * FROM usuarios WHERE dni = ?');
        $stmt->execute([$dnicuenta]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $dnienvio = $user['dni'];
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

        switch ($user['rol']) {
            case 1:
                $rol = 'Administrador';
                break;
            case 2:
                $rol = 'Empleado';
                break;
            case 3:
                $rol = 'Usuario';
                break;
            default:
                $rol = 'Rol no definido';
                break;
        }

        switch ($user['activo']) {
            case 1:
                $activo = 'Cuenta Activada';
                break;
            case 2:
                $activo = 'Cuenta Desactivada';
                break;
            default:
                $activo = 'Error en el estado de la cuenta';
                break;
        }
        
    } catch (PDOException $e) {
        exit('Error al conectar con la base de datos: ' . $e->getMessage());
    }

    // si no, declara las variables
} else {
    $pedido_dni = "";
    $pedido_nombre = "";
    $pedido_apellidos = "";
    $pedido_direccion = "";
    $pedido_localidad = "";
    $pedido_provincia = "";
    $pedido_pais = "";
    $pais = "";
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
        $subtotal += (float)$producto['precio'] * (int)$productos_en_carrito[$producto['producto_id']];
    }
}
