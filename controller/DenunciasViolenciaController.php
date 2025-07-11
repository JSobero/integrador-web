<?php
require_once "../model/DenunciasViolenciaModel.php";

class DenunciasViolenciaController {
    public function obtenerDatos($dni) {
        $modelo = new DenunciasViolenciaModel();
        return $modelo->obtenerDenunciasPorDni($dni);
    }
}
