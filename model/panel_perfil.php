<?php
// Perfil del usuario - Muestra sus datos

include("../controller/conectar_bd.php");
include("../controller/sesiones.php");
minUsuario();

try {

	$stmt = $con->prepare('SELECT * FROM usuarios WHERE dni = ?');
	$stmt->execute([$_SESSION['dni']]);
	$user = $stmt->fetch(PDO::FETCH_ASSOC);
	$DNI = $user['dni'];
	$USR = $user['usuario'];
	$NOM = $user['nombre'];
	$APE = $user['apellidos'];
	$DIR = $user['direccion'];
	$LOC = $user['localidad'];
	$PRO = $user['provincia'];
	$PAI = $user['pais'];
	$SEX = $user['sexo'];
	$TEL = $user['telefono'];
	$MAIL = $user['email'];
	$ROL = $user['rol'];
	$ACT = $user['activo'];
} catch (PDOException $e) {
	exit('Error al conectar con la base de datos: ' . $e->getMessage());
}

switch ($ROL) {
	case 1:
		$ROL = 'Administrador';
		break;
	case 2:
		$ROL = 'Empleado';
		break;
	case 3:
		$ROL = 'Usuario';
		break;
	default:
		$ROL = 'Rol no definido';
		break;
}

switch ($ACT) {
	case 0:
		$ACT = 'Cuenta Desactivada';
		break;
	case 1:
		$ACT = 'Cuenta Activada';
		break;
	default:
		$ACT = 'Error en el estado de la cuenta';
		break;
}

// Mostrar pedidos del cliente

try {
	$stmt = $con->prepare('SELECT * FROM pedidos WHERE dnicuenta = ? ORDER BY numpedido');
	$stmt->execute([$_SESSION['dni']]);
	return $stmt;
} catch (PDOException $e) {
	exit('Error al conectar con la base de datos: ' . $e->getMessage());
}

?>