<?php
// public/index.php

// Iniciar sesión una sola vez
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Cargar el controlador de usuarios
require_once __DIR__ . '/../app/controllers/UsuarioController.php';

// Crear el controlador (si necesita DB, pasar $db)
$controller = new UsuarioController();

// Capturar la acción desde la URL
$action = $_GET['action'] ?? 'login';

// Router básico
switch ($action) {
    case 'registrar':
        $controller->registrar();
        break;
    case 'login':
        $controller->login();
        break;
    case 'logout':
        $controller->logout();
        break;
    case 'usuarios':
        $controller->index(); 
        break;
    case 'dashboard':
        $controller->dashboard();
        break;
    default:
        $controller->login();
        break;
}
