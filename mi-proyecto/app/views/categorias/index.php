<?php
ob_start();
?>

<?php if (!empty($_SESSION['success'])): ?>
    <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']); ?></div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<?php if (!empty($_SESSION['errors'])): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach ($_SESSION['errors'] as $error): ?>
                <li><?= htmlspecialchars($error); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php unset($_SESSION['errors']); ?>
<?php endif; ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Categorías</h2>
        <a href="/mi-proyecto/public/index.php?action=nueva_categoria" class="btn btn-primary btn-sm p-2">➕ Crear</a>
</div>

<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($categorias) && is_array($categorias)): ?>
            <?php foreach ($categorias as $cat): ?>
                <tr>
                    <td><?= htmlspecialchars($cat['id_categoria']) ?></td>
                    <td><?= htmlspecialchars($cat['nombre']) ?></td>
                    <td>
                        <a href="/mi-proyecto/public/index.php?action=editar_categoria&id=<?= $cat['id_categoria'] ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="/mi-proyecto/public/index.php?action=eliminar_categoria&id=<?= $cat['id_categoria'] ?>" onclick="return confirm('¿Eliminar esta categoría?')" class="btn btn-danger btn-sm">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="3" class="text-center">No hay categorías registradas.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
