<?php

$stmt_cat = $con->prepare("SELECT * FROM categorias WHERE cat_padre = 0 AND activo = 1");
$stmt_cat->execute();
$categorias = $stmt_cat->fetchAll(PDO::FETCH_ASSOC);

?>

<aside class="accordion accordion-flush col-12 col-md-2 p-0 m-0" id="accordionFlushExample">
    <?php
    foreach ($categorias as $cat_padre) {

        echo '<div class="accordion-item border">';
        echo '<h2 class="accordion-header">';
        echo '<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse' . $cat_padre['codigo'] . '" aria-expanded="false" aria-controls="flush-collapse' . $cat_padre['codigo'] . '">';
        echo $cat_padre['nombre'];
        echo '</button>';
        echo '</h2>';
        echo '<div id="flush-collapse' . $cat_padre['codigo'] . '" class="accordion-collapse collapse fw-light" data-bs-parent="#accordionFlushExample">';
        echo '<div class="accordion-body"><a href="../index.php?cat_padre=' . $cat_padre['codigo'] . '">Ver Todo</a></div>';

        $stmt_subcat = $con->prepare("SELECT * FROM categorias WHERE cat_padre = :cat_padre");
        $stmt_subcat->bindParam(':cat_padre', $cat_padre['codigo']);
        $stmt_subcat->execute();
        $subcategorias = $stmt_subcat->fetchAll(PDO::FETCH_ASSOC);

        foreach ($subcategorias as $subcat) {
            echo '<div class="accordion-body"><a href="../index.php?cat=' . $subcat['codigo'] . '">' . $subcat['nombre'] . '</a></div>';
        }

        echo '</div>';
        echo '</div>';
    }
    ?>

</aside>