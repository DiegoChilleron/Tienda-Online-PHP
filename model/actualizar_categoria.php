<?php

include("../controller/conectar_bd.php");
include("../controller/sesiones.php");
minEmpleado();

// Comprueba cual es la categoria a mostrar
if (isset($_GET['id'])) {
    $cat_codigo = $_REQUEST['id'];

    try {
        $stmt = $con->prepare('SELECT * FROM categorias WHERE codigo = ?');
        $stmt->execute([$cat_codigo]);
        $categoria = $stmt->fetch(PDO::FETCH_ASSOC);


        $codigo = $categoria['codigo'];
        $nombre = $categoria['nombre'];
        $cat_padre = $categoria['cat_padre'];
        $activo = $categoria['activo'];

        $stmt = $con->prepare("SELECT codigo, nombre FROM categorias WHERE cat_padre =0");
        $stmt->execute();
        $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    } catch (PDOException $e) {
        exit('Error al conectar con la base de datos: ' . $e->getMessage());
    }
}
