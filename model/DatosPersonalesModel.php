<?php
require_once "../connection/conexion.php";

class DatosPersonalesModel {

    public function obtenerDatosPersonalesDirecto($dni) {
        global $conexion;
        $dni = $conexion->real_escape_string($dni);
        $sql = "SELECT * FROM personas WHERE dni = '$dni'";
        $resultado = $conexion->query($sql);
        return $resultado->fetch_assoc();
    }
}
?>