<?php
$title = "Listado de Cultivos";

// contenido dinámico
ob_start(); 
?>
<h2>Listado de Cultivos</h2>

<a href="/mi-proyecto/public/index.php?action=crear_cultivo" class="btn btn-primary mb-3">➕ Nuevo Cultivo</a>
<a href="/mi-proyecto/public/index.php?action=reporte_comparativo" 
   class="btn btn-success" style="margin-bottom:15px;">
   📊 Ver Reporte Comparativo
</a>
<table class="table table-bordered table-hover">
  <thead class="table-dark">
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Variedad</th>
      <th>Inicio</th>
      <th>Fin</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($cultivos as $c): ?>
    <tr>
      <td><?= $c['id_cultivo'] ?></td>
      <td><?= htmlspecialchars($c['nombre']) ?></td>
      <td><?= htmlspecialchars($c['variedad']) ?></td>
      <td><?= $c['fecha_inicio'] ?></td>
      <td><?= $c['fecha_fin'] ?></td>
      <td>
        <a href="/mi-proyecto/public/index.php?action=ver_cultivo&id=<?= $c['id_cultivo'] ?>" class="btn btn-info btn-sm">Ver</a>
        <a href="/mi-proyecto/public/index.php?action=editar_cultivo&id=<?= $c['id_cultivo'] ?>" class="btn btn-warning btn-sm">Editar</a>
        <a href="/mi-proyecto/public/index.php?action=eliminar_cultivo&id=<?= $c['id_cultivo'] ?>" class="btn btn-danger btn-sm">Eliminar</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>
