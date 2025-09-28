<?php ob_start(); ?>

<?php if (!empty($_SESSION['success'])): ?>
    <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?></div>
<?php endif; ?>

<?php if (!empty($_SESSION['error'])): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></div>
<?php endif; ?>

<h2 class="mb-4">Listado de Insumos</h2>

<a href="/mi-proyecto/public/index.php?action=crear_insumo" class="btn btn-primary mb-3">Nuevo Insumo</a>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Tipo</th>
            <th>Stock</th>
            <th>Fecha de ingreso</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($insumos)): ?>
            <?php foreach ($insumos as $insumo): ?>
                <tr>
                    <td><?= htmlspecialchars($insumo['id_insumo']) ?></td>
                    <td><?= htmlspecialchars($insumo['nombre']) ?></td>
                    <td><?= htmlspecialchars($insumo['tipo']) ?></td>
                    <td><?= htmlspecialchars($insumo['stock']) ?></td>
                    <td><?= htmlspecialchars($insumo['fecha_ingreso']) ?></td>
                    <td>
                        <a href="/mi-proyecto/public/index.php?action=editar_insumo&id=<?= $insumo['id_insumo'] ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="/mi-proyecto/public/index.php?action=eliminar_insumo&id=<?= $insumo['id_insumo'] ?>" 
                           onclick="return confirm('¿Eliminar este insumo?')" class="btn btn-sm btn-danger">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" class="text-center">No hay insumos registrados.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
