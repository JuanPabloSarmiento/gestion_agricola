<?php
session_start();
if(!isset($_SESSION['usuario_id'])){
  header('Location: login.php'); exit;
}
?>
<h1>Bienvenido al Dashboard</h1>
<a href='../controllers/UsuarioController.php?logout=1'>Cerrar sesión</a>