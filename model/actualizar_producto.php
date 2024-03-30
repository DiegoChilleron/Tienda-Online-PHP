<?php
//Modificar usuario - Introduccion y validacion de los datos del usuario en el formulario de modificacion

include("../controller/conectar_bd.php");
include("../controller/sesiones.php");
minEmpleado();

// Comprueba cual es el producto a mostrar
if (isset($_GET['id'])) {
    $producto_id = $_REQUEST['id'];

    try {
        $stmt = $con->prepare('SELECT * FROM productos WHERE producto_id = ?');
        $stmt->execute([$producto_id]);
        $producto = $stmt->fetch(PDO::FETCH_ASSOC);


        $producto_id = $producto['producto_id'];
        $nombre = $producto['nombre'];
        $descripcion = $producto['descripcion'];
        $precio = $producto['precio'];
        $precio_recomendado = $producto['precio_recomendado'];
        $cantidad = $producto['cantidad'];
        $imagen = $producto['img'];
        $categoria = $producto['categoria'];
        $fecha_producto = $producto['fecha_producto'];

        $stmt = $con->prepare("SELECT codigo, nombre FROM categorias WHERE cat_padre !=0");
        $stmt->execute();
        $subcategorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        exit('Error al conectar con la base de datos: ' . $e->getMessage());
    }
}
