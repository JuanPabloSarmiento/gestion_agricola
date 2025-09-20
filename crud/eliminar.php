


<?php
include("conexion.php");

$id = $_GET['id_usuario'];

$sql = "DELETE FROM usuarios WHERE id_usuario=$id";

if ($conn->query($sql) === TRUE) {
    echo "Usuario eliminado";
    header("Location: mostrar.php");
} else {
    echo "Error: " . $conn->error;
}
?>
