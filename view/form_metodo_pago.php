<?php

include("../model/datos_de_pago.php");

$title = "Formulario de Pago";
include("header.php");
?>

<body class="container-fluid">

    <main class="row ">
        <section class="row col-12 col-md-6 border">
            <div class="h2"> <?php echo $mensaje_error; ?></div>
            <h1 class="h3 pt-4"> Resumen del Pedido</h1>
            <articles class="col-12 col-md-12 p-3">
                <h4>Dirección de facturación:</h4>
                <table>
                    <tr>
                        <td>Nombre de usuario:</td>
                        <td><?= ($usuario) ?></td>
                    </tr>
                    <tr>
                        <td>Correo Electronico:</td>
                        <td><?= ($email) ?></td>
                    </tr>
                    <tr>
                        <td>DNI:</td>
                        <td><?= ($dnicuenta) ?></td>
                    </tr>
                    <tr>
                        <td>Nombre:</td>
                        <td><?= ($nombre) ?></td>
                    </tr>
                    <tr>
                        <td>Apellidos:</td>
                        <td><?= ($apellidos) ?></td>
                    </tr>
                    <tr>
                        <td>Dirección:</td>
                        <td><?= ($direccion) ?></td>
                    </tr>
                    <tr>
                        <td>Localidad:</td>
                        <td><?= ($localidad) ?></td>
                    </tr>
                    <td>Provincia:</td>
                    <td><?= ($provincia) ?></td>
                    </tr>
                    <tr>
                        <td>Pais:</td>
                        <td><?= ($pais) ?></td>
                    </tr>
                    <tr>
                        <td>Sexo:</td>
                        <td><?= ($sexo) ?></td>
                    </tr>
                    <tr>
                        <td>Teléfono:</td>
                        <td><?= ($telefono) ?></td>
                    </tr>
                </table>
            </articles>

            <articles class="col-12 col-md-12 p-3">
                <h4>Direccion de envío:</h4>
                <table>
                    <tr>
                        <td>DNI:</td>
                        <td><?= ($pedido_dni) ?></td>
                    </tr>
                    <tr>
                        <td>Nombre:</td>
                        <td><?= ($pedido_nombre) ?></td>
                    </tr>
                    <tr>
                        <td>Apellidos:</td>
                        <td><?= ($pedido_apellidos) ?></td>
                    </tr>
                    <tr>
                        <td>Dirección:</td>
                        <td><?= ($pedido_direccion) ?></td>
                    </tr>
                    <tr>
                        <td>Localidad:</td>
                        <td><?= ($pedido_localidad) ?></td>
                    </tr>
                    <tr>
                        <td>Provincia:</td>
                        <td><?= ($pedido_provincia) ?></td>

                    </tr>
                    <tr>
                        <td>Pais:</td>
                        <td><?= ($pedido_pais) ?></td>
                    </tr>
                </table>
                </acticles>

                <articles class=" col-12 col-md-12 p-5">
                    <h2>Datos del Carrito</h2>
                    <table class="table col-auto">
                        <thead>
                            <tr>
                                <th scope="col" colspan="2">Producto</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($productos)) : ?>
                                <tr>
                                    <td colspan="5" class="text-center">No tienes productos añadidos a tu carrito</td>
                                </tr>
                            <?php else : ?>
                                <?php foreach ($productos as $producto) : ?>
                                    <tr>
                                        <td>
                                            <a href="/view/producto.php/?id=<?= $producto['producto_id'] ?>">
                                                <img src="/public/img_productos/<?= $producto['img'] ?>" class="img-fluid" width="50" height="50" alt="<?= $producto['nombre'] ?>">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="/view/producto.php/?id=<?= $producto['producto_id'] ?>"><?= $producto['nombre'] ?></a>
                                            <br>

                                        </td>
                                        <td><?= $producto['precio'] ?> €</td>
                                        <td>
                                            <input type="number" class="form-control" name="cantidad-<?= $producto['producto_id'] ?>" value="<?= $productos_en_carrito[$producto['producto_id']] ?>" min="1" max="<?= $producto['cantidad'] ?>" placeholder="cantidad" disabled>
                                        </td>
                                        <td><?= $producto['precio'] * $productos_en_carrito[$producto['producto_id']] ?> €</td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </articles>
        </section>
        <section class="col-12 col-md-6 m-2">

            <h3>Métodos de pago</h3>
            <form class="pt-4" method="post" action="/controller/procesar_pedido.php" name="f1">

                <div class="accordion accordion-flush p-2 border" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                <img src="/public/img/visa.svg" width="auto" height="40">
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body"><input type="radio" name="metodo_de_pago" value="1" required> Pago con Tarjeta</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                <img src="/public/img/PayPal.svg" width="auto" height="40">
                            </button>
                        </h2>
                        <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body"><input type="radio" name="metodo_de_pago" value="2"> Pago con PayPal</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                <img src="/public/img/google-pay.svg" width="auto" height="40">
                            </button>
                        </h2>
                        <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body"> <input type="radio" name="metodo_de_pago" value="3"> Pago con Google Pay</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                                <img src="/public/img/apple-pay.svg" width="auto" height="40">
                            </button>
                        </h2>
                        <div id="flush-collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body"> <input type="radio" name="metodo_de_pago" value="4"> Pago con Apple Pay</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                                <img src="/public/img/transferencia.svg" width="auto" height="40">
                            </button>
                        </h2>
                        <div id="flush-collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body"><input type="radio" name="metodo_de_pago" value="5"> Pago por Transferencia Bancaria
                                <p>
                                    Por favor, transfiera el importe de la factura a nuestra cuenta bancaria. Introduzca su DNI como concepto de la transferencia. Los productos se reservarán 1 días para usted y procesaremos el pedido inmediatamente después de recibir el pago.
                                    </br> </br>Cuenta bancaria: IBAN ES76 0019 0039 3948 4937 2987
                                    </br>Concepto: <?php echo $pedido_dni ?>
                                    </br> Importe : <?php echo $producto['precio'] * $productos_en_carrito[$producto['producto_id']] ?> €
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
                                <img src="/public/img/ethereum.svg" width="auto" height="40">
                            </button>
                        </h2>
                        <div id="flush-collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body"><input type="radio" name="metodo_de_pago" value="6"> Pago con Ethereum<p>
                                    Por favor, transfiera el importe de la factura a nuestra billetera de ethereum. Recibirá nuestra confirmación de pedido por correo electrónico. Los productos se reservarán 1 días para usted y procesaremos el pedido inmediatamente después de recibir el pago.
                                    </br> </br> Billetera (ERC20) 0xe88ad4e67f98633fd2667188838f3
                                    </br> Importe : <?php echo $producto['precio'] * $productos_en_carrito[$producto['producto_id']] ?> €
                                    </br> Importe : <?php echo $eth = 3.533 * ($producto['precio'] * $productos_en_carrito[$producto['producto_id']]) ?> ETH
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <input type="hidden" name="dnicuenta" value="<?php echo $dnicuenta; ?>">
                    <input type="hidden" name="pedido_dni" value="<?php echo $pedido_dni; ?>">
                    <input type="hidden" name="pedido_nombre" value="<?php echo $pedido_nombre; ?>">
                    <input type="hidden" name="pedido_apellidos" value="<?php echo $pedido_apellidos; ?>">
                    <input type="hidden" name="pedido_direccion" value="<?php echo $pedido_direccion; ?>">
                    <input type="hidden" name="pedido_localidad" value="<?php echo $pedido_localidad; ?>">
                    <input type="hidden" name="pedido_provincia" value="<?php echo $pedido_provincia; ?>">
                    <input type="hidden" name="pedido_pais" value="<?php echo $pedido_pais; ?>">
                </div>
                <div class=" row align-items-end flex-column mt-5">
                    <input class="btn btn-green rounded-0 col-6 col-md-4 mt-2" name="Realizar Pedido" value="Realizar Pedido" type="submit">
                    <button type="button" class="btn btn-secondary rounded-0 col-6 col-md-4 mt-2" onclick="goBack()">Atrás</button>
                </div>
            </form>
        </section>
    </main>
    <?php
    include("footer.php");
    ?>
</body>

</html>