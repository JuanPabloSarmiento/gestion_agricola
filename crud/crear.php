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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $edad   = $_POST['edad'];
    $email  = $_POST['email'];
    $sql = "INSERT INTO usuarios (nombre,email,edad) VALUES ('$nombre', '$email', $edad)";
    
    if ($conn->query($sql) === TRUE) {
        echo "Usuario agregado correctamente";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<form method="POST">
    <h2>Crear usuario</h2>
    Nombre: <input placeholder="nombre"  type="text" name="nombre"><br>
    Email: <input  placeholder="email" type="email" name="email"><br>
    Edad: <input placeholder="edad" type="number" name="edad"><br>
    <button type="submit">Agregar</button>
</form>
