<?php

// Comprueba si hay un mensaje,lo muestra y lo borra
$mensaje_error = '';
if (isset($_SESSION['message'])) {
    $mensaje_error = $_SESSION['message'];
    unset($_SESSION['message']);
}

$sexo = "";

if (isset($_REQUEST['id'])) {
    $dni_a_consultar = $_REQUEST['id'];

    try {
        $stmt = $con->prepare('SELECT * FROM usuarios WHERE dni = ?');
        $stmt->execute([$dni_a_consultar]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $dni = $user['dni'];
        $nombre = $user['nombre'];
        $usuario = $user['usuario'];
        $apellidos = $user['apellidos'];
        $direccion = $user['direccion'];
        $localidad = $user['localidad'];
        $provincia = $user['provincia'];
        $pais = $user['pais'];
        $sexo = $user['sexo'];
        $telefono = $user['telefono'];
        $email = $user['email'];
        $rol = $user['rol'];
        $activo = $user['activo'];
    } catch (PDOException $e) {
        exit('Error al conectar con la base de datos: ' . $e->getMessage());
    }
} else {
    echo '<p class="h3 text-center">No se encontró el cliente. </p>';
}

?>