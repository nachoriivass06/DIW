<?php

session_start();

include "conexion.php";

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