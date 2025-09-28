<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Evitar errores si variables no definidas
$id_cultivo = $id_cultivo ?? 0;
$token      = $_GET['token'] ?? '';
?>

<h2>Subir Documento para el Cultivo ID <?= htmlspecialchars($id_cultivo) ?></h2>

<?php if (!empty($_SESSION['error'])): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']) ?></div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<form method="POST" action="/mi-proyecto/public/index.php?action=subir_documento&id_cultivo=<?= $id_cultivo ?>" enctype="multipart/form-data">
    <label for="tipo_documento">Tipo de Documento</label>
    <input type="text" id="tipo_documento" name="tipo_documento" required>

    <label for="archivo">Archivo</label>
    <input type="file" id="archivo" name="archivo" required>

    <label for="fecha_emision">Fecha de Emisión</label>
    <input type="date" id="fecha_emision" name="fecha_emision" value="<?= date('Y-m-d') ?>">

    <label for="observaciones">Observaciones</label>
    <textarea id="observaciones" name="observaciones"></textarea>

    <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

    <button type="submit">Subir Documento</button>
</form>

<p>
    <a href="/mi-proyecto/public/index.php?action=ver_trazabilidad&token=<?= htmlspecialchars($token) ?>">Volver a Trazabilidad</a>
</p>
