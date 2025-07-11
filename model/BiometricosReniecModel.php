<?php
require_once "../connection/conexion.php";

class BiometricosReniecModel {
    public function obtenerDatosBiometricos($dni) {
        global $conexion;
        $dni = $conexion->real_escape_string($dni);
        $sql = "SELECT * FROM biometricos_reniec WHERE dni = '$dni'";
        $resultado = $conexion->query($sql);
        return $resultado->fetch_assoc();
    }
}
