<?php

// productos para mostrar por categoria, subcategoria y paginacion

$PAGS = 8;
$pagina = 1;
$inicio = 0;

if (isset($_GET["pag"])) {
    $pagina = $_GET["pag"];
    $inicio = ($pagina - 1) * $PAGS;
}

$cat_padre = '';
$categoria = '';
$where = '';

if (isset($_GET["cat_padre"]) && $_GET["cat_padre"] != '') {
    $cat_padre = $_GET["cat_padre"];
    $where = " WHERE c.cat_padre = :cat_padre";
}

if (isset($_GET["cat"]) && $_GET["cat"] != '') {
    $categoria = $_GET["cat"];
    $where .= ($where == '' ? ' WHERE ' : ' AND ') . "p.categoria = :categoria";
}

$stmt = $con->prepare("SELECT p.* FROM productos p JOIN categorias c ON p.categoria = c.codigo" . $where);
if ($cat_padre != '') {
    $stmt->bindParam(':cat_padre', $cat_padre);
}
if ($categoria != '') {
    $stmt->bindParam(':categoria', $categoria);
}
$stmt->execute();

$num_total_registros = $stmt->rowCount();
$total_paginas = ceil($num_total_registros / $PAGS);

$stmt = $con->prepare("SELECT p.* FROM productos p JOIN categorias c ON p.categoria = c.codigo" . $where . " LIMIT " . $inicio . "," . $PAGS);
if ($cat_padre != '') {
    $stmt->bindParam(':cat_padre', $cat_padre);
}
if ($categoria != '') {
    $stmt->bindParam(':categoria', $categoria);
}
$stmt->execute();
