<h2>Registrar Cultivo</h2>

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

<form method="POST" action="/mi-proyecto/public/index.php?action=guardar_cultivo">
    <label for="nombre">Nombre*</label>
    <input type="text" name="nombre" id="nombre" required>

    <label for="variedad">Variedad</label>
    <input type="text" name="variedad" id="variedad">

    <label for="latitud">Latitud</label>
    <input type="text" name="latitud" id="latitud">

    <label for="longitud">Longitud</label>
    <input type="text" name="longitud" id="longitud">

    <label for="fecha_inicio">Fecha Inicio</label>
    <input type="date" name="fecha_inicio" id="fecha_inicio">

    <label for="fecha_fin">Fecha Fin</label>
    <input type="date" name="fecha_fin" id="fecha_fin">

    <label for="categorias">Categorías*</label>
    <select name="categorias[]" id="categorias" required>
        <?php foreach ($categorias as $cat): ?>
            <option value="<?= $cat['id_categoria'] ?>"><?= htmlspecialchars($cat['nombre']) ?></option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Guardar</button>
</form>

<a href="/mi-proyecto/public/index.php?action=cultivos">Volver</a>
