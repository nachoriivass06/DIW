<?php

include "conexion.php";

$nombre = $_POST['nombre'];
$apellido1 = $_POST['apellido1'];
$apellido2 = $_POST['apellido2'];
$email = $_POST['email'];
$contrasena = $_POST['contrasena'];
$telefono = $_POST['telefono'];
$pais = $_POST['pais'];
$ciudad = $_POST['ciudad'];
$contrasenaHASH = password_hash($contrasena, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (nombre, apellido1, apellido2, email, telefono, pais, ciudad, `contrasenaHASH`)
        VALUES ('$nombre', '$apellido1', '$apellido2', '$email', '$telefono', '$pais', '$ciudad', '$contrasenaHASH')";

    
    if ( mysqli_query($conexion, $sql)){
        echo " Usuario Registrado correctamente";
    }else {
        echo "Error: " . mysqli_error($conexion) ;
    }
?>