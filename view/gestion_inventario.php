<?=
include("../model/consultas.php");
include("../controller/sesiones.php");
minEmpleado();
$stmt = ordenar_productos($con, $order);

$title = "Consultas";
include("header.php");
?>

<body class="container-fluid bg-body-secondary">
    <main class="row d-flex justify-content-center pb-5 pt-5 ">
        <article class="bg-white mb-3 col-11 rounded-0 p-4">
            <div class="col-12 text-end ">
                <a href="../controller/logout.php"><button type="button" class="btn btn-secondary rounded-0 mb-4">Cerrar Sesión</button></a>
            </div>
            <div class="h2 text-center"><?php echo $mensaje_error; ?></div>
            <h1 class="h1 text-center pb-4">GESTIÓN DE PRODUCTOS</h1>
            <div class="table-responsive">
                <table class="table table-bordered pb-4">
                    <tr class="text-center ">
                        <td class="bg-warning">Id de Producto</td>
                        <td class="bg-warning">Nombre</td>
                        <td class="bg-warning">Precio</td>
                        <td class="bg-warning">Precio recomendado</td>
                        <td class="bg-warning">Cantidad Stock</td>
                        <td class="bg-warning">Imagen</td>
                        <td class="bg-warning">Categoria</td>
                        <td class="bg-warning">Subcategoria</td>
                        <td class="bg-warning">Fecha añadido</td>
                        <td class="bg-warning">Enlace</td>
                        <td class="bg-warning">Editar</td>
                        <td class="bg-warning">Borrar</td>

                        <?php
                        while ($fila = $stmt->fetch()) {
                            echo "<tr>";
                            echo "<td>{$fila["producto_id"]}</td>";
                            echo "<td>{$fila["nombre"]}</td>";
                            echo "<td>{$fila["precio"]}</td>";
                            echo "<td>{$fila["precio_recomendado"]}</td>";
                            echo "<td>{$fila["cantidad"]}</td>";
                            echo '<td><a href="../public/img_productos/' . $fila["img"] . '">' . $fila["img"] . '</a></td>';
                            echo "<td>{$fila["nombre_categoria"]}</td>";
                            echo "<td>{$fila["nombre_subcategoria"]}</td>";
                            echo "<td>{$fila["fecha_producto"]}</td>";
                            echo '<td><a href="producto.php/?id=' . $fila["0"] . '">Ir al Producto</a></td>';
                            echo "<td><a href='form_editar_producto.php?id=" . $fila["0"] . "'><img src='/public/img/edit.svg' width='20' height='20' alt='Imagen de editar'/></a></td>";
                            echo "<td><a href='conf_borrar_producto.php?id=" . $fila["0"] . "'><img src='/public/img/delete.svg' width='20' height='20' alt='Imagen de eliminar'/> </a></td>";
                            echo "</tr>";
                        }
                        ?>

                </table>
            </div>
            <div class="text-center p-2">

                <a href="/view/panel_administrador.php" class="col-10 col-md-1 btn btn-color-primary m-2 rounded-0">Volver</a>
                <a href="form_registro_producto.php">
                    <button type="button" class="col-10 col-md-2 btn btn-color-primary rounded-0 m-2">Nuevo producto</button>
                </a>

                <a href="?order=<?php echo $order == 'asc' ? 'desc' : 'asc'; ?>">
                    <button type="button" class="col-10 col-md-2 btn btn-color-primary rounded-0 m-2">Ordenar por nombre</button>
                </a>
            </div>
            </div>
        </article>
    </main>
    <?php
    include("footer.php");
    ?>
</body>

</html>