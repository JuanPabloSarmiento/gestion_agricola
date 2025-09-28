<!-- app/views/insumos/index.php -->

<?php if (!empty($_SESSION['success'])): ?>
    <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
<?php endif; ?>

<?php if (!empty($_SESSION['error'])): ?>
    <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
<?php endif; ?>

<h2>Listado de Insumos</h2>
<a href="/mi-proyecto/public/index.php?action=crear_insumo">Nuevo Insumo</a>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Tipo</th>
            <th>Stock</th>
            <th>Fecha ingreso</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($insumos as $insumo): ?>
            <tr>
                <td><?= $insumo['id_insumo'] ?></td>
                <td><?= htmlspecialchars($insumo['nombre']) ?></td>
                <td><?= htmlspecialchars($insumo['tipo']) ?></td>
                <td><?= $insumo['stock'] ?></td>
                <td><?= $insumo['fecha_ingreso'] ?></td>
                <td>
                    <a href="index.php?controller=insumo&action=edit&id=<?= $insumo['id_insumo'] ?>">Editar</a> |
                    <a href="index.php?controller=insumo&action=destroy&id=<?= $insumo['id_insumo'] ?>" 
                       onclick="return confirm('¿Eliminar este insumo?')">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
