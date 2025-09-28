<?php
$title = "Trazabilidad del Cultivo";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$qr = $qr ?? null;
$aplicaciones = $aplicaciones ?? [];
$reportes     = $reportes ?? [];
$documentos   = $documentos ?? [];

ob_start();
?>

<a href="/mi-proyecto/public/index.php?action=cultivos" class="btn btn-secondary mb-3">⬅ Volver al listado</a>

<h2 class="mb-4">Trazabilidad del Cultivo</h2>

<section class="mb-5">
    <h2>Información del Cultivo</h2>
    <div class="card p-3 bg-light">
        <h3><strong>ID:</strong> <?= htmlspecialchars($qr['id_cultivo'] ?? 'N/A') ?></h3>
    </div>
</section>

<section class="mb-5">
    <h3>Aplicaciones de Insumos</h3>
    <?php if (!empty($aplicaciones)): ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Fecha</th>
                        <th>Usuario</th>
                        <th>Clima</th>
                        <th>Dosis</th>
                        <th>Observaciones</th>
                        <th>Insumos Aplicados</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($aplicaciones as $app): ?>
                        <tr>
                            <td><?= htmlspecialchars($app['fecha_hora_aplicacion']) ?></td>
                            <td><?= htmlspecialchars($app['usuario'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($app['clima'] ?? '-') ?></td>
                            <td><?= htmlspecialchars($app['dosis'] ?? '-') ?></td>
                            <td><?= htmlspecialchars($app['observaciones'] ?? '-') ?></td>
                            <td>
                                <?php if (!empty($app['insumos'])): ?>
                                    <ul class="mb-0">
                                        <?php foreach ($app['insumos'] as $insumo): ?>
                                            <li><?= htmlspecialchars($insumo['nombre']) ?> (<?= $insumo['cantidad'] ?>)</li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php else: ?>
                                    Sin insumos
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="text-muted">No hay aplicaciones registradas.</p>
    <?php endif; ?>
</section>

<section class="mb-5">
    <h3>Reportes Climáticos</h3>
    <?php if (!empty($reportes)): ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Fecha</th>
                        <th>Temperatura (°C)</th>
                        <th>Humedad (%)</th>
                        <th>Precipitaciones (mm)</th>
                        <th>Otros datos</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reportes as $rep): ?>
                        <tr>
                            <td><?= htmlspecialchars($rep['fecha']) ?></td>
                            <td><?= htmlspecialchars($rep['temperatura'] ?? '-') ?></td>
                            <td><?= htmlspecialchars($rep['humedad'] ?? '-') ?></td>
                            <td><?= htmlspecialchars($rep['precipitacion'] ?? '-') ?></td>
                            <td><?= htmlspecialchars($rep['otros_datos'] ?? '-') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="text-muted">No hay reportes climáticos registrados.</p>
    <?php endif; ?>
</section>

<section class="mb-5">
    <h3>Documentos de Exportación</h3>
    <?php if (!empty($documentos)): ?>
        <ul class="list-group">
            <?php foreach ($documentos as $doc): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?= htmlspecialchars($doc['tipo_documento']) ?> (<?= $doc['fecha_emision'] ?>)
                    <a href="/mi-proyecto/public/index.php?action=descargar_documento&id_documento=<?= $doc['id_documento'] ?>" class="btn btn-sm btn-primary">Descargar</a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p class="text-muted">No hay documentos vinculados.</p>
    <?php endif; ?>

    <?php if (isset($_SESSION['usuario']) && in_array($_SESSION['usuario']['id_rol'], [1,2])): ?>
        <div class="mt-3">
            <a href="/mi-proyecto/public/index.php?action=subir_documento&id_cultivo=<?= $qr['id_cultivo'] ?>&token=<?= $qr['token'] ?>" class="btn btn-success">+ Subir documento</a>
        </div>
    <?php endif; ?>
</section>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>
