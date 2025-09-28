<?php include __DIR__ . '/../layouts/main.php'; ?>

<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h2 class="mb-0">🌱 Detalle del Cultivo</h2>
        </div>
        <div class="card-body">
            <p><strong>ID:</strong> <?= htmlspecialchars($cultivo['id_cultivo']) ?></p>
            <p><strong>Nombre:</strong> <?= htmlspecialchars($cultivo['nombre']) ?></p>
            <p><strong>Variedad:</strong> <?= htmlspecialchars($cultivo['variedad']) ?></p>
            <p><strong>Latitud:</strong> <?= htmlspecialchars($cultivo['latitud']) ?></p>
            <p><strong>Longitud:</strong> <?= htmlspecialchars($cultivo['longitud']) ?></p>
            <p><strong>Fecha Inicio:</strong> <?= htmlspecialchars($cultivo['fecha_inicio']) ?></p>
            <p><strong>Fecha Fin:</strong> <?= htmlspecialchars($cultivo['fecha_fin']) ?></p>

            <div class="d-flex flex-wrap gap-2 mt-4">
                <a href="/mi-proyecto/public/index.php?action=ver_aplicaciones&id_cultivo=<?= $cultivo['id_cultivo'] ?>" 
                   class="btn btn-info">
                   📋 Ver aplicaciones
                </a>

                <a href="/mi-proyecto/public/index.php?action=ver_trazabilidad&token=<?= isset($cultivo['token']) && $cultivo['token'] !== null ? urlencode($cultivo['token']) : $cultivo['id_cultivo'] ?>" 
                   class="btn btn-warning">
                   🔎 Ver trazabilidad
                </a>

                <?php if (!empty($cultivo['qr'])): ?>
                    <a href="/mi-proyecto/public/index.php?action=descargar_informe&id_cultivo=<?= $cultivo['id_cultivo'] ?>" 
                       class="btn btn-primary">
                       📄 Descargar Informe PDF
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <div class="card-footer text-end">
            <a href="/mi-proyecto/public/index.php?action=cultivos" class="btn btn-secondary">
                ⬅ Volver al listado
            </a>
        </div>
    </div>
</div>
