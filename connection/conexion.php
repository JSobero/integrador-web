<?php
$host = "localhost:3307";
$usuario = "root";
$contrasena = "";
$base_datos = "dni_sistema";

$conexion = new mysqli($host, $usuario, $contrasena, $base_datos);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>
