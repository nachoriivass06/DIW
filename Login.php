<?php

session_start();

include "conexion.php";

// Coordenada de referencia
$lat_referencia = 36.866340;
$lng_referencia = -6.178433;

$lat_usuario = $_POST['lat'];
$lng_usuario = $_POST['lng'];

function calcularDistancia($lat1, $lng1, $lat2, $lng2) {
    $radioTierra = 6371000;

    $lat1_rad = deg2rad($lat1);
    $lat2_rad = deg2rad($lat2);
    $deltaLat = deg2rad($lat2 - $lat1);
    $deltaLng = deg2rad($lng2 - $lng1);

    $a = sin($deltaLat / 2) * sin($deltaLat / 2) +
         cos($lat1_rad) * cos($lat2_rad) *
         sin($deltaLng / 2) * sin($deltaLng / 2);

    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    return $radioTierra * $c;
}

$distancia = calcularDistancia($lat_usuario, $lng_usuario, $lat_referencia, $lng_referencia);

if ($distancia > 50) {
    echo "No puedes iniciar sesión: estás demasiado lejos del lugar permitido.";
    exit;
}

if (!isset($_SESSION['intentos'])) {
    $_SESSION['intentos'] = 0;
}

if ($_SESSION['intentos'] >= 3) {
    echo "Has superado el numero de intentos";
    exit;
}

$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

$sql = "SELECT * FROM usuarios WHERE email = '$correo'";

$resultado = mysqli_query($conexion, $sql);

$usuario = mysqli_fetch_assoc($resultado);

if ($usuario && password_verify($contrasena, $usuario['contrasenaHASH'])) {

    $_SESSION['intentos'] = 0;

    echo "Sesion iniciada correctamente";
} else {

    $_SESSION['intentos']++;
    $intentosRestantes = 3 - $_SESSION['intentos'];

    if ($intentosRestantes > 0) {
        echo "Email o contraseñas incorrectas";
    } else {
        echo "Te has quedado sin intentos";
    }
}
?>