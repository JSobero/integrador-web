<?php
require_once "../model/BiometricosReniecModel.php";

class BiometricosReniecController {
    public function obtenerDatos($dni) {
        $modelo = new BiometricosReniecModel();
        return $modelo->obtenerDatosBiometricos($dni);
    }
}
