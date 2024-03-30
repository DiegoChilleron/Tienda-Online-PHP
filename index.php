<?php

include("controller/conectar_bd.php");
$title = "La Tienda de Diego";
session_start();

include("view/header.php");
include("model/paginacion.php");

// Comprueba si hay un mensaje,lo muestra y lo borra
$mensaje_error = '';
if (isset($_SESSION['message'])) {
  $mensaje_error = $_SESSION['message'];
  unset($_SESSION['message']);
}
?>

<body class="container-fluid">
  <div class="row">

    <?php include("view/aside_categorias.php"); ?>

    <main class="col-12 col-md-8 p-0 m-0">

      <section class="col-12 ">

        <article id="slide" class="carousel slide pb-5" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="/public/img/slide.webp" class="d-block w-100" alt="pixel">
            </div>
            <div class="carousel-item">
              <img src="/public/img/slide2.webp" class="d-block w-100" alt="iphone">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </article>
      </section>

      <section class="col-12 row justify-content-around p-0 m-0">
        <div class="h2"> <?php echo $mensaje_error; ?></div>
        <?php while ($producto = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
          <article class="card col-5 col-md-3 border-0">
            <a href="view/producto.php/?id=<?= $producto['producto_id'] ?>">
              <img class="card-img-top img-fluid" src="/public/img_productos/<?= $producto['img'] ?>" alt="<?= $producto['nombre'] ?>">
              <div class="card-body text-body">
                <p class="card-text fs-5"><?= $producto['nombre'] ?></p>
                <p class="card-text text-decoration-line-through"><?= $producto['precio_recomendado'] ?> € </p>
                <p class="card-text"><?= $producto['precio'] ?> € </p>

              </div>
            </a>
          </article>
        <?php
        }
        ?>
        <article id="paginacion">
          <?php
          if ($total_paginas > 1) {
            echo '<nav aria-label="Page navigation example">';
            echo '<ul class="pagination justify-content-center">';

            for ($i = 1; $i <= $total_paginas; $i++) {
              if ($pagina == $i) {
                echo '<li class="page-item active"><a class="page-link btn-color-primary" href="#">' . $pagina . '</a></li>';
              } else {
                echo '<li class="page-item"><a class="page-link" href="index.php?cat_padre=' . $categoria . '&cat=' . $categoria . '&pag=' . $i . '">' . $i . '</a></li>';
              }
            }

            echo '</ul>';
            echo '</nav>';
          }
          ?>
        </article>

        <div class="pb-5 pt-5" id="datos_paginacion">
          <p> Página <?= $pagina ?> de <?= $total_paginas ?> </br>
            Total de productos: <?= $num_total_registros ?></p>
        </div>

      </section>
    </main>
    <aside class="col-12 col-md-2 p-4">
      <?php

      // Comprueba si ya estas logueado y redirige
      if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == TRUE) {
        echo '<div class="row justify-content-end">';
        echo 'Ya estas logueado, </br>' . $_SESSION["usuario"] . '</br>';
        echo '<a href="/controller/logout.php" type="button" class="col-12 col-md-8 btn btn-secondary mt-2 mb-2 rounded-0">Cerrar Sesión</a>';
        if ($_SESSION['rol'] == 1) {
          // Rol administrador 
          echo '<a href="/view/panel_administrador.php" type="button" class="col-12 col-md-8 btn btn-secondary mb-2 rounded-0">Ir al Panel de Administrador</a>';
          echo '<a href="/view/perfil.php?id=' . $_SESSION["usuario"] . '" type="button" class="col-12 col-md-8 btn btn-secondary mb-2 rounded-0">Ir a tu Perfil</a>';
          echo '</div>';
        } else if ($_SESSION['rol'] == 2) {
            // Rol empleado
          echo '<a href="/view/panel_administrador.php" type="button" class="col-12 col-md-8 btn btn-secondary mb-2 rounded-0">Ir al Panel de Empleado</a>';
          echo '<a href="/view/perfil.php?id=' . $_SESSION["usuario"] . '" type="button" class="col-12 col-md-8 btn btn-secondary mb-2 rounded-0">Ir a tu Perfil</a>';
          echo '</div>';
        } else {
          // Rol usuario
          echo '<a href="/view/perfil.php?id=' . $_SESSION["usuario"] . '" type="button" class="col-12 col-md-8 btn btn-secondary mb-2 rounded-0">Ir a tu Perfil</a>';
          echo '</div>';
        }
      } else {
        include("model/form_registro.php");
      }
      ?>

    </aside>
  </div>
  <?php
  include("view/footer.php");
  ?>

</body>

</html>