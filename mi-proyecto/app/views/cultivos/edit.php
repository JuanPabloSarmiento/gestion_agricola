<h2>Editar Cultivo</h2>

<?php if (!empty($_SESSION['errors'])): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($_SESSION['errors'] as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php unset($_SESSION['errors']); ?>
<?php endif; ?>

<form method="POST" action="/mi-proyecto/public/index.php?action=actualizar_cultivo&id=<?= $cultivo['id_cultivo'] ?>">
    <label for="nombre">Nombre*</label>
    <input type="text" name="nombre" id="nombre" value="<?= htmlspecialchars($cultivo['nombre']) ?>" required>

    <label for="variedad">Variedad</label>
    <input type="text" name="variedad" id="variedad" value="<?= htmlspecialchars($cultivo['variedad']) ?>">

    <label for="latitud">Latitud</label>
    <input type="text" name="latitud" id="latitud" value="<?= htmlspecialchars($cultivo['latitud']) ?>">

    <label for="longitud">Longitud</label>
    <input type="text" name="longitud" id="longitud" value="<?= htmlspecialchars($cultivo['longitud']) ?>">

    <label for="fecha_inicio">Fecha Inicio</label>
    <input type="date" name="fecha_inicio" id="fecha_inicio" value="<?= htmlspecialchars($cultivo['fecha_inicio']) ?>">

    <label for="fecha_fin">Fecha Fin</label>
    <input type="date" name="fecha_fin" id="fecha_fin" value="<?= htmlspecialchars($cultivo['fecha_fin']) ?>">

    <label for="categorias">Categorías*</label>
    <select name="categorias[]" id="categorias" multiple required>
        <?php foreach ($categorias as $cat): ?>
            <option value="<?= $cat['id_categoria'] ?>"
                <?= in_array($cat['id_categoria'], array_column($cultivo['categorias'], 'id_categoria')) ? 'selected' : '' ?>>
                <?= htmlspecialchars($cat['nombre']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Actualizar</button>
</form>

<a href="/mi-proyecto/public/index.php?action=cultivos">Volver</a>
