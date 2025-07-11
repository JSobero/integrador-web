<?php
require_once "../model/SunatModel.php";

class SunatController {
    public function obtenerRucPorDni($dni) {
        $modelo = new SunatModel();
        return $modelo->obtenerRucPorDni($dni);
    }
}
?>
