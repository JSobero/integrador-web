<?php
require_once "../connection/conexion.php";

class ReniecModel {

    public function obtenerDatosReniecDirecto($dni) {
        global $conexion;
        $dni = $conexion->real_escape_string($dni);
        $sql = "SELECT * FROM personas WHERE dni = '$dni'";
        $resultado = $conexion->query($sql);
        return $resultado->fetch_assoc();
    }
}
?>