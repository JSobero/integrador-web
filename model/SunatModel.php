<?php
require_once "../connection/conexion.php";

class SunatModel {
    public function obtenerRucPorDni($dni) {
        global $conexion;
        $dni = $conexion->real_escape_string($dni);
        $sql = "SELECT * FROM sunat WHERE dni = '$dni'";
        $resultado = $conexion->query($sql);
        return $resultado->fetch_assoc();
    }
}
?>
