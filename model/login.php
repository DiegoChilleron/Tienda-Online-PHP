<?php
// Pagina de login

include("../controller/conectar_bd.php");
session_start();

// Comprueba si hay un mensaje,lo muestra y lo borra
$mensaje_error = '';
if (isset($_SESSION['message'])) {
    $mensaje_error = $_SESSION['message'];
    unset($_SESSION['message']);
}

// Verificacion de usuario, clave
if (isset($_POST['usuario'])) {
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];


    $campos = array();

    if ($usuario == "") {
        array_push($campos, "Introduzca un usuario");
    }

    if ($clave == "" || strlen($clave) < 6) {
        array_push($campos, "La contraseña no puede estar vacía, ni tener menos de 6 caracteres.");
    }

    if (count($campos) > 0) {
        echo "<div class='error'>";
        for ($i = 0; $i < count($campos); $i++) {
            echo "<li>" . $campos[$i] . "</i>";
        }
    } else {
        echo "<div class='correcto'>
                Datos correctos";
    }
    echo "</div>";
}

// Comprueba si ya estas logeado y redirige
if (isset($_SESSION['rol'])) {
    switch ($_SESSION['rol']) {
        case 1:
            header('location: /view/panel_administrador.php');
            break;
        case 2:
            header('location: /view/panel_administrador.php');
            break;
        case 3:
            header("location: /view/perfil.php?id={$_SESSION['dni']}");
            break;
        default:
            header('location: /index.php');
            break;
    }
}
