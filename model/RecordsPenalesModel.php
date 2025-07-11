<?php
require_once "../connection/conexion.php";

class RecordsPenalesModel {

    public function obtenerPorDni($dni) {
        global $conexion;
        $dni = $conexion->real_escape_string($dni);
        $sql = "SELECT * FROM records_penales WHERE dni = '$dni'";
        $resultado = $conexion->query($sql);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }
}
?>
