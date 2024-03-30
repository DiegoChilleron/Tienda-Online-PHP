<?php
include("../model/actualizar_pedido.php");

$title = ("Editar pedido");
include("header.php");

?>

<body class="container-fluid bg-body-secondary">
    <main class="row justify-content-around align-items-center">
        <div class="col-12 col-md-4 text-center p-2">
            <h1>Modificar pedido</h1>
            <div class="h2"> <?php echo $mensaje_error; ?></div>
        </div>
        <form class="bg-white col-12 col-md-6 border mt-5 mb-5 p-4" method="POST" action="/controller/modificar_pedido.php" name="f1">

            <label for="numpedido" class="form-label">Número de Pedido:*</label><br>
            <input type="text" class="form-control form-control-sm rounded-0" maxlength="30" id="numpedido" name="numpedido" value="<?php echo isset($numpedido) ? $numpedido : '' ?>" readonly><br>
            <div class="row">
                <div class="col">
                    <label for="dnicuenta" class="form-label">DNI de la cuenta:*</label><br>
                    <input type="text" class="form-control form-control-sm rounded-0" maxlength="30" size="40" id="dnicuenta" name="dnicuenta" value="<?php echo isset($dnicuenta) ? $dnicuenta : '' ?>" required><br>
                </div>

                <div class="col">
                    <label for="dni" class="form-label">DNI de envio:*</label><br>
                    <input type="text" class="form-control form-control-sm rounded-0" maxlength="30" size="40" id="dni" name="dni" value="<?php echo isset($dni) ? $dni : '' ?>" required><br>
                </div>
            </div>
            <label for="nombre" class="form-label">Nombre:*</label><br>
            <input type="text" class="form-control form-control-sm rounded-0" maxlength="30" size="40" id="nombre" name="nombre" value="<?php echo isset($nombre) ? $nombre : '' ?>" required><br>

            <label for="apellidos" class="form-label">Apellidos:*</label><br>
            <input type="text" class="form-control form-control-sm rounded-0" maxlength="30" size="40" id="apellidos" name="apellidos" value="<?php echo isset($apellidos) ? $apellidos : '' ?>" required><br>

            <label for="direccion" class="form-label">Dirección:*</label><br>
            <input type="text" class="form-control form-control-sm rounded-0" maxlength="50" size="80" id="direccion" name="direccion" value="<?php echo isset($direccion) ? $direccion : '' ?>" required><br>
            <div class="row">
                <div class="col">
                    <label for="localidad" class="form-label">Localidad:*</label><br>
                    <input type="text" class="form-control form-control-sm rounded-0" maxlength="30" size="50" id="localidad" name="localidad" value="<?php echo isset($localidad) ? $localidad : '' ?>" required><br>
                </div>

                <div class="col">
                    <label for="provincia" class="form-label">Provincia:*</label><br>
                    <input type="text" class="form-control form-control-sm rounded-0" maxlength="30" size="50" id="provincia" name="provincia" value="<?php echo isset($provincia) ? $provincia : '' ?>" required><br>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="pais" class="form-label ">País:*</label><br>
                    <select id="pais" name="pais" class="form-select form-select-sm rounded-0" aria-label=".form-select-sm example" value="<?php echo isset($pais) ? $pais : '' ?>" required>
                        <option selected>-- Selecciona un país --</option>
                        <option value="es" <?php if ($pais == "es") echo "selected"; ?>>España</option>
                        <option value="fr" <?php if ($pais == "fr") echo "selected"; ?>>Francia</option>
                        <option value="pr" <?php if ($pais == "pr") echo "selected"; ?>>Portugal</option>
                        <option value="it" <?php if ($pais == "it") echo "selected"; ?>>Italia</option>
                        <option value="gr" <?php if ($pais == "gr") echo "selected"; ?>>Alemania</option>
                        <option value="uk" <?php if ($pais == "uk") echo "selected"; ?>>Reino Unido</option>
                    </select>
                </div>
                <div class="col">
                    <label for="producto_id" class="form-label">Producto_id:*</label><br>
                    <input type="text" class="form-control form-control-sm rounded-0" maxlength="30" id="producto_id" name="producto_id" value="<?php echo isset($producto_id) ? $producto_id : '' ?>" required><br>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="cantidad" class="form-label">Cantidad:*</label><br>
                    <input type="text" class="form-control form-control-sm rounded-0" maxlength="30" id="cantidad" name="cantidad" value="<?php echo isset($cantidad) ? $cantidad : '' ?>" required><br>
                </div>
                <div class="col">
                    <label for="precio_total" class="form-label">Precio Total:*</label><br>
                    <input type="text" class="form-control form-control-sm rounded-0" maxlength="30" id="precio_total" name="precio_total" value="<?php echo isset($precio_total) ? $precio_total : '' ?>" required><br>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="metodo_de_pago" class="form-label ">Estado:*</label><br>
                    <select id="metodo_de_pago" name="metodo_de_pago" class="form-select form-select-sm rounded-0" aria-label=".form-select-sm example" value="<?php echo isset($metodo_de_pago) ? $metodo_de_pago : '' ?>" required>
                        <option selected>-- Selecciona un Método de Pago --</option>
                        <option value="1" <?php if ($metodo_de_pago === 1) echo "selected"; ?>>Tarjeta de Crédito</option>
                        <option value="2" <?php if ($metodo_de_pago === 2) echo "selected"; ?>>PayPal</option>
                        <option value="3" <?php if ($metodo_de_pago === 3) echo "selected"; ?>>Google Pay</option>
                        <option value="4" <?php if ($metodo_de_pago === 4) echo "selected"; ?>>ApplePay</option>
                        <option value="5" <?php if ($metodo_de_pago === 5) echo "selected"; ?>>Transferencia Bancaria</option>
                        <option value="6" <?php if ($metodo_de_pago === 6) echo "selected"; ?>>Ethereum</option>
                    </select>
                </div>
                <div class="col">
                    <label for="estado" class="form-label ">Estado:*</label><br>
                    <select id="estado" name="estado" class="form-select form-select-sm rounded-0" aria-label=".form-select-sm example" value="<?php echo isset($estado) ? $estado : '' ?>" required>
                        <option selected>-- Selecciona un Estado --</option>
                        <option value="1" <?php if ($estado === 1) echo "selected"; ?>>Cancelado</option>
                        <option value="2" <?php if ($estado === 2) echo "selected"; ?>>Pendiente de pago</option>
                        <option value="3" <?php if ($estado === 3) echo "selected"; ?>>Aceptado</option>
                        <option value="4" <?php if ($estado === 4) echo "selected"; ?>>Enviado</option>
                    </select>
                </div>
            </div>
            <p class="text-body-tertiary">*(Campo requerido)</p>
            <div class="row justify-content-center mt-2 mb-2">
                <button type="button" class="col-4 col-md-3 btn btn-color-primary m-2 rounded-0" onclick="goBack()">Atrás</button>
                <input class="col-4 col-md-3 btn btn-color-primary m-2 rounded-0" name="Borrar" value="Vaciar campos" type="reset">
                <input class="col-4 col-md-3 btn btn-color-primary m-2 rounded-0" name="Enviar" value="Enviar datos" type="submit">
            </div>
        </form>
    </main>

    <?php
    include("footer.php");
    ?>
</body>

</html>