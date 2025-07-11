<?php
require_once "../model/ReniecModel.php";

class ReniecController {
    public function obtenerDatos($dni) {
        $modelo = new ReniecModel();
        return $modelo->obtenerDatosReniecDirecto($dni);
    }
}
?>
