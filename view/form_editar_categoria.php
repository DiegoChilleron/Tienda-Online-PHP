<?php
$title = ("Modificar categoria");
include("header.php");
include("../model/actualizar_categoria.php")
?>

<body class="container-fluid bg-body-secondary">
    <main class="row justify-content-around align-items-center">
        <div class="col-12 col-md-4 text-center p-2">
            <div class="h2"> <?php echo $mensaje_error; ?></div>
            <h1>Editar categoria</h1>
        </div>
        <form class="bg-white col-12 col-md-6 border mt-5 mb-5 p-4" method="post" action="/controller/modificar_categoria.php" name="f1">
            <label for="codigo" class="form-label">Código:*</label><br>
            <input type="number" class="form-control form-control-sm rounded-0" maxlength="2" size="20" id="codigo" name="codigo" value="<?php echo isset($codigo) ? $codigo : '' ?>" required><br>

            <label for="nombre" class="form-label">Nombre de la categoría:*</label><br>
            <input type="text" class="form-control form-control-sm rounded-0" maxlength="50" size="80" id="nombre" name="nombre" value="<?php echo isset($nombre) ? $nombre : '' ?>" required><br>

            <div class="row">
                <div class="col">

                    <label for="cat_padre" class="form-label">Categoría padre:*</label><br>
                    <select name="cat_padre" id="cat_padre" class="rounded-0" required>
                        <?php foreach ($categorias as $categoria) : ?>
                            <option value="<?= $categoria['codigo'] ?>"><?= $categoria['nombre'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col">

                    <label for="activo" class="form-label ">Estado:*</label><br>
                    <select id="activo" name="activo" class="form-select form-select-sm rounded-0" aria-label=".form-select-sm example" value="<?php echo isset($activo) ? $activo : '' ?>" required>
                        <option selected>-- Selecciona un estado --</option>
                        <option value="0" <?php if ($activo == 0) echo "selected"; ?>>Desactivada</option>
                        <option value="1" <?php if ($activo == 1) echo "selected"; ?>>Activada</option>
                    </select>
                </div>
            </div>

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