<?php
require_once "../model/DatosPersonalesModel.php";

class DatosPersonalesController {
    public function obtenerDatos($dni) {
        $modelo = new DatosPersonalesModel();
        return $modelo->obtenerDatosPersonalesDirecto($dni);
    }
}
?>
