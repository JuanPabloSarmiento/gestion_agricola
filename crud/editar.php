<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="estilo.css">
    <meta charset="UTF-8">
    <title>Lista de usuarios</title>
    
</head>
</body>

<?php
include("conexion.php");

$id = $_GET['id_usuario'];
$sql = "SELECT * FROM usuarios WHERE id_usuario=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email  = $_POST['email'];
    $edad   = $_POST['edad'];

    $sql = "UPDATE usuarios SET nombre='$nombre', email='$email', edad=$edad WHERE id_usuario=$id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Usuario actualizado";
        header("Location: mostrar.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<form method="POST">
    <h2>Editar usuario</h2>
    Nombre: <input type="text" name="nombre" value="<?php echo $row['nombre']; ?>"><br>
    Email: <input type="email" name="email" value="<?php echo $row['email']; ?>"><br>
    Edad: <input type="number" name="edad" value="<?php echo $row['edad']; ?>"><br>
    <button type="submit">Actualizar</button>
</form>
