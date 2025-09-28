<?php include __DIR__ . '/../layouts/main.php'; ?>

<div class="container mt-5">
    <h2 class="mb-4">✏️ Editar Cultivo</h2>

    <?php if (!empty($_SESSION['errors'])): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($_SESSION['errors'] as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php unset($_SESSION['errors']); ?>
    <?php endif; ?>

    <form method="POST" action="/mi-proyecto/public/index.php?action=actualizar_cultivo&id=<?= $cultivo['id_cultivo'] ?>" class="card p-4 shadow-sm">
        
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre *</label>
            <input type="text" name="nombre" id="nombre" value="<?= htmlspecialchars($cultivo['nombre']) ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="variedad" class="form-label">Variedad</label>
            <input type="text" name="variedad" id="variedad" value="<?= htmlspecialchars($cultivo['variedad']) ?>" class="form-control">
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="latitud" class="form-label">Latitud</label>
                <input type="text" name="latitud" id="latitud" value="<?= htmlspecialchars($cultivo['latitud']) ?>" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label for="longitud" class="form-label">Longitud</label>
                <input type="text" name="longitud" id="longitud" value="<?= htmlspecialchars($cultivo['longitud']) ?>" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
                <input type="date" name="fecha_inicio" id="fecha_inicio" value="<?= htmlspecialchars($cultivo['fecha_inicio']) ?>" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label for="fecha_fin" class="form-label">Fecha Fin</label>
                <input type="date" name="fecha_fin" id="fecha_fin" value="<?= htmlspecialchars($cultivo['fecha_fin']) ?>" class="form-control">
            </div>
        </div>

        <div class="mb-3">
            <label for="categorias" class="form-label">Categorías *</label>
            <select name="categorias[]" id="categorias" class="form-select" multiple required>
                <?php foreach ($categorias as $cat): ?>
                    <option value="<?= $cat['id_categoria'] ?>"
                        <?= in_array($cat['id_categoria'], array_column($cultivo['categorias'], 'id_categoria')) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['nombre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <small class="text-muted">Usa CTRL (Windows) o CMD (Mac) para seleccionar varias categorías.</small>
        </div>

        <div class="d-flex justify-content-between">
            <a href="/mi-proyecto/public/index.php?action=cultivos" class="btn btn-secondary">⬅ Volver</a>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </div>
    </form>
</div>
