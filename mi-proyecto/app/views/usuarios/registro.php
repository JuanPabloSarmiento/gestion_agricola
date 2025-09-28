<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

ob_start();
?>

<h2 class="mb-4">Registro de Usuario</h2>

<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']) ?></div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<form method="POST" action="/mi-proyecto/public/index.php?action=registrar" class="w-50 mx-auto">
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre:</label>
        <input type="text" id="nombre" name="nombre" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email:</label>
        <input type="email" id="email" name="email" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="contrasena" class="form-label">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="id_rol" class="form-label">Rol:</label>
        <select id="id_rol" name="id_rol" class="form-select">
            <option value="1">Administrador</option>
            <option value="2" selected>Empleado</option>
            <option value="3">Supervisor</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success">Registrar</button>
</form>

<p class="mt-3 text-center">
    ¿Ya tienes cuenta? <a href="/mi-proyecto/public/index.php?action=login">Inicia sesión</a>
</p>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
