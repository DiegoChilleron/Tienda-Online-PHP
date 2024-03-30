    <?php
    $title = ("Formulario de registro");
    include("header.php");
    include("../model/registro_usuario.php");
    ?>

    <body class="container-fluid bg-body-secondary">

        <main class="row justify-content-around align-items-center">
            <div class="col-12 col-md-4 text-center p-2">
                <h1>Nuevo Usuario</h1>
                <div class="h2"> <?php echo $mensaje_error; ?></div>
            </div>
            <form class="bg-white col-12 col-md-6 border mt-5 mb-5 p-4" method="post" action="../controller/introducir_usuario.php" name="f1">
                <label for="dni" class="form-label">DNI:*</label><br>
                <input type="text" class="form-control form-control-sm rounded-0" maxlength="9" size="40" id="dni" name="dni" required><br>

                <label for="usuario" class="form-label">Nombre de Usuario:*</label><br>
                <input type="text" class="form-control form-control-sm rounded-0" maxlength="30" id="usuario" name="usuario" required><br>

                <label for="clave" class="form-label">Contraseña:*</label><br>
                <input type="password" class="form-control form-control-sm rounded-0" maxlength="30" id="clave" name="clave" required><br>

                <label for="nombre" class="form-label">Nombre:*</label><br>
                <input type="text" class="form-control form-control-sm rounded-0" maxlength="30" size="40" id="nombre" name="nombre" required><br>

                <label for="apellidos" class="form-label">Apellidos:*</label><br>
                <input type="text" class="form-control form-control-sm rounded-0" maxlength="30" size="40" id="apellidos" name="apellidos" required><br>

                <label for="direccion" class="form-label">Dirección:*</label><br>
                <input type="text" class="form-control form-control-sm rounded-0" maxlength="50" size="80" id="direccion" name="direccion" required><br>
                <div class="row">
                    <div class="col">
                        <label for="localidad" class="form-label">Localidad:*</label><br>
                        <input type="text" class="form-control form-control-sm rounded-0" maxlength="30" size="50" id="localidad" name="localidad" required><br>
                    </div>

                    <div class="col">
                        <label for="provincia" class="form-label">Provincia:*</label><br>
                        <input type="text" class="form-control form-control-sm rounded-0" maxlength="30" size="50" id="provincia" name="provincia" required><br>
                    </div>
                </div>
                <div class="row pb-4">
                    <div class="col">
                        <label for="pais" class="form-label">País:*</label><br>
                        <select id="pais" name="pais" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                            <option selected>-- Selecciona un país --</option>
                            <option value="es" <?php if ($pais == "es") echo "selected" ?>>España</option>
                            <option value="fr" <?php if ($pais == "fr") echo "selected" ?>>Francia</option>
                            <option value="pr" <?php if ($pais == "pr") echo "selected" ?>>Portugal</option>
                            <option value="it" <?php if ($pais == "it") echo "selected" ?>>Italia</option>
                            <option value="gr" <?php if ($pais == "gr") echo "selected" ?>>Alemania</option>
                            <option value="uk" <?php if ($pais == "uk") echo "selected" ?>>Reino Unido</option>
                        </select>
                    </div>
                    <div class="col">
                        <div class="col">
                            <label for="hombre" class="form-label">Selecciona sexo:</label>
                            <div class="row justify-content-center">
                                <div class="col-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sexo" id="hombre" value="hombre" <?php if ($sexo == "hombre") echo "checked"; ?>>
                                        <label class="form-check-label" for="hombre">Hombre</label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sexo" id="mujer" value="mujer" <?php if ($sexo == "mujer") echo "checked"; ?>>
                                        <label class="form-check-label" for="mujer">Mujer</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="telefono" class="form-label">Telefono:*</label><br>
                        <input type="tel" class="form-control form-control-sm rounded-0" maxlength="9" minlength="6" size="40" id="telefono" name="telefono" pattern="[0-9]{9}" required><br>
                    </div>
                    <div class="col">
                        <label for="email" class="form-label">Email:*</label><br>
                        <input type="email" class="form-control form-control-sm rounded-0" maxlength="30" id="email" name="email" required><br>
                    </div>
                </div>
                <p class="text-body-tertiary">*(Campo requerido)</p>

                <!-- Rol 3 (usuario) por defecto para nuevos usuarios -->
                <input type="hidden" name="rol" value="3">
                <!-- Activo 1 (usuario activo) por defecto para nuevos usuarios -->
                <input type="hidden" name="activo" value="1">

                <div class="row justify-content-center mt-2 mb-2">
                    <input class="col-4 col-md-3 btn btn-color-primary m-2 rounded-0" name="Borrar" value="Vaciar campos" type="reset">
                    <input class="col-4 col-md-3 btn btn-color-primary m-2 rounded-0" name="Enviar" value="Enviar datos" type="submit">
                    <a href="login.php" class="col-4 col-md-3 btn btn-color-primary m-2 rounded-0">Volver a Login</a>
                </div>
            </form>
        </main>
        <?php
        include("footer.php");
        ?>

    </body>

    </html>