<?php
require_once "../model/ActividadesEconomicasModel.php";

class ActividadesEconomicasController {

    public function obtenerPorRuc($ruc) {
        $modelo = new ActividadesEconomicasModel();
        return $modelo->obtenerPorRuc($ruc);
    }
}
?>
