<?php

session_start();

// No permite la cache del navegador (corrige volver atras)
if (!isset($_SESSION['loggedin'])) {
    header('Cache-Control: no-cache, must-revalidate, max-age=0');
    header('Pragma: no-cache');
    header('Expires: Wed, 11 Jan 1984 05:00:00 GMT');
    header('Location: /view/login.php');
    exit;
}


// Comprueba si hay un mensaje,lo muestra y lo borra
$mensaje_error = '';
if (isset($_SESSION['message'])) {
    $mensaje_error = $_SESSION['message'];
    unset($_SESSION['message']);
}

// Si usuario no esta activo, cierra la sesion y redirigea a login
if (isset($_SESSION['loggedin']) && ($_SESSION['activo'] == 0)) {
    session_destroy();
    header("Location: /view/login.php");
    exit();
}

//Permite administrador
function minAdministrador()
{
    if ($_SESSION['rol'] != 1) {
        $_SESSION['message'] = "Rol sin acceso!";
        header("Location: /view/login.php");
        exit();
    }
}

//Permite administrador y empleado
function minEmpleado()
{
    if (($_SESSION['rol'] != 1) && ($_SESSION['rol'] != 2)) {
        $_SESSION['message'] = "Rol sin acceso!";
        header("Location: /view/login.php");
        exit();
    }
}

//Permite administrador, empleado y usuario
function minUsuario()
{
    if (($_SESSION['rol'] != 1) && ($_SESSION['rol'] != 2) && ($_SESSION['rol'] != 3)) {
        $_SESSION['message'] = "Rol sin acceso!";
        header("Location: /view/login.php");
        exit();
    }
}
