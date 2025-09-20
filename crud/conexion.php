<?php
$conn = new mysqli("localhost", "root", "", "mi_db");

if ($conn->connect_errno) {
    echo "Error de conexión: " . $conexion->connect_error;
    exit();
}
?>

