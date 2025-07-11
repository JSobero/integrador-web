<?php
require_once "../connection/conexion.php";

class HistorialAcademicoModel {
    public function obtenerHistorialPorDNI($dni) {
        global $conexion;
        $dni = $conexion->real_escape_string($dni);
        $sql = "SELECT * FROM historial_academico WHERE dni = '$dni'";
        $result = $conexion->query($sql);

        $datos = [];
        while ($row = $result->fetch_assoc()) {
            $datos[] = $row;
        }
        return $datos;
    }
}
?>
