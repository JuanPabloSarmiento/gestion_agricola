<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

ob_start();
?>

<h2 class="mb-4">Iniciar Sesión</h2>

<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']) ?></div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']) ?></div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<form method="POST" action="/mi-proyecto/public/index.php?action=login" class="w-50 mx-auto">
    <div class="mb-3">
        <label for="email" class="form-label">Email:</label>
        <input type="email" id="email" name="email" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="contrasena" class="form-label">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Ingresar</button>
</form>

<p class="mt-3 text-center">
    ¿No tienes cuenta? <a href="/mi-proyecto/public/index.php?action=registrar">Regístrate aquí</a>
</p>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
