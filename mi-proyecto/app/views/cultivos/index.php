<?php if (!empty($_SESSION['success'])): ?>
    <div class="alert alert-success">
        <?= htmlspecialchars($_SESSION['success']) ?>
    </div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<?php if (!empty($_SESSION['error'])): ?>
    <div class="alert alert-danger">
        <?= htmlspecialchars($_SESSION['error']) ?>
    </div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>


<?php


// Verificar sesión
$usuario = $_SESSION['usuario'] ?? null;
if (!$usuario) {
    $_SESSION['error'] = "Debes iniciar sesión";
    header("Location: /mi-proyecto/public/index.php?action=login");
    exit;
}

// Determinar si es admin
$esAdmin = ($usuario['id_rol'] == 1);

// Nombre legible del rol
$roles = [1 => 'Administrador', 2 => 'Empleado', 3 => 'Supervisor'];
$rolNombre = $roles[$usuario['id_rol']] ?? 'Desconocido';
?>


<h2>Listado de Cultivos</h2>

<a href="/mi-proyecto/public/index.php?action=crear_cultivo">+ Nuevo Cultivo</a>

<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Variedad</th>
            <th>Fecha Inicio</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($cultivos)): ?>
            <?php foreach ($cultivos as $cultivo): ?>
                <tr>
                    <td><?= htmlspecialchars($cultivo['id_cultivo']) ?></td>
                    <td><?= htmlspecialchars($cultivo['nombre']) ?></td>
                    <td><?= htmlspecialchars($cultivo['variedad']) ?></td>
                    <td><?= htmlspecialchars($cultivo['fecha_inicio']) ?></td>
                    <td>
                        <a href="/mi-proyecto/public/index.php?action=ver_cultivo&id=<?= $cultivo['id_cultivo'] ?>">Ver</a>
                        <?php if ($esAdmin): ?>  |
                        <a href="/mi-proyecto/public/index.php?action=editar_cultivo&id=<?= $cultivo['id_cultivo'] ?>">Editar</a> |
                        <a href="/mi-proyecto/public/index.php?action=eliminar_cultivo&id=<?= $cultivo['id_cultivo'] ?>" onclick="return confirm('¿Seguro que deseas eliminar este cultivo?')">Eliminar</a>
                        <?php endif; ?>
                        
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">No hay cultivos registrados.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
