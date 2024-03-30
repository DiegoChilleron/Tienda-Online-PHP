<?php
// Reactivar cuenta

include("conectar_bd.php");
session_start();

if (empty($_POST['dni'])) {
    $_SESSION['message'] = '<p class="h3 text-center"> Error </p>';
    header('Location: /view/reactivar_cuenta.php');
    exit;
}

// Crea las variables de los datos pasados en POST
$dni = htmlspecialchars($_POST['dni']);
$activo = 1;

// Con esta sentencia insertaremos los datos en la base de datos
$stmt = $con->prepare("UPDATE usuarios SET activo = :activo WHERE dni = :dni");
$stmt->bindParam(':activo', $activo);
$stmt->bindParam(':dni', $dni);
$stmt->execute();

//Comprobar errores
$error = $stmt->errorInfo();
if (!empty($error[2])) {
    $_SESSION['message'] = '<p class="h3 text-center"> Ha habido un error {$error[2]}  </p>';
    header('Location: /view/reactivar_cuenta.php');
    exit;
}

// Ejecuta la consulta 
$stmt = $con->prepare('SELECT dni, usuario, clave, rol, activo FROM usuarios WHERE dni = ?');
$stmt->execute([$_POST['dni']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Crea e Inicia sesión del usuario
session_regenerate_id();
$_SESSION['loggedin'] = TRUE;
$_SESSION['usuario'] = $user['usuario'];
$_SESSION['dni'] = $user['dni'];
$_SESSION['rol'] = $user['rol'];
$_SESSION['activo'] = $user['activo'];

$_SESSION['message'] = "<p> Usuario activado correctamente! </p>";

// Redirige
if (($user['rol'] == 1) || ($user['rol'] == 2)) {
    header('location: /view/panel_administrador.php');
    exit;
} else {
    header("location: /view/perfil.php?id={$dni}");
    exit;
}

?>