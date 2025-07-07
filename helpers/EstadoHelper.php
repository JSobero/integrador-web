<?php

class EstadoHelper {
    public static function badgeEstado($estado) {
        $estado = strtolower($estado ?? 'No disponible');
        $clase = in_array($estado, ['inactivo', 'no disponible']) ? 'bg-danger' : 'bg-success';
        return "<span class='badge $clase'>" . ucfirst($estado) . "</span>";
    }
}
