<?php
// Autentificación del login de usuario y clave de un usuario ya registrado

include("conectar_bd.php");
session_start();

// Comprueba si hay usuario y clave
if (!isset($_POST['usuario'], $_POST['clave'])) {
    exit('¡Por favor complete los campos de usuario y clave!');
}

try {
    // Realiza la consulta
    $stmt = $con->prepare('SELECT dni, usuario, clave, rol, activo FROM usuarios WHERE usuario = ?');
    $stmt->execute([$_POST['usuario']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Si la cuenta existe, ahora se verifica la clave con cifrado
        if (password_verify($_POST['clave'], $user['clave'])) {

            // Comprueba si el usuario esta activo
            if ($user['activo'] == 0) {
                header("Location: /view/reactivar_cuenta.php?id={$user['dni']}");
                exit();
            }

            // Crea la sesión
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['usuario'] = $user['usuario'];
            $_SESSION['dni'] = $user['dni'];
            $_SESSION['rol'] = $user['rol'];
            $_SESSION['activo'] = $user['activo'];

            // Comprueba si ya estas logeado y redirige
            if (!empty($_SESSION['carrito'])) {
                header('location: /view/form_de_envio.php');
                exit;
            }

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
        } else {
            $_SESSION['message'] = '<p class="h3 text-center">El usuario o contraseña son incorrectos</p>';
            header("Location: /view/login.php");
            exit();
        }
    } else {
        $_SESSION['message'] = '<p class="h3 text-center">El usuario o contraseña son incorrectos</p>';
        header("Location: /view/login.php");
        exit();
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
