<?php
require_once "../model/SeguroMedicoModel.php";

class SeguroMedicoController {
    public function obtenerDatos($dni) {
        $modelo = new SeguroMedicoModel();
        return $modelo->obtenerDatosPorDNI($dni);
    }
}
