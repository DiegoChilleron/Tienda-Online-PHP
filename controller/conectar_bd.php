<?php
// Conexión a la base de datos

define("USER_DB", "diegochilleron");
define("PASSWORD", "tiendaphp");
try {
    $dsn = "mysql:host=localhost;dbname=tienda_de_diego";
    $con = new PDO($dsn, USER_DB, PASSWORD);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}

?>