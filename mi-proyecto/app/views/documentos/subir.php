<?php
$title = "Subir Documento - Cultivo #$id_cultivo";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$id_cultivo = $id_cultivo ?? 0;
$token      = $_GET['token'] ?? '';

ob_start();
?>

<h2 class="mb-4">Subir Documento para el Cultivo ID <?= htmlspecialchars($id_cultivo) ?></h2>

<?php if (!empty($_SESSION['error'])): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']) ?></div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<form method="POST" action="/mi-proyecto/public/index.php?action=subir_documento&id_cultivo=<?= $id_cultivo ?>" enctype="multipart/form-data" class="needs-validation" novalidate>
    <div class="mb-3">
        <label for="tipo_documento" class="form-label">Tipo de Documento</label>
        <input type="text" id="tipo_documento" name="tipo_documento" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="archivo" class="form-label">Archivo</label>
        <input type="file" id="archivo" name="archivo" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="fecha_emision" class="form-label">Fecha de Emisión</label>
        <input type="date" id="fecha_emision" name="fecha_emision" class="form-control" value="<?= date('Y-m-d') ?>">
    </div>

    <div class="mb-3">
        <label for="observaciones" class="form-label">Observaciones</label>
        <textarea id="observaciones" name="observaciones" class="form-control" rows="3"></textarea>
    </div>

    <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

    <button type="submit" class="btn btn-success">Subir Documento</button>
    <a href="/mi-proyecto/public/index.php?action=ver_trazabilidad&token=<?= htmlspecialchars($token) ?>" class="btn btn-secondary ms-2">Volver a Trazabilidad</a>
</form>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>
