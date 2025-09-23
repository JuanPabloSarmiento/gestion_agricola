<h2>Editar Categoría</h2>

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

<form method="POST" action="/mi-proyecto/public/index.php?action=actualizar_categoria&id=<?= $categoria['id_categoria'] ?>">
    <label for="nombre">Nombre*</label>
    <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($categoria['nombre']); ?>" required>
    <button type="submit">Actualizar</button>
</form>

<a href="/mi-proyecto/public/index.php?action=categorias">Volver</a>
