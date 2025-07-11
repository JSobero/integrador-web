<?php
require_once "../model/RecordsPenalesModel.php";

class RecordsPenalesController {
    public function obtenerPorDni($dni) {
        $modelo = new RecordsPenalesModel();
        return $modelo->obtenerPorDni($dni);
    }
}
?>
