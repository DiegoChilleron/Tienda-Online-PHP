<?php
include("../model/datos_de_envio.php");

$title = "Formulario de Envio";
include("header.php");
?>

<body class="container-fluid">
    <div class="h2"> <?php echo $mensaje_error ?></div>
    <main class="row">

        <section class="col-12 col-md-4 p-3 pt-5 border">
            <?php

            if (isset($_SESSION['dni'])) {

            ?>
                <h2>Datos Personales</h2>
                <h3>Detalles de tu cuenta:</h3>
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
                    <tr>
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
                    <tr>
                        <td>Rol:</td>
                        <td><?= ($rol) ?></td>
                    </tr>
                    <tr>
                        <td>Estado de la cuenta:</td>
                        <td><?= ($activo) ?></td>
                    </tr>
                    <tr>
                </table>
            <?php
            }

            if (!isset($_SESSION['dni'])) {
                echo '<p class="h5 pb-4"> Inicie sesión o realice la compra como invitado</p>';
                include("../model/form_registro.php");
            }

            ?>
        </section>
        <section class="col-12 col-md-8 p-3 pt-5 border">
            <h2>Datos de Envio</h2>
            <form method="post" action="form_metodo_pago.php" name="f1">

                <label for="pedido_dni" class="form-label">DNI:</label><br>
                <input type="text" class="form-control form-control-sm" maxlength="9" size="40" id="pedido_dni" name="pedido_dni" value="<?php echo isset($dnienvio) ? $dnienvio : '' ?>" required><br>

                <label for="pedido_nombre" class="form-label">Nombre:</label><br>
                <input type="text" class="form-control form-control-sm" maxlength="30" size="40" id="pedido_nombre" name="pedido_nombre" value="<?php echo isset($nombre) ? $nombre : '' ?>" required><br>

                <label for="pedido_apellidos" class="form-label">Apellidos:</label><br>
                <input type="text" class="form-control form-control-sm" maxlength="30" size="40" id="pedido_apellidos" name="pedido_apellidos" value="<?php echo isset($apellidos) ? $apellidos : '' ?>" required><br>

                <label for="pedido_direccion" class="form-label">Dirección:</label><br>
                <input type="text" class="form-control form-control-sm" maxlength="50" size="80" id="pedido_direccion" name="pedido_direccion" value="<?php echo isset($direccion) ? $direccion : '' ?>" required><br>
                <div class="row">
                    <div class="col">
                        <label for="pedido_localidad" class="form-label">Localidad:</label><br>
                        <input type="text" class="form-control form-control-sm" maxlength="30" size="50" id="pedido_localidad" name="pedido_localidad" value="<?php echo isset($localidad) ? $localidad : '' ?>" required><br>
                    </div>

                    <div class="col">
                        <label for="pedido_provincia" class="form-label">Provincia:</label><br>
                        <input type="text" class="form-control form-control-sm" maxlength="30" size="50" id="pedido_provincia" name="pedido_provincia" value="<?php echo isset($provincia) ? $provincia : '' ?>" required><br>
                    </div>
                </div>
                <div class="row pb-4">
                    <div class="col-12 col-md-4">
                        <label for="pedido_pais" class="form-label">País:</label><br>
                        <select id="pedido_pais" name="pedido_pais" class="form-select form-select-sm" aria-label=".form-select-sm example" value="<?php echo isset($pais) ? $pais : '' ?>" required>
                            <option selected>-- Selecciona un país --</option>
                            <option value="es" <?php if ($pais == "es") echo "selected"; ?>>España</option>
                            <option value="fr" <?php if ($pais == "fr") echo "selected"; ?>>Francia</option>
                            <option value="pr" <?php if ($pais == "pr") echo "selected"; ?>>Portugal</option>
                            <option value="it" <?php if ($pais == "it") echo "selected"; ?>>Italia</option>
                            <option value="gr" <?php if ($pais == "gr") echo "selected"; ?>>Alemania</option>
                            <option value="uk" <?php if ($pais == "uk") echo "selected"; ?>>Reino Unido</option>
                        </select>
                    </div>
                    <div class="row justify-content-center mt-2 mb-2">
                        <input class="col-5 col-md-3 btn btn-color-primary m-2 rounded-0" name="Borrar" value="Vaciar campos" type="reset">
                        <a href="carrito.php" class="col-5 col-md-3 btn btn-color-primary rounded-0 m-2">Volver al Carrito</a>
                        <input class="col-5 col-md-3 btn btn-green m-2 rounded-0" name="Enviar" value="Realizar Pedido" type="submit">

                    </div>
            </form>
        </section>

        <section class=" col-12 p-5">
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
        </section>
    </main>
    <?php
    include("../view/footer.php");
    ?>
</body>

</html>