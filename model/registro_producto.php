<?php
// Registro de un usuario nuevo atraves de login - Valida los datos

include("../controller/conectar_bd.php");
include("../controller/sesiones.php");
minEmpleado();

// Declarar e inicializar todas las variables
$producto_id = "";
$nombre = "";
$descripcion = "";
$precio = "";
$precio_recomendado = "";
$cantidad = "";
$img = "";
$categoria = "";
$subcategoria = "";
$fecha_producto = "";
$activo = "";


$stmt = $con->prepare("SELECT codigo, nombre FROM categorias WHERE cat_padre !=0");
$stmt->execute();
$subcategorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $con->prepare('SELECT MAX(producto_id) AS max_producto_id FROM productos');
$stmt->execute();
$productos = $stmt->fetch(PDO::FETCH_ASSOC);
$producto_id = ($productos['max_producto_id'] + 1);
