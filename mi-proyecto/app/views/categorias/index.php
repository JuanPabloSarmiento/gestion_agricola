<?php if (!empty($_SESSION['success'])): ?>
    <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']); ?></div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<?php if (!empty($_SESSION['errors'])): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($_SESSION['errors'] as $error): ?>
                <li><?= htmlspecialchars($error); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php unset($_SESSION['errors']); ?>
<?php endif; ?>

<h2>Categorías</h2>

<a href="/mi-proyecto/public/index.php?action=crear_categoria">Agregar nueva categoría</a>

<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categorias as $cat): ?>
        <tr>
            <td><?= $cat['id_categoria'] ?></td>
            <td><?= htmlspecialchars($cat['nombre']) ?></td>
            <td>
                <a href="/mi-proyecto/public/index.php?action=editar_categoria&id=<?= $cat['id_categoria'] ?>">Editar</a> |
                <a href="/mi-proyecto/public/index.php?action=eliminar_categoria&id=<?= $cat['id_categoria'] ?>" onclick="return confirm('¿Eliminar esta categoría?')">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
