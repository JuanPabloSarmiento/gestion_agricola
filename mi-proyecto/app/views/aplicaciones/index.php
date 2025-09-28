<?php ob_start(); ?>

<h2 class="mb-4">Aplicaciones del Cultivo</h2>

<?php if (!empty($_SESSION['success'])): ?>
    <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']); ?></div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<?php if (!empty($_SESSION['error'])): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']); ?></div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<div class="mb-3">
    <a href="/mi-proyecto/public/index.php?action=nueva_aplicacion&id_cultivo=<?= htmlspecialchars($id_cultivo) ?>" class="btn btn-primary">
        + Registrar nueva aplicación
    </a>
    <a href="/mi-proyecto/public/index.php?action=cultivos" class="btn btn-secondary ms-2">
        Volver a Cultivos
    </a>
</div>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Fecha</th>
            <th>Usuario</th>
            <th>Clima</th>
            <th>Dosis</th>
            <th>Observaciones</th>
            <th>Insumos aplicados</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($aplicaciones)): ?>
            <?php foreach ($aplicaciones as $app): ?>
                <tr>
                    <td><?= htmlspecialchars($app['id_aplicacion']) ?></td>
                    <td><?= htmlspecialchars($app['fecha_hora_aplicacion']) ?></td>
                    <td><?= htmlspecialchars($app['usuario']) ?></td>
                    <td><?= htmlspecialchars($app['clima'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($app['dosis'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($app['observaciones'] ?? '-') ?></td>
                    <td>
                        <?php if (!empty($app['insumos'])): ?>
                            <?php foreach ($app['insumos'] as $d): ?>
                                <?= htmlspecialchars($d['nombre']) ?> (<?= htmlspecialchars($d['cantidad']) ?>)<br>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <span class="text-muted">Sin insumos</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7" class="text-center">No hay aplicaciones registradas para este cultivo.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
