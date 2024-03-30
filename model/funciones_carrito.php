<?php

include("../controller/conectar_bd.php");
session_start();


// Si el usuario hizo clic en el botón de agregar al carrito en la página del producto
if (isset($_POST['producto_id'], $_POST['cantidad']) && is_numeric($_POST['producto_id']) && is_numeric($_POST['cantidad'])) {

    $producto_id = (int)$_POST['producto_id'];
    $cantidad = (int)$_POST['cantidad'];

    $stmt = $con->prepare('SELECT * FROM productos WHERE producto_id = ?');
    $stmt->execute([$_POST['producto_id']]);

    $producto = $stmt->fetch(PDO::FETCH_ASSOC);
    // Verificar si el producto existe
    if ($producto && $cantidad > 0) {
        if (isset($_SESSION['carrito']) && is_array($_SESSION['carrito'])) {
            if (array_key_exists($producto_id, $_SESSION['carrito'])) {
                 // El producto existe en el carrito, así que solo actualiza la cantidad
                $_SESSION['carrito'][$producto_id] += $cantidad;
            } else {
                // El producto no está en el carrito, así que agrégalo
                $_SESSION['carrito'][$producto_id] = $cantidad;
            }
        } else {
            // No hay productos en el carrito, esto agregará el primer producto al carrito
            $_SESSION['carrito'] = array($producto_id => $cantidad);
        }
    }

    header('location: /view/carrito.php');
    exit;
}
// -------------------------------------- //

// Eliminar un producto del carrito (utiliza el get)

if (isset($_GET['borrar']) && is_numeric($_GET['borrar']) && isset($_SESSION['carrito']) && isset($_SESSION['carrito'][$_GET['borrar']])) {
    unset($_SESSION['carrito'][$_GET['borrar']]);
}
// Boton actualizar //

if (isset($_POST['actualizar']) && isset($_SESSION['carrito'])) {
    foreach ($_POST as $k => $v) {
        if (strpos($k, 'cantidad') !== false && is_numeric($v)) {
            $producto_id = str_replace('cantidad-', '', $k);
            $cantidad = (int)$v;
            if (is_numeric($producto_id) && isset($_SESSION['carrito'][$producto_id]) && $cantidad > 0) {
                $_SESSION['carrito'][$producto_id] = $cantidad;
            }
        }
    }
    header('location: /view/carrito.php');
    exit;
}

// Procesar el carrito a la pagina pedido
if (isset($_POST['pedido']) && isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
    header('location: /view/form_de_envio.php');
    exit;
}

//--------------
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




?>