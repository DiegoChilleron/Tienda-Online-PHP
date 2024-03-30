<?php
// Modificar clave de usuario

include("conectar_bd.php");
session_start();

// Comprobación que ningún campo esté vacío y que todos los campos existan.
if (
    empty($_POST['dni']) || empty($_POST['usuario']) || empty($_POST['clave'])
) {
    $_SESSION['message'] = '<p class="h3 text-center"> No se han introducido todos los campos </p>';
    header('Location: ../view/form_recuperarcontrasena.php');
    exit;
}

// Crea las variables de los datos pasados en POST
$dni = htmlspecialchars($_POST['dni']);
$usuario = htmlspecialchars($_POST['usuario']);
$nuevaClave = htmlspecialchars($_POST['clave']);

// Ejecuta la orden
$stmt = $con->prepare('SELECT dni, usuario FROM usuarios WHERE dni = ?');
$stmt->execute([$_POST['dni']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (
    $dni !== $user['dni'] || $usuario !== $user['usuario']
) {
    $_SESSION['message'] = '<p class="h3 text-center"> DNI o usuario incorrecto </p>';
    header('Location: ../view/form_recuperarcontrasena.php');
    exit;
}

// Hashea la contraseña
$claveHash = password_hash($nuevaClave, PASSWORD_DEFAULT, ['cost' => 10]);


// Insertar los datos en la base de datos
$stmt = $con->prepare("UPDATE usuarios SET clave=:clave WHERE dni=:dni");
$stmt->bindParam(':clave', $claveHash);
$stmt->bindParam(':dni', $dni);
$stmt->execute();

// Comprueba si no hay errores
$error = $stmt->errorInfo();
if (!empty($error[2])) {
    $_SESSION['message'] = '<p class="h3 text-center"> Ha habido un error {$error[2]}  </p>';
    header('Location: ../view/form_recuperarcontrasena.php');
    exit;
} else {
    $_SESSION['message'] = '<p class="h3 text-center"> Contraseña modificada correctamente! </p>';
    header('Location: ../view/perfil.php');
    exit;
}

?>