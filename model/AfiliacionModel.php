<?php
require_once "../connection/conexion.php";

class AfiliacionModel {
    public function obtenerAfiliacionesPorDNI($dni) {
        global $conexion;
        $dni = $conexion->real_escape_string($dni);
        $sql = "SELECT * FROM afiliacion_seguro_medico WHERE dni = '$dni'";
        $resultado = $conexion->query($sql);
        $afiliaciones = [];
        while ($fila = $resultado->fetch_assoc()) {
            $afiliaciones[] = $fila;
        }
        return $afiliaciones;
    }
}
