<?php

include("controller/conectar_bd.php");
session_start();

// Verifica si el usuario ha iniciado sesión; de lo contrario, redirige a la página de inicio de sesión
if (!isset($_SESSION['google_loggedin'])) {
    header('Location: view/login.php');
    exit;
}

//Obtener la cuenta de la base de datos
$stmt = $pdo->prepare('SELECT * FROM usuarios WHERE id = ?');
$stmt->execute([$_SESSION['google_id']]);
$account = $stmt->fetch(PDO::FETCH_ASSOC);
// Recuperar variables de sesión
$google_loggedin = $_SESSION['google_loggedin'];
$google_email = $account['email'];
$google_name = $account['name'];
$google_picture = $account['picture'];
?>
<?=
$title = "Mi Perfil";
include("header.php");
?>

<body>
    <div>
        <div>
            <img src="<?= $google_picture ?>" alt="<?= $google_name ?>" width="100" height="100">
        </div>
        <div>
            <div>
                <strong>Nombre</strong>
                <span><?= $google_name ?></span>
            </div>
            <div>
                <div>
                    <strong>Email</strong>
                    <span><?= $google_email ?></span>
                </div>

            </div>
            <a href="/controller/logout.php">Logout</a>
        </div>
        <?=
        include("footer.php");
        ?>
</body>

</html>