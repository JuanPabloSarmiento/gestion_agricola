<h2>Aplicaciones del Cultivo</h2>

<?php if (!empty($_SESSION['success'])): ?>
    <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']); ?></div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<?php if (!empty($_SESSION['error'])): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']); ?></div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<p>
  <a href="/mi-proyecto/public/index.php?action=nueva_aplicacion&id_cultivo=<?= htmlspecialchars($id_cultivo) ?>">
    + Registrar nueva aplicación
</a>
</p>
<p>
    <a href="/mi-proyecto/public/index.php?action=cultivos">Volver a Cultivos</a>
</p>

<table border="1" cellpadding="5" cellspacing="0">
    <thead>
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
                    <td><?= htmlspecialchars($app['clima']) ?></td>
                    <td><?= htmlspecialchars($app['dosis']) ?></td>
                    <td><?= htmlspecialchars($app['observaciones']) ?></td>
                    <td>
                        <?php if (!empty($app['insumos'])): ?>
                            <?php foreach ($app['insumos'] as $d): ?>
                                <?= htmlspecialchars($d['nombre']) ?> (<?= $d['cantidad'] ?>)<br>
                            <?php endforeach; ?>
                        <?php else: ?>
                            Sin insumos
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">No hay aplicaciones registradas para este cultivo.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
