<h2>Detalle del Cultivo</h2>

<p><strong>ID:</strong> <?= htmlspecialchars($cultivo['id_cultivo']) ?></p>
<p><strong>Nombre:</strong> <?= htmlspecialchars($cultivo['nombre']) ?></p>
<p><strong>Variedad:</strong> <?= htmlspecialchars($cultivo['variedad']) ?></p>
<p><strong>Latitud:</strong> <?= htmlspecialchars($cultivo['latitud']) ?></p>
<p><strong>Longitud:</strong> <?= htmlspecialchars($cultivo['longitud']) ?></p>
<p><strong>Fecha Inicio:</strong> <?= htmlspecialchars($cultivo['fecha_inicio']) ?></p>
<p><strong>Fecha Fin:</strong> <?= htmlspecialchars($cultivo['fecha_fin']) ?></p>
<a href="/mi-proyecto/public/index.php?action=ver_aplicaciones&id_cultivo=<?= $cultivo['id_cultivo'] ?>" class="btn btn-info">
    Ver aplicaciones
</a> <br>
<a href="/mi-proyecto/public/index.php?action=ver_trazabilidad&token=<?= isset($cultivo['token']) && $cultivo['token'] !== null ? urlencode($cultivo['token']) : $cultivo['id_cultivo'] ?>" class="btn btn-warning">
    Ver trazabilidad
</a>
<br>
<?php if (!empty($cultivo['qr'])): ?>
    <a href="/mi-proyecto/public/index.php?action=descargar_informe&id_cultivo=<?= $cultivo['id_cultivo'] ?>" 
       class="btn btn-primary">
       Descargar Informe PDF
    </a>
<?php endif; ?>



 <br><br>
<a href="/mi-proyecto/public/index.php?action=cultivos">⬅ Volver al listado</a>
