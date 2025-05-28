<?php
class Operacion {
    public $tipo;
    public $cantidad;

    public function __construct($tipo, $cantidad) {
        $this->tipo = $tipo;
        $this->cantidad = $cantidad;
    }

    public function aplicar(&$saldo) {
        if ($this->tipo === 'ingreso') {
            $saldo += $this->cantidad;
        } elseif ($this->tipo === 'retirada') {
            $saldo -= $this->cantidad;
        }
        return $saldo;
    }
}
