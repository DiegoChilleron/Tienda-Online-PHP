<?php
include("../controller/conectar_bd.php");
session_start();

$title = "Pedido";
include("../view/header.php");
?>

<div class="p-5 d-inline-block">
    <h1>Tú pedido se ha completado !!</h1>
    <p>¡Gracias por realizar tu pedido con nosotros! Recibirá un correo electrónico con los detalles de su pedido.</p>
    <a href="/index.php" class="col-3 btn btn-color-primary m-2 rounded-0">Volver a Inicio</a>
</div>

<?php
include("../view/footer.php");
?>