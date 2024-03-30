<?php
// Añadir un producto despues del "formulario de añadir producto"

include("conectar_bd.php");
session_start();

// Comprobación que ningún campo esté vacío y que todos los campos existan.
if (
    empty($_POST['producto_id']) || empty($_POST['nombre'])
    || empty($_POST['precio']) || empty($_POST['cantidad'])
    || empty($_POST['categoria'])

) {
    $_SESSION['message'] = '<p class="h3 text-center">Rellene todos los campos, por favor.</p>';
    header('Location: /view/form_registro_producto.php');
    exit;
}

// Validación de imagen
$atributos_imagen = getimagesize($_FILES['imagen']['tmp_name']);

if (
    ($atributos_imagen !== TRUE) || ($atributos_imagen[0] > 500)
    || ($atributos_imagen[1] > 500) || ($_FILES['imagen']['size'] > 3000000)
) {
    session_start();
    $_SESSION['message'] = '<p class="h3 text-center"> Error en la validacion de imagen. La imagen debe tener máx. 500x500px y 300kb </p>';
    header('Location: ../form_registro_producto.php');
    exit;
}

// Crea las variables de los datos pasados en POST
$producto_id = htmlspecialchars($_POST['producto_id']);
$nombre = htmlspecialchars($_POST['nombre']);
$descripcion = htmlspecialchars($_POST['descripcion']);
$precio = htmlspecialchars($_POST['precio']);
$precio_recomendado = htmlspecialchars($_POST['precio_recomendado']);
$cantidad = htmlspecialchars($_POST['cantidad']);
$nombre_archivo = $_FILES['imagen']['name'];
$categoria = htmlspecialchars($_POST['categoria']);
$fecha_producto = htmlspecialchars($_POST['fecha_producto']);

// Validaciones
$campos = array();

if ($producto_id == "") {
    array_push($campos, $_SESSION['message'] = '<p class="h3 text-center">Introduzca un ID de producto válido</p>');
    header('location: /view/form_registro_producto.php');
    exit;
}

if ($nombre == "") {
    array_push($campos, $_SESSION['message'] = '<p class="h3 text-center">Introduzca un nombre.</p>');
    header('location: /view/form_registro_producto.php');
    exit;
}

if (empty($descripcion)) {
    $descripcion = "";
}

if ($precio == "") {
    array_push($campos, $_SESSION['message'] = '<p class="h3 text-center">Introduce el precio.</p>');
    header('location: /view/form_registro_producto.php');
    exit;
}

if (empty($precio_recomendado)) {
    $precio_recomendado = $precio;
}

if ($cantidad == "") {
    array_push($campos, $_SESSION['message'] = '<p class="h3 text-center">Introduce una cantidad.</p>');
    header('location: /view/form_registro_producto.php');
    exit;
}

if (empty($nombre_archivo)) {
    $nombre_archivo = "producto_sin_foto.avif";
}

if ($categoria == "") {
    array_push($campos, $_SESSION['message'] = '<p class="h3 text-center">Introduce una categoria.</p>');
    header('location: /view/form_registro_producto.php');
    exit;
}

if (empty($fecha_producto)) {
    $fecha_producto = date('YmdHis');
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

// Verifica si el ID de producto ya existe
$stmt = $con->prepare("SELECT * FROM productos WHERE producto_id = :producto_id");
$stmt->bindParam(':producto_id', $producto_id);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    $_SESSION['message'] = '<p class="h3 text-center"> El ID de Producto ya existe </p>';
    header('Location:../view/form_registro_producto.php');
    exit;
}

// Guardar la imagen
if (!empty($_FILES['imagen'])) {
    $ruta = $_SERVER['DOCUMENT_ROOT'] . "/public/img_productos/" . $nombre_archivo;
    $temp = $_FILES['imagen']['tmp_name'];

    if (move_uploaded_file($temp, $ruta)) {
        $_SESSION['message'] = "<p>Imagen subida correctamente</p>";
    }
}

// Introduce el producto en la base de datos
$stmt = $con->prepare("INSERT INTO productos VALUES  ( :producto_id, :nombre, :descripcion, :precio, :precio_recomendado, :cantidad, :img, :categoria, :fecha_producto)");
$stmt->bindParam(':producto_id', $producto_id);
$stmt->bindParam(':nombre', $nombre);
$stmt->bindParam(':descripcion', $descripcion);
$stmt->bindParam(':precio', $precio);
$stmt->bindParam(':precio_recomendado', $precio_recomendado);
$stmt->bindParam(':cantidad', $cantidad);
$stmt->bindParam(':img', $nombre_archivo);
$stmt->bindParam(':categoria', $categoria);
$stmt->bindParam(':fecha_producto', $fecha_producto);
$stmt->execute();

// Comprueba si no hay errores
$error = $stmt->errorInfo();
if (!empty($error[2])) {
    session_start();
    $_SESSION['message'] = '<p class="h3 text-center"> Ha habido un error {$error[2]}  </p>';
    header('Location: /view/form_registro_producto.php');
    exit;
} else {
    $_SESSION['message'] = '<p class="h3 text-center"> Producto añadido correctamente! </p>';
    header('location: /view/gestion_inventario.php');
    exit;
}

?>