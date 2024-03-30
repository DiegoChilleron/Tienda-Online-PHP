<!-- Archivo de modificacion de clientes de la base de datos -->

<?php

include("../controller/conectar_bd.php");
session_start();

$title = ("Recuperar contraseña");
include("header.php");


// Comprueba si hay un mensaje,lo muestra y lo borra
$mensaje_error = '';
if (isset($_SESSION['message'])) {
    $mensaje_error = $_SESSION['message'];
    unset($_SESSION['message']);
}


//Comprueba si no hay sesion redirecciona a login

if (!isset($_SESSION['rol'])) {
    header("Location: index.php");
    exit();
}

?>

<body>
    <main class="container-fluid bg-secondary-subtle p-5">
        <div class="row d-flex justify-content-center align-items-center">
            <form class="col-6 border rounded-0 p-4 bg-light" method="post" action="../controller/recuperarclave.php" name="f1">
                <div class="h5 text-center"> <?php echo $mensaje_error; ?></div>
                <h1 class="h2 text-center p-4">Modificar Contraseña</h1>
                <div class="border p-5 m-3">
                    <h3>Confirmar datos</h3>
                    <label for="dni" class="form-label">DNI:</label><br>
                    <input type="text" class="form-control rounded-0" maxlength="9" size="40" id="dni" name="dni" value="" required><br>

                    <label for="usuario" class="form-label">Nombre de usuario:</label><br>
                    <input type="text" class="form-control rounded-0" maxlength="30" id="usario" name="usuario" value="" required><br>
                </div>
                <label for="clave" class="form-label">Nueva Contraseña:</label><br>
                <input type="password" class="form-control rounded-0" maxlength="30" size="40" id="clave" name="clave" value="" required><br>

                <div class="d-flex justify-content-center">
                    <button type="button" class="col-4 col-md-3 btn btn-color-primary rounded-0 m-2" onclick="goBack()">Atrás</button>
                    <input class="col-4 col-md-3 btn btn-color-primary rounded-0 m-2" name="Borrar" value="Vaciar campos" type="reset">
                    <input class="col-4 col-md-3 btn btn-color-primary rounded-0 m-2" name="Enviar" value="Enviar datos" type="submit"><br>
                </div>
            </form>
        </div>
    </main>
    <?php
    include("footer.php");
    ?>
</body>

</html>