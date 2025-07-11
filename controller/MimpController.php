<?php
require_once "../model/MimpModel.php";

class MimpController {
    public function obtenerDatos($dni) {
        $modelo = new MimpModel();
        return $modelo->obtenerDatosMimpPorDNI($dni);
    }
}
?>
