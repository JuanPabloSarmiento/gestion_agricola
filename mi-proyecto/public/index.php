<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
?>
<?php
// public/index.php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Controladores
require_once __DIR__ . '/../app/controllers/UsuarioController.php';
require_once __DIR__ . '/../app/controllers/CultivoController.php';
require_once __DIR__ . '/../app/controllers/CategoriaController.php';
require_once __DIR__ . '/../app/controllers/AplicacionController.php';
require_once __DIR__ . '/../app/controllers/InsumoController.php';
require_once __DIR__ . '/../app/controllers/TrazabilidadController.php';
require_once __DIR__ . '/../app/controllers/DocumentoController.php';


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

    // --- Aplicaciones ---
case 'ver_aplicaciones':
    $id_cultivo = isset($_GET['id_cultivo']) ? (int) $_GET['id_cultivo'] : 0;
    (new AplicacionController())->index($id_cultivo);
    break;

case 'nueva_aplicacion':
    $id_cultivo = isset($_GET['id_cultivo']) ? (int) $_GET['id_cultivo'] : 0;
    (new AplicacionController())->create($id_cultivo);
    break;

case 'guardar_aplicacion':
    $id_cultivo = isset($_GET['id_cultivo']) ? (int) $_GET['id_cultivo'] : 0;
    (new AplicacionController())->store($id_cultivo);
    break;
    // --- Insumos ---
   
case 'insumos':
    (new InsumoController())->index();
    break;

case 'crear_insumo':
    (new InsumoController())->create();
    break;

case 'guardar_insumo':
    (new InsumoController())->store();
    break;

case 'editar_insumo':
    $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
    (new InsumoController())->edit($id);
    break;

case 'actualizar_insumo':
    $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
    (new InsumoController())->update($id);
    break;

case 'eliminar_insumo':
    $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
    (new InsumoController())->destroy($id);
    break;

    // --- Trazabilidad ---
    case 'ver_trazabilidad':
    $token = $_GET['token'] ?? '';
    (new TrazabilidadController())->verTrazabilidad($token);
    break;

case 'subir_documento':
    $id_cultivo = $_GET['id_cultivo'] ?? 0;
    (new DocumentoController())->subir($id_cultivo);
    break;
case 'descargar_documento':
    $id_documento = $_GET['id_documento'] ?? 0;
    (new DocumentoController())->descargar($id_documento);
    break;

case 'descargar_informe':
    $id_cultivo = $_GET['id_cultivo'] ?? 0;
    (new DocumentoController())->descargarInforme((int)$id_cultivo);
    break;

    // --- Default ---
    default:
        (new UsuarioController())->login();
        break;
}
