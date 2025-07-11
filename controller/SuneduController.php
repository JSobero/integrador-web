<?php
require_once "../model/SuneduModel.php";

class SuneduController {
    public function obtenerDatos($dni) {
        $modelo = new SuneduModel();
        return $modelo->obtenerDatosPorDni($dni);
    }
}
?>
