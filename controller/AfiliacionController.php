<?php
require_once "../model/AfiliacionModel.php";

class AfiliacionController {
    public function obtenerDatos($dni) {
        $modelo = new AfiliacionModel();
        return $modelo->obtenerAfiliacionesPorDNI($dni);
    }
}
