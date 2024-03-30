<?=
include("../model/consultas.php");
include("../controller/sesiones.php");
minEmpleado();
$stmt = ordenar_categorias($con, $order);

$title = "Consultas";
include("header.php");
?>

<body class="container-fluid bg-body-secondary">
    <main class="row justify-content-center pb-5 pt-5 ">
        <article class="bg-white mb-3 col-11 table-responsive rounded-0 p-4">
            <div class="col-12 text-end ">
                <a href="../controller/logout.php"><button type="button" class="btn btn-secondary rounded-0 mb-4">Cerrar Sesión</button></a>
            </div>
            <div class="h2 text-center"><?php echo $mensaje_error; ?></div>
            <h1 class="h1 text-center pb-4">CATEGORIAS</h1>
            <table class="table table-bordered pb-4">
                <tr class="text-center">
                    <td class="bg-warning">Código</td>
                    <td class="bg-warning">Nombre</td>
                    <td class="bg-warning">Categoría Padre</td>
                    <td class="bg-warning">Activo</td>
                    <td class="bg-warning">Editar</td>
                    <td class="bg-warning">Desactivar</td>

                    <?php
                    while ($fila = $stmt->fetch()) {
                        echo "<tr>";
                        echo "<td>{$fila["codigo"]}</td>";
                        echo "<td>{$fila["nombre"]}</td>";
                        echo "<td>{$fila["cat_padre"]}</td>";
                        echo "<td>{$fila["activo"]}</td>";
                        echo "<td><a href='form_editar_categoria.php?id=" . $fila["0"] . "'><img src='/public/img/edit.svg' width='20' height='20' alt='Imagen de editar'/></a></td>";
                        echo "<td><a href='conf_borrar_categoria.php?id=" . $fila["0"] . "'><img src='/public/img/delete.svg' width='20' height='20' alt='Imagen de eliminar'/> </a></td>";
                        echo "</tr>";
                    }
                    ?>

            </table>
            <div class="text-center">
                <button type="button" class="col-10 col-md-1 btn btn-color-primary rounded-0 m-2" onclick="goBack()">Atrás</button>
                <a href="form_registro_categoria.php">
                    <button type="button" class="col-10 col-md-2 btn btn-color-primary rounded-0 m-2">Nueva categoría</button>
                </a>
                <a href="?order=<?php echo $order == 'asc' ? 'desc' : 'asc'; ?>">
                    <button type="button" class="col-10 col-md-2 btn btn-color-primary rounded-0 m-2">Ordenar por código</button>
                </a>
            </div>
        </article>
    </main>
    <?php
    include("footer.php");
    ?>
</body>

</html>