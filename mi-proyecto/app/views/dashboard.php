<?php
// dashboard.php
// No session_start() aquí, ya se hace en el controlador

// Evitar cache para que "go back" no funcione después de logout
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: 0"); // Proxies

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
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h1>Bienvenido, <?= htmlspecialchars($usuario['nombre']) ?></h1>
    <p>Email: <?= htmlspecialchars($usuario['email']) ?></p>
    <p>Rol: <?= htmlspecialchars($rolNombre) ?></p>

    <!-- Botón solo para administradores -->
    <?php if ($esAdmin): ?>
        <ul>
            <li><a href="/mi-proyecto/public/index.php?action=nueva_categoria">Crear Categoría</a></li>
            <li><a href="/mi-proyecto/public/index.php?action=categorias">Ver Categorías</a></li>
            <li><a href="/mi-proyecto/public/index.php?action=usuarios">Ver Usuarios</a></li>
            <li><a href="/mi-proyecto/public/index.php?action=crear_cultivo">Crear Cultivo</a></li>
            <li><a href="/mi-proyecto/public/index.php?action=cultivos">Ver Cultivos</a></li>
        </ul>
            
            
        
            
        
    <?php endif; ?>

    <!-- Logout -->
    <p>
        <a href="/mi-proyecto/public/index.php?action=logout">Cerrar sesión</a>
    </p>

    <!-- Mensajes de error/success -->
    <?php if (isset($_SESSION['error'])): ?>
        <p style="color:red"><?= htmlspecialchars($_SESSION['error']) ?></p>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['success'])): ?>
        <p style="color:green"><?= htmlspecialchars($_SESSION['success']) ?></p>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>
</body>
</html>
