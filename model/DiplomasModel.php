<?php
require_once "../connection/conexion.php";

class DiplomasModel {
    public function obtenerTitulosPorDNI($dni) {
        global $conexion;
        $dni = $conexion->real_escape_string($dni);
        $sql = "SELECT * FROM diplomas_y_titulos WHERE dni = '$dni'";
        $result = $conexion->query($sql);

        $datos = [];
        while ($row = $result->fetch_assoc()) {
            $datos[] = $row;
        }
        return $datos;
    }
}
?>
