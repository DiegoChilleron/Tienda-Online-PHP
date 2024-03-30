<?php

include("../model/funciones_carrito.php");
include("../model/paypal.php");

$title = "Carrito";
include("header.php");
?>

<body class="container-fluid">
    <main class="pt-4 pb-4">
        <h1 class="pb-5 h3 text-center">Cesta del carrito</h1>
        <form action="carrito.php" method="post">
            <table class="table">
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
                                    <a href="/view/carrito.php/?borrar=<?= $producto['producto_id'] ?>" class="text-danger">Borrar</a>
                                </td>
                                <td><?= $producto['precio'] ?> €</td>
                                <td>
                                    <input type="number" class="form-control" name="cantidad-<?= $producto['producto_id'] ?>" value="<?= $productos_en_carrito[$producto['producto_id']] ?>" min="1" max="<?= $producto['cantidad'] ?>" placeholder="cantidad" required>
                                </td>
                                <td><?= $producto['precio'] * $productos_en_carrito[$producto['producto_id']] ?> €</td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
            <div class="d-flex justify-content-between my-3">
                <span class="h4">Subtotal</span>
                <span class="h4"><?= $subtotal ?> €</span>
            </div>
            <div>
                <input class="btn btn-secondary rounded-0" type="submit" value="Actualizar" name="actualizar">
            </div>
            <div class=" d-flex align-items-end flex-column mb-5">
                <a class="btn btn-green rounded-0 col-6 col-md-4 col-lg-2" href="form_de_envio.php" role="button">Pedido</a>
                <button class="bg-warning border-1 col-6 col-md-4 col-lg-2  fst-italic text-white p-1 mt-3" type="submit" value="paypal" name="paypal">Pagar con <img src="/public/img/PayPal.svg" width="auto" height="22" alt="PayPal Logo"></button>
            </div>
        </form>
        <section class="pb-4">
            <button type="button" class="btn btn-secondary rounded-0" onclick="goBack()">Atrás</button>
        </section>
    </main>

    <?php
    include("footer.php");
    ?>
</body>

</html>