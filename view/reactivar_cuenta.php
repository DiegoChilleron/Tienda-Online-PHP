<?php

include("../controller/conectar_bd.php");
session_start();

include("../model/reactivar_usuario.php");

$title = ("Reactivar cuenta");
include("header.php");

?>

<body class="container-fluid bg-body-secondary">

    <main class="row justify-content-around align-items-center">
        <section class="col-12 col-md-4 p-3">
            <h1 class="h3">Reactivar cuenta de usuario</h1>
            <p>Tu cuenta ha sido desactivada. ¿Quieres volver a activarla?</p>
            <div class="h2"> <?php echo $mensaje_error; ?></div>
        </section>
        <form class="bg-white col-12 col-md-11 border p-4 mb-5" method="POST" action="/controller/reactivar.php" name="f1">
            <div class="row">
                <div class="col">
                    <label for="dni" class="form-label">DNI:</label><br>
                    <input type="text" class="form-control form-control-sm rounded-0" maxlength="9" size="40" id="dni" name="dni" value="<?php echo isset($dni) ? $dni : '' ?>" disabled><br>
                </div>
                <div class="col">
                    <label for="usuario" class="form-label">Nombre de Usuario:</label><br>
                    <input type="text" class="form-control form-control-sm rounded-0" maxlength="30" id="usuario" name="usuario" value="<?php echo isset($usuario) ? $usuario : '' ?>" disabled><br>
                </div>
                <div class="col">
                    <label for="nombre" class="form-label">Nombre:</label><br>
                    <input type="text" class="form-control form-control-sm rounded-0" maxlength="30" size="40" id="nombre" name="nombre" value="<?php echo isset($nombre) ? $nombre : '' ?>" disabled><br>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="apellidos" class="form-label">Apellidos:</label><br>
                    <input type="text" class="form-control form-control-sm rounded-0" maxlength="30" size="50" id="apellidos" name="apellidos" value="<?php echo isset($apellidos) ? $apellidos : '' ?>" disabled><br>
                </div>
                <div class="col">
                    <label for="direccion" class="form-label">Dirección:</label><br>
                    <input type="text" class="form-control form-control-sm rounded-0" maxlength="50" size="50" id="direccion" name="direccion" value="<?php echo isset($direccion) ? $direccion : '' ?>" disabled><br>
                </div>
                <div class="col">
                    <label for="localidad" class="form-label">Localidad:</label><br>
                    <input type="text" class="form-control form-control-sm rounded-0" maxlength="30" size="50" id="localidad" name="localidad" value="<?php echo isset($localidad) ? $localidad : '' ?>" disabled><br>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="provincia" class="form-label">Provincia:</label><br>
                    <input type="text" class="form-control form-control-sm rounded-0" maxlength="30" size="50" id="provincia" name="provincia" value="<?php echo isset($provincia) ? $provincia : '' ?>" disabled><br>
                </div>


                <div class="col">
                    <label for="pais" class="form-label ">País:</label><br>
                    <select id="pais" name="pais" class="form-select form-select-sm rounded-0" aria-label=".form-select-sm example" value="<?php echo isset($pais) ? $pais : '' ?>" disabled>
                        <option selected>-- Selecciona un país --</option>
                        <option value="es" <?php if ($pais == "es") echo "selected"; ?>>España</option>
                        <option value="fr" <?php if ($pais == "fr") echo "selected"; ?>>Francia</option>
                        <option value="pr" <?php if ($pais == "pr") echo "selected"; ?>>Portugal</option>
                        <option value="it" <?php if ($pais == "it") echo "selected"; ?>>Italia</option>
                        <option value="gr" <?php if ($pais == "gr") echo "selected"; ?>>Alemania</option>
                        <option value="uk" <?php if ($pais == "uk") echo "selected"; ?>>Reino Unido</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="hombre" class="form-label">Selecciona sexo:</label>
                    <div class="row justify-content-center">
                        <div class="col-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sexo" id="hombre" value="hombre" <?php if ($sexo == "hombre") echo "checked"; ?> disabled>
                                <label class="form-check-label" for="hombre">Hombre</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sexo" id="mujer" value="mujer" <?php if ($sexo == "mujer") echo "checked"; ?> disabled>
                                <label class="form-check-label" for="mujer">Mujer</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <label for="telefono" class="form-label">Telefono:</label><br>
                    <input type="tel" class="form-control form-control-sm rounded-0" maxlength="9" minlength="6" size="40" id="telefono" name="telefono" pattern="[0-9]{9}" value="<?php echo isset($telefono) ? $telefono : '' ?>" disabled><br>
                </div>
                <div class="col">
                    <label for="email" class="form-label">Email:</label><br>
                    <input type="email" class="form-control form-control-sm rounded-0" maxlength="30" id="email" name="email" value="<?php echo isset($email) ? $email : '' ?>" disabled><br>
                </div>
            </div>

            <div>
                <input type="hidden" id="dni" name="dni" value="<?php echo $dni; ?>"><br>
            </div>
            <div>
                <div class="row justify-content-center mt-2 mb-2">
                    <button type="button" class="col-4 col-md-1 btn btn-color-primary m-2 rounded-0" onclick="goBack()">Atrás</button>
                    <input class="col-4 col-md-3 btn btn-color-primary m-2 rounded-0" name="Reactivar Cuenta" value="Reactivar Cuenta" type="submit">
                </div>
        </form>
    </main>
    <?php
    include("footer.php");
    ?>
</body>

</html>