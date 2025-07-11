<?php
require_once "../connection/conexion.php";

class ActividadesEconomicasModel {

    public function obtenerPorRuc($ruc) {
        global $conexion;
        $ruc = $conexion->real_escape_string($ruc);
        $sql = "SELECT * FROM actividades_economicas WHERE ruc = '$ruc'";
        $resultado = $conexion->query($sql);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }
}
?>
