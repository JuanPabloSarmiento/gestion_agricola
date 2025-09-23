<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
</head>
<body>
    <h1>Registro de Usuario</h1>

    <?php
    
    if (isset($_SESSION['error'])) {
        echo "<p style='color:red'>" . $_SESSION['error'] . "</p>";
        unset($_SESSION['error']);
    }
    ?>

    <!-- ✅ Ahora con ruta correcta -->
    <form method="POST" action="/mi-proyecto/public/index.php?action=registrar">
        <label>Nombre:</label>
        <input type="text" name="nombre" required><br>

        <label>Email:</label>
        <input type="email" name="email" required><br>

        <label>Contraseña:</label>
        <input type="password" name="contrasena" required><br>

        <label>Rol:</label>
        <select name="id_rol">
            <option value="1">Administrador</option>
            <option value="2" selected>Empleado</option>
            <option value="3" selected>Supervisor</option>
        </select><br><br>

        <button type="submit">Registrar</button>
    </form>

    <!-- ✅ Enlace corregido -->
    <p>¿Ya tienes cuenta? <a href="/mi-proyecto/public/index.php?action=login">Inicia sesión</a></p>
</body>
</html>
