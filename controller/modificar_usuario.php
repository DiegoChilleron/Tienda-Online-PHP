<?php
// Editar un usuario despues del "formulario de editar usuario"

include("conectar_bd.php");
session_start();

// Comprobación que ningún campo esté vacío y que todos los campos existan.
if (
	empty($_POST['dni']) || empty($_POST['usuario'])
	|| empty($_POST['nombre']) || empty($_POST['apellidos'])
	|| empty($_POST['direccion']) || empty($_POST['localidad'])
	|| empty($_POST['provincia']) || empty($_POST['pais'])
	|| empty($_POST['email']) || empty($_POST['rol'])
	|| empty($_POST['activo'])
) {
	$_SESSION['message'] = '<p class="h3 text-center">Rellene todos los campos, por favor.</p>';
	header('Location: /view/form_editar_usuario.php');
	exit;
}

// Crea las variables de los datos pasados en POST
$dni = htmlspecialchars($_POST['dni']);
$usuario = htmlspecialchars($_POST['usuario']);
$nombre = htmlspecialchars($_POST['nombre']);
$apellidos = htmlspecialchars($_POST['apellidos']);
$direccion = htmlspecialchars($_POST['direccion']);
$localidad = htmlspecialchars($_POST['localidad']);
$provincia = htmlspecialchars($_POST['provincia']);
$pais = htmlspecialchars($_POST['pais']);
$sexo = htmlspecialchars($_POST['sexo']);
$telefono = htmlspecialchars($_POST['telefono']);
$email = htmlspecialchars($_POST['email']);
$rol = htmlspecialchars($_POST['rol']);
$activo = htmlspecialchars($_POST['activo']);

// Mensajes de validacion
$campos = array();

if ($dni == "" || !preg_match("/^[0-9]{8}[A-Za-z]$/", $dni)) {
	array_push($campos, $_SESSION['message'] = '<p class="h3 text-center">Introduzca un DNI válido</p>');
	header('location: /view/form_editar_usuario.php');
	exit;
} else {
	$numeros = substr($dni, 0, -1);
	$letra = strtoupper(substr($dni, -1));
	$letras_validas = "TRWAGMYFPDXBNJZSQVHLCKE";
	$letra_calculada = $letras_validas[$numeros % 23];

	if ($letra != $letra_calculada) {
		array_push($campos, $_SESSION['message'] = '<p class="h3 text-center">La letra del DNI no es válida</p>');
		header('location: /view/form_editar_usuario.php');
		exit;
	}
}

if ($usuario == "") {
	array_push($campos, $_SESSION['message'] = '<p class="h3 text-center">Introduce un nombre de usuario.</p>');
	header('location: /view/form_editar_usuario.php');
	exit;
}

if ($nombre == "") {
	array_push($campos, $_SESSION['message'] = '<p class="h3 text-center">Introduzca un nombre.</p>');
	header('location: /view/form_editar_usuario.php');
	exit;
}

if ($apellidos == "") {
	array_push($campos, $_SESSION['message'] = '<p class="h3 text-center">Introduzca los apellidos.</p>');
	header('location: /view/form_editar_usuario.php');
	exit;
}

if ($direccion == "") {
	array_push($campos, $_SESSION['message'] = '<p class="h3 text-center">Introduce una dirección.</p>');
	header('location: /view/form_editar_usuario.php');
	exit;
}

if ($localidad == "") {
	array_push($campos, $_SESSION['message'] = '<p class="h3 text-center">Introduce una localidad.</p>');
	header('location: /view/form_editar_usuario.php');
	exit;
}

if ($provincia == "") {
	array_push($campos, $_SESSION['message'] = '<p class="h3 text-center">Introduce una provincia.</p>');
	header('location: /view/form_editar_usuario.php');
	exit;
}

if ($pais == "") {
	array_push($campos, $_SESSION['message'] = '<p class="h3 text-center">Selecciona un país de origen.</p>');
	header('location: /view/form_editar_usuario.php');
	exit;
}

if ($telefono == "" || !preg_match("/^[0-9]{6,9}$/", $telefono)) {
	array_push($campos, $_SESSION['message'] = '<p class="h3 text-center">Introduzca un telefono válido</p>');
	header('location: /view/form_registro_usuario.php');
	exit;
}

if (empty($sexo)) {
	$sexo = "";
}

if (empty($email)) {
	$email = "";
}

if ($email == "" || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
	array_push($campos, $_SESSION['message'] = '<p class="h3 text-center">Introduce un correo electrónico válido.</p>');
	header('location: /view/form_editar_usuario.php');
	exit;
}

if ($rol == "") {
	array_push($campos, $_SESSION['message'] = '<p class="h3 text-center">Selecciona un rol.</p>');
	header('location: /view/form_editar_usuario.php');
	exit;
}

if ($activo == "") {
	array_push($campos, $_SESSION['message'] = '<p class="h3 text-center">Selecciona un estado.</p>');
	header('location: /view/form_editar_usuario.php');
	exit;
}

if (count($campos) > 0) {
	echo "<div class='error'>";
	for ($i = 0; $i < count($campos); $i++) {
		echo "<li>" . $campos[$i] . "</li>";
	}
}

// Con esta sentencia insertaremos los datos en la base de datos
$stmt = $con->prepare("UPDATE usuarios SET dni = :dni, usuario = :usuario, nombre = :nombre, apellidos = :apellidos, direccion = :direccion, localidad = :localidad, provincia = :provincia, pais = :pais, sexo = :sexo, telefono = :telefono, email = :email, rol = :rol, activo = :activo WHERE dni = :dni");
$stmt->bindParam(':dni', $dni);
$stmt->bindParam(':usuario', $usuario);
$stmt->bindParam(':nombre', $nombre);
$stmt->bindParam(':apellidos', $apellidos);
$stmt->bindParam(':direccion', $direccion);
$stmt->bindParam(':localidad', $localidad);
$stmt->bindParam(':provincia', $provincia);
$stmt->bindParam(':pais', $pais);
$stmt->bindParam(':sexo', $sexo);
$stmt->bindParam(':telefono', $telefono);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':rol', $rol);
$stmt->bindParam(':activo', $activo);
$stmt->execute();

// Comprueba si no hay errores
$error = $stmt->errorInfo();
if (!empty($error[2])) {
	$_SESSION['message'] = '<p class="h3 text-center"> Ha habido un error {$error[2]}  </p>';
	header('Location: /view/form_editar_usuario.php');
	exit;
} else {
	$_SESSION['message'] = '<p class="h3 text-center"> Usuario modificado correctamente! </p>';
}

// Rol administrador o empleado
if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {
	header('location: /view/panel_administrador.php');
	// Rol usuario
} else {
	header("location: /view/perfil.php?id={$_SESSION['dni']}");
}

?>