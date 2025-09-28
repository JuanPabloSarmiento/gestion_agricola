<?php
$title = "Dashboard - Gestión Agrícola";

$usuario = $_SESSION['usuario'] ?? null;
if (!$usuario) {
    $_SESSION['error'] = "Debes iniciar sesión";
    header("Location: /mi-proyecto/public/index.php?action=login");
    exit;
}

$esAdmin = ($usuario['id_rol'] == 1);
$roles = [1 => 'Administrador', 2 => 'Empleado', 3 => 'Supervisor'];
$rolNombre = $roles[$usuario['id_rol']] ?? 'Desconocido';

ob_start();
?>

<div class="container container-main py-4">
    <h1 class="mb-3">Bienvenido, <?= htmlspecialchars($usuario['nombre']) ?></h1>
    <p><strong>Email:</strong> <?= htmlspecialchars($usuario['email']) ?></p>
    <p><strong>Rol:</strong> <?= htmlspecialchars($rolNombre) ?></p>

    <hr>

    <h4>Accesos Rápidos</h4>
    <div class="row mb-3">
        <div class="col-md-4">
            <div class="card shadow-sm mb-2">
                <div class="card-body">
                    <h5 class="card-title">Cultivos</h5>
                    <p class="card-text">Crear o ver cultivos registrados.</p>
                    <a href="/mi-proyecto/public/index.php?action=crear_cultivo" class="btn btn-primary btn-sm">➕ Crear</a>
                    <a href="/mi-proyecto/public/index.php?action=cultivos" class="btn btn-info btn-sm">📋 Ver</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm mb-2">
                <div class="card-body">
                    <h5 class="card-title">Categorías</h5>
                    <p class="card-text">Gestionar categorías de cultivos.</p>
                    <a href="/mi-proyecto/public/index.php?action=categorias" class="btn btn-info btn-sm">📂 Ver</a>
                    <?php if ($esAdmin): ?>
                        <a href="/mi-proyecto/public/index.php?action=nueva_categoria" class="btn btn-primary btn-sm">➕ Crear</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php if ($esAdmin): ?>
        <div class="col-md-4">
            <div class="card shadow-sm mb-2">
                <div class="card-body">
                    <h5 class="card-title">Administración</h5>
                    <p class="card-text">Usuarios e insumos del sistema.</p>
                    <a href="/mi-proyecto/public/index.php?action=insumos" class="btn btn-info btn-sm">💊 Insumos</a>
                    <a href="/mi-proyecto/public/index.php?action=usuarios" class="btn btn-info btn-sm">👥 Usuarios</a>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <a href="/mi-proyecto/public/index.php?action=logout" class="btn btn-danger mb-3">Cerrar sesión</a>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']) ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']) ?></div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/layouts/main.php';

?>
