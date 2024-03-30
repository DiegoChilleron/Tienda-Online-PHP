<?php
include("../controller/conectar_bd.php");
session_start();

// Comprueba cual es el producto a mostrar
if (isset($_GET['id'])) {

    $stmt = $con->prepare('SELECT productos.*, 
    categorias.nombre AS nombre_subcategoria, 
    cat_padre.nombre AS nombre_categoria
    FROM productos 
    INNER JOIN categorias ON productos.categoria = categorias.codigo 
    INNER JOIN categorias AS cat_padre ON categorias.cat_padre = cat_padre.codigo
    WHERE producto_id = ?');
    $stmt->execute([$_GET['id']]);
    $producto = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$producto) {
        exit('<p class="h1 text-center">Ha habido un error. </br> El producto solicitado ya no existe.</p>');
    }
} else {

    exit('<p class="h1 text-center">Ha habido un error. </br> El producto solicitado ya no existe.</p>');
}
