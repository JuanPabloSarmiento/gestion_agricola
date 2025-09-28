<?php
ob_start();
?>

<h2 class="mb-4">Registrar Aplicación de Insumos</h2>

<?php if (!empty($_SESSION['error'])): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']); ?></div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<form method="POST" action="/mi-proyecto/public/index.php?action=guardar_aplicacion&id_cultivo=<?= htmlspecialchars($_GET['id_cultivo']) ?>" class="mb-4">
    <input type="hidden" name="id_cultivo" value="<?= htmlspecialchars($_GET['id_cultivo']) ?>">

    <div class="mb-3">
        <label for="clima" class="form-label">Clima</label>
        <input type="text" id="clima" name="clima" class="form-control">
    </div>

    <div class="mb-3">
        <label for="dosis" class="form-label">Dosis</label>
        <input type="text" id="dosis" name="dosis" class="form-control">
    </div>

    <div class="mb-3">
        <label for="observaciones" class="form-label">Observaciones</label>
        <textarea id="observaciones" name="observaciones" class="form-control" rows="3"></textarea>
    </div>

    <h3 class="mt-4">Seleccionar Insumos</h3>
    <?php if (!empty($insumos)): ?>
        <div class="row">
        <?php foreach ($insumos as $insumo): ?>
            <div class="col-md-6 mb-2">
                <label class="form-label">
                    <?= htmlspecialchars($insumo['nombre']) ?> (Stock: <?= $insumo['stock'] ?>)
                </label>
                <input 
                    type="number" 
                    step="0.01" 
                    min="0" 
                    max="<?= $insumo['stock'] ?>" 
                    name="insumos[<?= $insumo['id_insumo'] ?>]" 
                    value="0"
                    class="form-control"
                >
            </div>
        <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>No hay insumos con stock disponible.</p>
    <?php endif; ?>

    <button type="submit" class="btn btn-primary mt-3">Guardar aplicación</button>
</form>

<p><a href="/mi-proyecto/public/index.php?action=ver_aplicaciones&id_cultivo=<?= htmlspecialchars($_GET['id_cultivo']) ?>" class="btn btn-secondary">Volver a aplicaciones</a></p>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
