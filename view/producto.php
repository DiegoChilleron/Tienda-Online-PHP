<?php
include("../model/producto.php");
$title = "Producto";
include("header.php");

?>

<!-- Pagina de producto-->
<main class="container">
    <section class="row">
        <div class="col-lg-8 p-5">
            <img src="/public/img_productos/<?= $producto['img'] ?>" class="img-fluid" alt="<?= $producto['nombre'] ?>">
            <div>
                <h1 class="h4"><?= $producto['nombre'] ?></h1>
                <div class="h5"><?= $producto['precio'] ?> €<br>
                    <p class="text-decoration-line-through"><?= $producto['precio_recomendado'] ?> €</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 p-5">
            <form action="/view/carrito.php" method="post">
                <div class="mb-3">
                    <label for="cantidad" class="form-label">Cantidad</label>
                    <input type="number" class="form-control rounded-0" name="cantidad" value="1" min="1" max="<?= $producto['cantidad'] ?>" placeholder="cantidad" required>
                </div>
                <input type="hidden" name="producto_id" value="<?= $producto['producto_id'] ?>">
                <button type="submit" class="rounded-0 btn btn-color-primary">Añadir al Carrito</button>
            </form>
            <div class="mt-5">
                <p class=""><?= $producto['descripcion'] ?></p>
                <p class="text-end">Categoria: <?= $producto['nombre_categoria'] ?></br>
                    Subcategoria: <?= $producto['nombre_subcategoria'] ?></br>
                    ID: <?= $producto['producto_id'] ?>
                </p>
            </div>
        </div>
    </section>
    <section class="pb-4">
        <button type="button" class="btn btn-color-primary rounded-0" onclick="goBack()">Atrás</button>
    </section>
</main>

<?php
include("footer.php");
?>

</html>