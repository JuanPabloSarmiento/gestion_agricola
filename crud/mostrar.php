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

$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);

echo "<table border='1'>
<tr><th>ID</th><th>Nombre</th><th>Email</th><th>Edad</th><th>Fecha_Registro</th><th>Acciones</th></tr>";

while($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>".$row['id_usuario']."</td>
        <td>".$row['nombre']."</td>
        <td>".$row['email']."</td>
        <td>".$row['edad']."</td>
        <td>".$row['fecha_registro']."</td>
        <td>
            <a href='editar.php?id_usuario=".$row['id_usuario']."'>Editar</a> |
            <a href='eliminar.php?id_usuario=".$row['id_usuario']."'>Eliminar</a>
        </td>
    </tr>";
}
echo "</table>";
?>
<a href="reporte.php" target="_blank">
    <button>📄 Generar PDF</button>
</a>
<a href="graficos.php" target="_blank">
    <button>📐Graficos</button>
</a>
<a href="crear.php" target="_blank">
    <button>✍️ crear</button>
</a>