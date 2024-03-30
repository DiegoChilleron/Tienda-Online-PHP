<?=
include("../model/consultas.php");
include("../controller/sesiones.php");
minEmpleado();

$title = "Consultas";
include("header.php");
?>

<body class="container-fluid bg-body-secondary">
    <main class="row justify-content-center pb-5 pt-5 ">
        <div class="h2 text-center"> <?php echo $mensaje_error; ?></div>
        <section class="bg-white mb-3 col-12 rounded-0 p-4">
            <div class="col-12 text-end ">
                <a href="../controller/logout.php"><button type="button" class="btn btn-secondary rounded-0 mb-4">Cerrar Sesión</button></a>
            </div>
            <?php if ($_SESSION["rol"] === 1) {
                echo '<h1 class="h1 text-center pb-4">PANEL DE ADMINISTRADOR</h1>';
            } else if ($_SESSION["rol"] === 2) {
                echo '<h1 class="h1 text-center pb-4">PANEL DE EMPLEADO</h1>';
            } else {
                echo '<h1 class="h1 text-center pb-4">ROL NO PERMITIDO</h1>';
            } ?>
            <div class="row justify-content-around pt-4 pb-4">
                <button type="button" class="col-10 col-md-1 btn btn-color-primary rounded-0 m-2" onclick="goBack()">Atrás</button>
                <?php if ($_SESSION["rol"] === 1) {
                    echo '<a href="/view/estadisticas.php" type="button" class="col-10 col-md-1 btn btn-color-primary rounded-0 m-2">Estadisticas</a>';
                    echo '<a href="/view/gestion_usuarios.php" type="button" class="col-10 col-md-2 btn btn-color-primary rounded-0 m-2">Gestión de Usuarios</a>';
                }
                ?>
                <a href="/view/gestion_categorias.php" type="button" class="col-10 col-md-2 btn btn-color-primary rounded-0 m-2">Gestión de Categorías</a>
                <a href="/view/gestion_inventario.php" type="button" class="col-10 col-md-2 btn btn-color-primary rounded-0 m-2">Gestión de Productos</a>
                <a href="/view/gestion_pedidos.php" type="button" class="col-10 col-md-2 btn btn-color-primary rounded-0 m-2">Gestión de Pedidos</a>
                <a href="/view/perfil.php" type="button" class="col-10 col-md-1 btn btn-color-primary rounded-0 m-2">Mi Perfil</a>
            </div>
        </section>
    </main>
    <?php
    include("footer.php");
    ?>
</body>

</html>