<?php
require_once "../model/DiplomasModel.php";

class DiplomasController {
    public function obtenerTitulos($dni) {
        $modelo = new DiplomasModel();
        return $modelo->obtenerTitulosPorDNI($dni);
    }
}
?>
