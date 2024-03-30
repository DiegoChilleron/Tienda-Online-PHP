<?php
include("../model/actualizar_producto.php");

$title = ("Editar producto");
include("header.php");

?>

<body class="container-fluid bg-body-secondary">
    <main class="row justify-content-around align-items-center">
        <div class="col-12 col-md-4 text-center p-2">
            <div class="h2"> <?php echo $mensaje_error; ?></div>
            <h1>Modificar producto</h1>
            <img class="pt-2 img-fluid" src="/public/img_productos/<?= $producto['img'] ?>" width="300" height="300" alt="<?= $producto['nombre'] ?>">
        </div>
        <form class="bg-white col-12 col-md-6 border mt-5 mb-5 p-4" method="post" action="/controller/modificar_producto.php?id=<?php echo isset($producto_id) ?>" enctype="multipart/form-data" name="f1">
            <label for="dni" class="form-label">ID de Producto:*</label><br>
            <input type="number" class="form-control form-control-sm rounded-0" maxlength="9" size="40" id="prodcuto_id" name="producto_id" value="<?php echo isset($producto_id) ? $producto_id : '' ?>" requiered><br>

            <label for="nombre" class="form-label">Nombre del Producto:*</label><br>
            <input type="text" class="form-control form-control-sm rounded-0" maxlength="50" size="50" id="nombre" name="nombre" value="<?php echo isset($nombre) ? $nombre : '' ?>" required><br>

            <label for="descripcion" class="form-label">Descripción:</label><br>
            <textarea class="form-control form-control-sm rounded-0" id="descripcion" name="descripcion" rows="4" cols="50" maxlength="500" required><?php echo isset($descripcion) ? $descripcion : '' ?></textarea><br>

            <label for="precio" class="form-label">Precio:*</label><br>
            <input type="number" class="form-control form-control-sm rounded-0" maxlength="50" size="80" id="precio" name="precio" value="<?php echo isset($precio) ? $precio : '' ?>" required><br>

            <div class="row">
                <div class="col">
                    <label for="precio_recomendado" class="form-label">Precio recomendado:</label><br>
                    <input type="number" class="form-control form-control-sm rounded-0" maxlength="30" size="50" id="precio_recomendado" name="precio_recomendado" value="<?php echo isset($precio_recomendado) ? $precio_recomendado : '' ?>"><br>
                </div>

                <div class="col">
                    <label for="cantidad" class="form-label">Cantidad en stock:*</label><br>
                    <input type="number" class="form-control form-control-sm rounded-0" maxlength="30" size="50" id="cantidad" name="cantidad" value="<?php echo isset($cantidad) ? $cantidad : '' ?>" required><br>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="categoria" class="form-label">Categoria:*</label><br>
                    <input type="text" class="form-control form-control-sm rounded-0" maxlength="50" size="50" id="categoria" name="categoria" value="<?php echo isset($categoria) ? $categoria : '' ?>" required><br>
                </div>

                <div class="col">
                    <label for="categoria" class="form-label">Subcategoria:*</label><br>
                    <select name="categoria" id="categoria" class="rounded-0" required>
                        <?php foreach ($subcategorias as $subcategoria) : ?>
                            <option value="<?= $subcategoria['codigo'] ?>"><?= $subcategoria['nombre'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="fecha_producto" class="form-label">fecha_producto:</label><br>
                    <input type="date" class="form-control form-control-sm rounded-0" maxlength="30" id="fecha_producto" name="fecha_producto" value="<?php echo isset($fecha_producto) ? $fecha_producto : '' ?>"><br>
                </div>
                <div class="col">
                    <label for="imagen" class="form-label">Imagen del producto:</label><br>
                    <input type="file" class="form-control form-control-sm rounded-0" id="imagen" name="imagen" value="<?php echo isset($imagen) ? $imagen : '' ?>" accept=".jpg, .jpeg, .png, .webp, .avif"><br>
                </div>
            </div>
            <p class="text-body-tertiary">*(Campo requerido)</p>
            <div class="row justify-content-center mt-2 mb-2">
                <input class="col-4 col-md-3 btn btn-color-primary m-2 rounded-0" name="Borrar" value="Vaciar campos" type="reset">
                <input class="col-4 col-md-3 btn btn-color-primary m-2 rounded-0" name="Enviar" value="Enviar datos" type="submit">
                <a href="/view/gestion_inventario.php" class="col-4 col-md-3 btn btn-color-primary m-2 rounded-0">Volver a la Gestión de Productos</a>
            </div>
        </form>
    </main>

    <?php
    include("footer.php");
    ?>
</body>

</html>