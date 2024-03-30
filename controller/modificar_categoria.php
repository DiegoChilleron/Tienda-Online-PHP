<?php
// Editar una categoria despues del "formulario de editar categoria"

include("conectar_bd.php");
session_start();

// Comprobación que ningún campo esté vacío y que todos los campos existan.
if (
	empty($_POST['codigo']) || empty($_POST['nombre']) || empty($_POST['activo'])
) {
	$_SESSION['message'] = '<p class="h3 text-center"> Introduzca todos los datos </p>';
	header('location: /view/form_editar_categoria.php');
	exit;
}

// Crea las variables de los datos pasados en POST
$codigo = htmlspecialchars($_POST['codigo']);
$nombre = htmlspecialchars($_POST['nombre']);
$cat_padre = htmlspecialchars($_POST['cat_padre']);
$activo = htmlspecialchars($_POST['activo']);

// Mensajes de validacion
$campos = array();

if ($codigo == "") {
	array_push($campos, $_SESSION['message'] = '<p class="h3 text-center">Introduzca un codigo de categoria válido</p>');
	header('location: /view/form_editar_categoria.php');
	exit;
}

if ($nombre == "") {
	array_push($campos, $_SESSION['message'] = '<p class="h3 text-center">Introduzca un nombre.</p>');
	header('location: /view/form_editar_categoria.php');
	exit;
}

if ($cat_padre == "") {
	$cat_padre = 0;
}

if ($activo == "") {
	array_push($campos, $_SESSION['message'] = '<p class="h3 text-center">Introduce un estado.</p>');
	header('location: /view/form_editar_categoria.php');
	exit;
}

if (count($campos) > 0) {
	echo "<div class='error'>";
	for ($i = 0; $i < count($campos); $i++) {
		echo "<li>" . $campos[$i] . "</li>";
	}
	echo "</div>";
} else {
	echo "<div class='correcto'>Datos correctos</div>";
}

// Actualiza el producto en la base de datos
$stmt = $con->prepare("UPDATE categorias SET codigo = :codigo, nombre = :nombre, cat_padre = :cat_padre, activo = :activo WHERE codigo = :codigo");
$stmt->bindParam(':codigo', $codigo);
$stmt->bindParam(':nombre', $nombre);
$stmt->bindParam(':cat_padre', $cat_padre);
$stmt->bindParam(':activo', $activo);
$stmt->execute();

// Comprueba si no hay errores
$error = $stmt->errorInfo();
if (!empty($error[2])) {
	$_SESSION['message'] = '<p class="h3 text-center"> Ha habido un error {$error[2]}  </p>';
	header('location: /view/form_editar_categoria.php');
	exit;
} else {
	$_SESSION['message'] = '<p class="h3 text-center">  Producto modificado correctamente! </p>';
	header('location: /view/gestion_categorias.php');
	exit;
}
