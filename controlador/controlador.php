<?php
require_once __DIR__ . '/../modelo/operacion.php';

session_start();

// Inicializar cuenta
if (!isset($_SESSION['cuenta'])) {
    $_SESSION['cuenta'] = ['titular' => 'Juan Pérez', 'saldo' => 100.00];
}

// Inicializar carrito
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Validar acción
$accionesPermitidas = ['ingresar', 'retirar', 'eliminar', 'aplicar'];
$accion = filter_input(INPUT_GET, 'accion', FILTER_SANITIZE_STRING);

if ($accion && in_array($accion, $accionesPermitidas)) {
    switch ($accion) {
        case 'ingresar':
            $_SESSION['carrito'][] = new Operacion('ingreso', 10);
            break;

        case 'retirar':
            $_SESSION['carrito'][] = new Operacion('retirada', 10);
            break;

        case 'eliminar':
            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            if ($id !== null && isset($_SESSION['carrito'][$id])) {
                unset($_SESSION['carrito'][$id]);
                $_SESSION['carrito'] = array_values($_SESSION['carrito']);
            }
            break;

        case 'aplicar':
            $saldo = $_SESSION['cuenta']['saldo'];
            foreach ($_SESSION['carrito'] as $op) {
                $saldo = $op->aplicar($saldo);
            }
            $_SESSION['cuenta']['saldo'] = $saldo;
            $_SESSION['carrito'] = [];
            break;
    }

    // Redirigir para evitar repetición de operaciones al refrescar
    header('Location: /CarritoBanco/index.php');
    exit;
}