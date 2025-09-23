<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
</head>
<body>
    <h1>Login</h1>

    <?php
    
    if (isset($_SESSION['error'])) {
        echo "<p style='color:red'>" . $_SESSION['error'] . "</p>";
        unset($_SESSION['error']);
    }
    if (isset($_SESSION['success'])) {
        echo "<p style='color:green'>" . $_SESSION['success'] . "</p>";
        unset($_SESSION['success']);
    }
    ?>

    <!-- ✅ Ahora con ruta correcta -->
    <form method="POST" action="/mi-proyecto/public/index.php?action=login">
        <label>Email:</label>
        <input type="email" name="email" required><br>

        <label>Contraseña:</label>
        <input type="password" name="contrasena" required><br><br>

        <button type="submit">Ingresar</button>
    </form>

    <!-- ✅ Enlace corregido -->
    <p>¿No tienes cuenta? <a href="/mi-proyecto/public/index.php?action=registrar">Regístrate aquí</a></p>
</body>
</html>
