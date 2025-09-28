<?php
// Iniciar sesión si no está activa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Evitar errores si $qr no está definido
$qr = $qr ?? null;

// Inicializar variables vacías si no existen
$aplicaciones = $aplicaciones ?? [];
$reportes     = $reportes ?? [];
$documentos   = $documentos ?? [];
?>

<h2>Trazabilidad del Cultivo</h2>

<?php if (!empty($_SESSION['success'])): ?>
    <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']) ?></div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<?php if (!empty($_SESSION['error'])): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']) ?></div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<h3>Información del Cultivo</h3>
<p>Nombre: <?= htmlspecialchars($qr['id_cultivo'] ?? 'N/A') ?></p>

<hr>

<h3>Aplicaciones de Insumos</h3>
<?php if (!empty($aplicaciones)): ?>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
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
                        <?php foreach ($app['insumos'] as $insumo): ?>
                            <?= htmlspecialchars($insumo['nombre']) ?> (<?= $insumo['cantidad'] ?>)<br>
                        <?php endforeach; ?>
                    <?php else: ?>
                        Sin insumos
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No hay aplicaciones registradas.</p>
<?php endif; ?>

<hr>

<h3>Reportes Climáticos</h3>
<?php if (!empty($reportes)): ?>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
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
<?php else: ?>
    <p>No hay reportes climáticos registrados.</p>
<?php endif; ?>

<hr>

<h3>Documentos de Exportación</h3>
<?php if (!empty($documentos)): ?>
    <ul>
    <?php foreach ($documentos as $doc): ?>
        <li>
            <?= htmlspecialchars($doc['tipo_documento']) ?> (<?= $doc['fecha_emision'] ?>)
            <a href="/mi-proyecto/public/index.php?action=descargar_documento&id_documento=<?= $doc['id_documento'] ?>">Descargar</a>
        </li>
    <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No hay documentos vinculados.</p>
<?php endif; ?>

<?php if (isset($_SESSION['usuario']) && in_array($_SESSION['usuario']['id_rol'], [1,2])): ?>
    <p><a href="/mi-proyecto/public/index.php?action=subir_documento&id_cultivo=<?= $qr['id_cultivo'] ?>&token=<?= $qr['token'] ?>">+ Subir documento</a></p>
<?php endif; ?>
