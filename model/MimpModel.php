<?php
require_once "../connection/conexion.php";

class MimpModel {
    public function obtenerDatosMimpPorDNI($dni) {
        global $conexion;
        $dni = $conexion->real_escape_string($dni);
        $sql = "SELECT * FROM mimp WHERE dni = '$dni'";
        $result = $conexion->query($sql);
        return $result->fetch_assoc();
    }
}
?>
