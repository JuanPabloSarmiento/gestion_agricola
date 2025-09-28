<h2>Registrar Aplicación de Insumos</h2>

<?php if (!empty($_SESSION['error'])): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']); ?></div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<form method="POST" action="/mi-proyecto/public/index.php?action=guardar_aplicacion&id_cultivo=<?= htmlspecialchars($_GET['id_cultivo']) ?>">
    <input type="hidden" name="id_cultivo" value="<?= htmlspecialchars($_GET['id_cultivo']) ?>">

    <label for="clima">Clima</label>
    <input type="text" id="clima" name="clima">

    <label for="dosis">Dosis</label>
    <input type="text" id="dosis" name="dosis">

    <label for="observaciones">Observaciones</label>
    <textarea id="observaciones" name="observaciones"></textarea>

    <h3>Seleccionar Insumos</h3>
<?php if (!empty($insumos)): ?>
    <?php foreach ($insumos as $insumo): ?>
        <div>
            <label>
                <?= htmlspecialchars($insumo['nombre']) ?> (Stock: <?= $insumo['stock'] ?>)
                <input 
                    type="number" 
                    step="0.01" 
                    min="0" 
                    max="<?= $insumo['stock'] ?>" 
                    name="insumos[<?= $insumo['id_insumo'] ?>]" 
                    value="0">
            </label>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>No hay insumos con stock disponible.</p>
<?php endif; ?>


    <button type="submit">Guardar aplicación</button>
</form>

<p><a href="/mi-proyecto/public/index.php?action=ver_aplicaciones&id_cultivo=<?= htmlspecialchars($_GET['id_cultivo']) ?>">Volver a aplicaciones</a></p>
