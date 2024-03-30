<?php
$num_prods_en_carrito = isset($_SESSION['carrito']) ? count($_SESSION['carrito']) : "";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>
    <link rel="stylesheet" href="/public/css/bootstrap.min.purgecss.css"> <!-- Bootstrap -->
    <link rel="stylesheet" href="/public/css/styles.css">
    <script src="/public/js/btn_atras.js"></script>
    <link rel="icon" type="image/svg+xml" href="/public/img/logo.webp">
    <!-- Facebook,Twitter y WhatsApp Meta Tags -->
    <meta property="og:url" content="https://latiendadediego.site">
    <meta property="og:type" content="website">
    <meta property="og:title" content="La Tienda de Diego">
    <meta property="og:description" content="Tu tienda de móviles para aprobar PHP">
    <meta property="og:image" content="https://latiendadediego.site/public/img/metatag.jpg">

    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="latiendadediego.site">
    <meta property="twitter:url" content="https://latiendadediego.site">
    <meta name="twitter:title" content="La Tienda de Diego">
    <meta name="twitter:description" content="Tu tienda de móviles para aprobar PHP">
    <meta name="twitter:image" content="https://latiendadediego.site/public/img/metatag.jpg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Tu tienda de móviles para aprobar PHP">
    <meta name="author" content="Diego Chilleron">
    <meta name="theme-color" content="#ffa300">
    <meta name="apple-mobile-web-app-status-bar-style" content="#ffa300">
</head>

<header class="row bg-black">
    <!-- Navbar -->
    <nav class="navbar blur navbar-dark fixed-top navbar-expand-lg bg-black bg-opacity-50">
        <div class="container-fluid">
            <a href="/index.php" class="active" aria-current="page"><img src="/public/img/logo.webp" width="auto" height="40" alt="Logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link  text-light" href="#">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="#">Envios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="#footer">Quienes somos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="#footer">Contacto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="/view/login.php">Login/Registrarse</a>
                    </li>
                </ul>
                <!-- icono de carrito -->
                <div>
                    <a href="/view/carrito.php"><?php echo $num_prods_en_carrito ?>
                        <img src="/public/img/carrito.svg" width="40" height="40" alt="Carrito de compras">
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <a href="/index.php">
        <div class="pt-5 text-center background-header pb-0" id="inicio"> <img class=" col-6 col-md-3 img-fluid" src="/public/img/portada.webp" alt="Tienda de informatica">
    </a>
    </div>
</header>