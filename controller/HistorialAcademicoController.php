<?php
require_once "../model/HistorialAcademicoModel.php";

class HistorialAcademicoController {
    public function obtenerHistorial($dni) {
        $modelo = new HistorialAcademicoModel();
        return $modelo->obtenerHistorialPorDNI($dni);
    }
}
?>
