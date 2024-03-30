<?php
// Inicio de sesion con la cuenta de Google

include("conectar_bd.php");
session_start();

//Introducir las variables de tu cuenta
$google_oauth_client_id = '';
$google_oauth_client_secret = '';
$google_oauth_redirect_uri = '';
$google_oauth_version = 'v3';

// Si el parámetro del código capturado existe y es válido
if (isset($_GET['code']) && !empty($_GET['code'])) {
    // Ejecutar solicitud cURL para recuperar el token de acceso
    $params = [
        'code' => $_GET['code'],
        'client_id' => $google_oauth_client_id,
        'client_secret' => $google_oauth_client_secret,
        'redirect_uri' => $google_oauth_redirect_uri,
        'grant_type' => 'authorization_code'
    ];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://accounts.google.com/o/oauth2/token');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($response, true);

    if (isset($response['access_token']) && !empty($response['access_token'])) {
        // Ejecutar solicitud cURL para recuperar la información del usuario asociada con la cuenta de Google
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.googleapis.com/oauth2/' . $google_oauth_version . '/userinfo');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $response['access_token']]);
        $response = curl_exec($ch);
        curl_close($ch);
        $profile = json_decode($response, true);

        if (isset($profile['email'])) {
            $google_name_parts = [];
            $google_name_parts[] = isset($profile['given_name']) ? preg_replace('/[^a-zA-Z0-9]/s', '', $profile['given_name']) : '';
            $google_name_parts[] = isset($profile['family_name']) ? preg_replace('/[^a-zA-Z0-9]/s', '', $profile['family_name']) : '';
            // Comprueba los datos en la base de datos
            $stmt = $pdo->prepare('SELECT * FROM usuarios WHERE email = ?');
            $stmt->execute([$profile['email']]);
            $account = $stmt->fetch(PDO::FETCH_ASSOC);
            // Si la cuenta no existe en la base de datos, inserte la cuenta en la base de datos
            if (!$account) {
                //$stmt = $pdo->prepare('INSERT INTO usuarios_google (email, name, picture, registered, method) VALUES (?, ?, ?, ?, ?)');
               // $stmt->execute([$profile['email'], implode(' ', $google_name_parts), isset($profile['picture']) ? $profile['picture'] : '', date('Y-m-d H:i:s'), 'google']);
                //$id = $pdo->lastInsertId();
            } else {
                $id = $account['id'];
            }
            //Autenticar la cuenta
            session_regenerate_id();
            $_SESSION['google_loggedin'] = TRUE;
            $_SESSION['google_id'] = $id;
            // Redirigir a la página de perfil
            header('Location: view/perfil_google.php');
            exit;
        } else {
            exit('No se ha podido obtener los datos personales.');
        }
    } else {
        exit('Token de acceso incorrecto! Pruebe de nuevo!');
    }
} else {
    // Define parámetros y redirige a la página de autenticación de Google
    $params = [
        'response_type' => 'code',
        'client_id' => $google_oauth_client_id,
        'redirect_uri' => $google_oauth_redirect_uri,
        'scope' => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile',
        'access_type' => 'offline',
        'prompt' => 'consent'
    ];
    header('Location: https://accounts.google.com/o/oauth2/auth?' . http_build_query($params));
    exit;
}
?>