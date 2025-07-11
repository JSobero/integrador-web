<?php
require_once "../connection/conexion.php";

class DenunciasViolenciaModel {
    public function obtenerDenunciasPorDni($dni) {
        global $conexion;
        $dni = $conexion->real_escape_string($dni);
        $sql = "SELECT * FROM denuncias_violencia WHERE dni = '$dni'";
        $resultado = $conexion->query($sql);
        $denuncias = [];

        while ($fila = $resultado->fetch_assoc()) {
            $denuncias[] = $fila;
        }

        return $denuncias;
    }
}
