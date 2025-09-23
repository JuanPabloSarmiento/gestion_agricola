<?php

// Verificar sesión
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: 0"); // Proxies
if (!isset($_SESSION['usuario'])) {
    // ✅ Redirige al login mediante el router
    header("Location: /mi-proyecto/public/index.php?action=login");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuarios</title>
</head>
<body>
    <h1>Usuarios Registrados</h1>
    <table border="1">
        <tr>
            <th>ID</th><th>Nombre</th><th>Email</th><th>Rol</th>
        </tr>
        <?php foreach ($usuarios as $u): ?>
        <tr>
            <td><?= htmlspecialchars($u['id_usuario']) ?></td>
            <td><?= htmlspecialchars($u['nombre']) ?></td>
            <td><?= htmlspecialchars($u['email']) ?></td>
            <td><?= htmlspecialchars($u['id_rol']) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <!-- ✅ Enlace al logout usando el router -->
    <a href="/mi-proyecto/public/index.php?action=logout">Cerrar sesión</a>
</body>
</html>
