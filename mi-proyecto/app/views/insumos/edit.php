<!-- app/views/insumos/create.php -->

<h2>Nuevo Insumo</h2>

<form action="index.php?controller=insumo&action=store" method="POST">
    <label>Nombre:</label><br>
    <input type="text" name="nombre" required><br><br>

    <label>Tipo:</label><br>
    <input type="text" name="tipo"><br><br>

    <label>Stock:</label><br>
    <input type="number" name="stock" value="0" min="0"><br><br>

    <label>Fecha de ingreso:</label><br>
    <input type="date" name="fecha_ingreso" value="<?= date('Y-m-d') ?>"><br><br>

    <button type="submit">Guardar</button>
    <a href="index.php?controller=insumo&action=index">Cancelar</a>
</form>
