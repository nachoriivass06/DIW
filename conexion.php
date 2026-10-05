<?php

    $servidor = "localhost";
    $usuario = "root";
    $contrasena = "";
    $basedatos = "mi_bd";


    $conexion = new mysqli($servidor, $usuario , $contrasena, $basedatos) or die("ERROR DE CONEXION");



?>