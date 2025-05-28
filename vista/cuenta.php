<?php
require_once __DIR__ . '/../modelo/operacion.php';
$cuenta = $_SESSION['cuenta'];
$carrito = $_SESSION['carrito'];
?>

<h1>Cuenta Bancaria</h1>
<p><strong>Titular:</strong> <?= $cuenta['titular'] ?></p>
<p><strong>Saldo:</strong> 
    <span style="color: <?= $cuenta['saldo'] >= 0 ? 'green' : 'red' ?>;">
        <?= number_format($cuenta['saldo'], 2) ?> €
    </span>
</p>

<h2>Operaciones</h2>
<a href="controlador/controlador.php?accion=ingresar">Ingresar 10€</a> |
<a href="controlador/controlador.php?accion=retirar">Retirar 10€</a>

<h2>Carrito de operaciones</h2>
<?php if (empty($carrito)): ?>
    <p>El carrito está vacío.</p>
<?php else: ?>
    <ul>
        <?php foreach ($carrito as $i => $op): ?>
            <li>
                <?= ucfirst($op->tipo) ?> de <?= $op->cantidad ?> €
                <a href="controlador/controlador.php?accion=eliminar&id=<?= $i ?>">Eliminar</a>
            </li>
        <?php endforeach; ?>
    </ul>
    <a href="controlador/controlador.php?accion=aplicar">Aplicar operaciones</a>
<?php endif; ?>
