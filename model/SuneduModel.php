<?php
require_once "../connection/conexion.php";

class SuneduModel {
    public function obtenerDatosPorDni($dni) {
        global $conexion;
        $dni = $conexion->real_escape_string($dni);
        $sql = "SELECT * FROM sunedu WHERE dni = '$dni'";
        $resultado = $conexion->query($sql);
        return $resultado->fetch_assoc();
    }
}
?>
