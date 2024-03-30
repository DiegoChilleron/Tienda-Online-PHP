<?php

include("../model/login.php");

$title = "Inicio de Sesión";
include("header.php");
?>
<main class="row justify-content-center bg-secondary">
    <div class="col-12 col-sm-8 col-md-4 m-5 justify-content-center bg-white">
        <?php
        include("../model/form_registro.php")
        ?>
    </div>
</main>
<?php
include("footer.php");
?>
</body>

</html>