<?php ob_start(); ?>

<h2 class="mb-4">Nuevo Insumo</h2>

<form action="/mi-proyecto/public/index.php?action=guardar_insumo" method="POST" class="needs-validation" novalidate>
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre:</label>
        <input type="text" class="form-control" id="nombre" name="nombre" required>
        <div class="invalid-feedback">
            El nombre es obligatorio.
        </div>
    </div>

    <div class="mb-3">
        <label for="tipo" class="form-label">Tipo:</label>
        <input type="text" class="form-control" id="tipo" name="tipo">
    </div>

    <div class="mb-3">
        <label for="stock" class="form-label">Stock:</label>
        <input type="number" class="form-control" id="stock" name="stock" value="0" min="0">
    </div>

    <div class="mb-3">
        <label for="fecha_ingreso" class="form-label">Fecha de ingreso:</label>
        <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso" value="<?= date('Y-m-d') ?>">
    </div>

    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="/mi-proyecto/public/index.php?action=insumos" class="btn btn-secondary">Cancelar</a>
</form>

<script>
// Validación simple Bootstrap 5
(() => {
    'use strict';
    const forms = document.querySelectorAll('.needs-validation');
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });
})();
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
