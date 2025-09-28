<?php
ob_start();
?>

<h2>Crear Nueva Categoría</h2>

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

<form method="POST" action="/mi-proyecto/public/index.php?action=guardar_categoria" class="mt-3">
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre*</label>
        <input type="text" id="nombre" name="nombre" class="form-control" required>
    </div>

    <!-- Mantener valores ocultos -->
    <input type="hidden" name="tipo" value="General">
    <input type="hidden" name="fecha_ingreso" value="<?= date('Y-m-d') ?>">

    <button type="submit" class="btn btn-primary">Guardar</button>
    <a href="/mi-proyecto/public/index.php?action=categorias" class="btn btn-secondary">Volver</a>
</form>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
