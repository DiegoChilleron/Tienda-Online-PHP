<?php
//Consultas de usuarios en el panel de administrador

include("../controller/conectar_bd.php");

// Anade un parametro GET para el orden

$order = isset($_GET['order']) && $_GET['order'] == 'desc' ? 'desc' : 'asc';
$order = isset($_GET['order']) && $_GET['order'] == 'desc' ? 'desc' : 'asc';

// Hace la consulta SQL e incluye el orden (en usuarios)
function ordenar_usuarios($con, $order)
{
    $order = $order == 'asc' ? 'desc' : 'asc';
    $stmt = $con->prepare("SELECT * FROM usuarios ORDER BY nombre $order");
    $stmt->execute();
    return $stmt;
}

// Hace la consulta SQL e incluye el orden (en productos)
function ordenar_productos($con, $order)
{
    $order = $order == 'asc' ? 'desc' : 'asc';
    
    $stmt = $con->prepare("SELECT productos.*, 
                                  categorias.nombre AS nombre_subcategoria, 
                                  cat_padre.nombre AS nombre_categoria
                           FROM productos 
                           INNER JOIN categorias ON productos.categoria = categorias.codigo 
                           INNER JOIN categorias AS cat_padre ON categorias.cat_padre = cat_padre.codigo
                           ORDER BY productos.nombre $order");
    $stmt->execute();
    return $stmt;
}


// Hace la consulta SQL e incluye el orden (en pedidos)
function ordenar_pedidos($con, $order)
{
    $order = $order == 'asc' ? 'desc' : 'asc';
    $stmt = $con->prepare("SELECT * FROM pedidos ORDER BY numpedido $order");
    $stmt->execute();
    return $stmt;
}

// Hace la consulta SQL e incluye el orden (en categorias)
function ordenar_categorias($con, $order)
{
    $order = $order == 'asc' ? 'desc' : 'asc';
    $stmt = $con->prepare("SELECT * FROM categorias ORDER BY codigo $order");
    $stmt->execute();
    return $stmt;
}