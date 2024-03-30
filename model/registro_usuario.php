<?php
// Registro de un usuario nuevo atraves de login - Valida los datos

include("../controller/conectar_bd.php");
session_start();

// Comprueba si hay un mensaje,lo muestra y lo borra
$mensaje_error = '';
if (isset($_SESSION['message'])) {
    $mensaje_error = $_SESSION['message'];
    unset($_SESSION['message']);
}

// Declarar e inicializar todas las variables
$dni = "";
$usuario = "";
$clave = "";
$nombre = "";
$apellidos = "";
$direccion = "";
$localidad = "";
$provincia = "";
$pais = "";
$sexo = "";
$telefono = "";
$email = "";
$rol = "";
$activo = "";

?>