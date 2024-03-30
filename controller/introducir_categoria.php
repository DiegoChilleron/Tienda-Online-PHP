<?php
// Añadir un producto despues del "formulario de añadir producto"

include("conectar_bd.php");
session_start();

// Comprobación que ningún campo esté vacío y que todos los campos existan.
if (
    empty($_POST['codigo']) || empty($_POST['nombre']) || empty($_POST['cat_padre'])
) {
    $_SESSION['message'] = '<p class="h3 text-center">Rellene todos los campos, por favor.</p>';
    header('Location: /view/form_registro_categoria.php');
    exit;
}

// Crea las variables de los datos pasados en POST
$codigo = htmlspecialchars($_POST['codigo']);
$nombre = htmlspecialchars($_POST['nombre']);
$cat_padre = htmlspecialchars($_POST['cat_padre']);
$activo = 1;

// Mensajes de validacion
$campos = array();

if ($codigo == "") {
    array_push($campos, $_SESSION['message'] = '<p class="h3 text-center">Introduzca un codigo válido</p>');
    header('location: /view/form_registro_producto.php');
    exit;
}

if ($nombre == "") {
    array_push($campos, $_SESSION['message'] = '<p class="h3 text-center">Introduzca un nombre.</p>');
    header('location: /view/form_registro_producto.php');
    exit;
}


if ($cat_padre == "") {
    array_push($campos, $_SESSION['message'] = '<p class="h3 text-center">Introduzca una categoria padre.</p>');
    header('location: /view/form_registro_producto.php');
    exit;
}

if (count($campos) > 0) {
    echo "<div class='error'>";
    for ($i = 0; $i < count($campos); $i++) {
        echo "<li>" . $campos[$i] . "</li>";
    }
    echo "</div>";
} else {
    echo "<div class='correcto'>Datos correctos</div>";
}

// Verifica si el codigo de categoria ya existe
$stmt = $con->prepare("SELECT * FROM categorias WHERE codigo = :codigo");
$stmt->bindParam(':codigo', $codigo);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    $_SESSION['message'] = '<p class="h3 text-center"> El codigo de la categoria ya existe </p>';
    header('Location:../view/form_registro_categoria.php');
    exit;
}

// Introduce la categoria en la base de datos
$stmt = $con->prepare("INSERT INTO categorias VALUES  ( :codigo, :nombre, :cat_padre, :activo)");
$stmt->bindParam(':codigo', $codigo);
$stmt->bindParam(':nombre', $nombre);
$stmt->bindParam(':cat_padre', $cat_padre);
$stmt->bindParam(':activo', $activo);
$stmt->execute();

// Comprueba si no hay errores
$error = $stmt->errorInfo();
if (!empty($error[2])) {
    $_SESSION['message'] = '<p class="h3 text-center"> Ha habido un error {$error[2]}  </p>';
    header('Location: /view/form_registro_categoria.php');
    exit;
} else {
    $_SESSION['message'] = '<p class="h3 text-center"> Categoría añadida correctamente! </p>';
    header('location: /view/gestion_inventario.php');
    exit;
}

?>