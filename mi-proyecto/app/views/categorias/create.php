<h2>Crear Nueva Categoría</h2>

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

<form method="POST" action="/mi-proyecto/public/index.php?action=guardar_categoria">
    <label for="nombre">Nombre*</label>
    <input type="text" id="nombre" name="nombre" required>
    <button type="submit">Guardar</button>
</form>

<a href="/mi-proyecto/public/index.php?action=categorias">Volver</a>
