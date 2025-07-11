<?php
require_once "../connection/conexion.php";

class SeguroMedicoModel {
    public function obtenerDatosPorDNI($dni) {
        global $conexion;
        $dni = $conexion->real_escape_string($dni);
        $sql = "SELECT * FROM seguro_medico WHERE dni = '$dni'";
        $resultado = $conexion->query($sql);
        return $resultado->fetch_assoc();
    }
}
