<?php
// public/index.php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Controladores
require_once __DIR__ . '/../app/controllers/UsuarioController.php';
require_once __DIR__ . '/../app/controllers/CultivoController.php';
require_once __DIR__ . '/../app/controllers/CategoriaController.php';


// Acción desde la URL
$action = $_GET['action'] ?? 'login';

// Router básico
switch ($action) {
    // --- Usuarios ---
    case 'registrar':
        (new UsuarioController())->registrar();
        break;
    case 'login':
        (new UsuarioController())->login();
        break;
    case 'logout':
        (new UsuarioController())->logout();
        break;
    case 'usuarios':
        (new UsuarioController())->index(); 
        break;
    case 'dashboard':
        (new UsuarioController())->dashboard();
        break;

    // --- Cultivos ---
    case 'cultivos':
        (new CultivoController())->index();
        break;
    case 'ver_cultivo':
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        (new CultivoController())->show($id);
        break;
    case 'crear_cultivo':
        (new CultivoController())->create();
        break;
    case 'guardar_cultivo':
        (new CultivoController())->store();
        break;
    case 'editar_cultivo':
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        (new CultivoController())->edit($id);
        break;
    case 'actualizar_cultivo':
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        (new CultivoController())->update($id);
        break;
    case 'eliminar_cultivo':
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        (new CultivoController())->destroy($id);
        break;


    // --- Categorías ---
    case 'categorias':
    (new CategoriaController())->index();
    break;
case 'nueva_categoria':
    (new CategoriaController())->create();
    break;
case 'guardar_categoria':
    (new CategoriaController())->store();
    break;
case 'editar_categoria':
    $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
    (new CategoriaController())->edit($id);
    break;
case 'actualizar_categoria':
    $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
    (new CategoriaController())->update($id);
    break;
case 'eliminar_categoria':
    $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
    (new CategoriaController())->destroy($id);
    break;


    // --- Default ---
    default:
        (new UsuarioController())->login();
        break;
}
