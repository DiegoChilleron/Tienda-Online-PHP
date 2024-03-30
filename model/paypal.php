<?php

// Boton de PayPal

// En true usa la plataforma de pruebas de PayPal

$testmode = true;
$paypalurl = $testmode ? 'https://www.sandbox.paypal.com/cgi-bin/webscr' : 'https://www.paypal.com/cgi-bin/webscr';

// Cuando se hace click en el boton pagar con PayPal
if (isset($_POST['paypal']) && $productos_en_carrito && !empty($productos_en_carrito)) {

    // Variables PayPal

    $data = array(
        'cmd'            => '_cart',
        'upload'        => '1',
        'lc'            => 'ES',
        'business'         => 'info@latiendadediego.site',
        'cancel_return'    => 'https://latiendadediego.site/view/carrito.php',
        'notify_url'    => 'https://latiendadediego.site/view/carrito.php',
        'currency_code'    => 'EUR',
        'return'        => 'https://latiendadediego.site/view/pedido.php'
    );
    // Agrega todos los productos que están en el carrito de compras a la variable de datos
    for ($i = 0; $i < count($productos); $i++) {
        $data['item_number_' . ($i + 1)] = $productos[$i]['producto_id'];
        $data['item_name_' . ($i + 1)] = $productos[$i]['nombre'];
        $data['quantity_' . ($i + 1)] = $productos_en_carrito[$productos[$i]['producto_id']];
        $data['amount_' . ($i + 1)] = $productos[$i]['precio'];
    }
    // Envía al usuario a la pantalla de pago de PayPal
    header('location:' . $paypalurl . '?' . http_build_query($data));
    exit;
}
