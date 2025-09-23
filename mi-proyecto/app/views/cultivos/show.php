<h2>Detalle del Cultivo</h2>

<p><strong>ID:</strong> <?= htmlspecialchars($cultivo['id_cultivo']) ?></p>
<p><strong>Nombre:</strong> <?= htmlspecialchars($cultivo['nombre']) ?></p>
<p><strong>Variedad:</strong> <?= htmlspecialchars($cultivo['variedad']) ?></p>
<p><strong>Latitud:</strong> <?= htmlspecialchars($cultivo['latitud']) ?></p>
<p><strong>Longitud:</strong> <?= htmlspecialchars($cultivo['longitud']) ?></p>
<p><strong>Fecha Inicio:</strong> <?= htmlspecialchars($cultivo['fecha_inicio']) ?></p>
<p><strong>Fecha Fin:</strong> <?= htmlspecialchars($cultivo['fecha_fin']) ?></p>

<a href="/mi-proyecto/public/index.php?action=cultivos">⬅ Volver al listado</a>
