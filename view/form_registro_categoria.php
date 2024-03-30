<?php
$title = ("Añadir categoria");
include("header.php");
include("../controller/conectar_bd.php");
include("../controller/sesiones.php");
minEmpleado();

$stmt = $con->prepare('SELECT MAX(codigo) AS max_codigo FROM categorias');
$stmt->execute();
$categoria = $stmt->fetch(PDO::FETCH_ASSOC);
$codigo = ($categoria['max_codigo'] + 1);


$stmt = $con->prepare("SELECT codigo, nombre FROM categorias WHERE cat_padre =0");
$stmt->execute();
$categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<body class="container-fluid bg-body-secondary">
    <main class="row justify-content-around align-items-center">
        <div class="col-12 col-md-4 text-center p-2">
            <div class="h2"> <?php echo $mensaje_error; ?></div>
            <h1>Añadir categoria</h1>
        </div>
        <form class="bg-white col-12 col-md-6 border mt-5 mb-5 p-4" method="post" action="/controller/introducir_categoria.php" name="f1">
            <label for="codigo" class="form-label">Código:*</label><br>
            <input type="number" class="form-control form-control-sm rounded-0" maxlength="2" size="20" id="codigo" name="codigo" value="<?php echo isset($codigo) ? $codigo : '' ?>" required><br>

            <label for="nombre" class="form-label">Nombre de la categoría:*</label><br>
            <input type="text" class="form-control form-control-sm rounded-0" maxlength="50" size="80" id="nombre" name="nombre" required><br>

            <label for="cat_padre" class="form-label">Categoría padre:*</label><br>
            <select name="cat_padre" id="cat_padre" class="rounded-0" required>
                <?php foreach ($categorias as $categoria) : ?>
                    <option value="<?= $categoria['codigo'] ?>"><?= $categoria['nombre'] ?></option>
                <?php endforeach; ?>
            </select>
            <p class="text-body-tertiary">*(Campo requerido)</p>
            <div class="row justify-content-center mt-2 mb-2">
                <input class="col-4 col-md-3 btn btn-color-primary m-2 rounded-0" name="Borrar" value="Vaciar campos" type="reset">
                <input class="col-4 col-md-3 btn btn-color-primary m-2 rounded-0" name="Enviar" value="Enviar datos" type="submit">
                <a href="/view/gestion_categorias.php" class="col-8 col-md-3 btn btn-color-primary m-2 rounded-0">Volver</a>
            </div>
        </form>
    </main>

    <?php
    include("footer.php");
    ?>
</body>

</html>