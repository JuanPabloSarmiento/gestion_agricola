<?php
// app/controllers/CultivoController.php

require_once __DIR__ . '/../models/Cultivo.php';
require_once __DIR__ . '/../models/Categoria.php';

class CultivoController
{
    private $cultivoModel;
    private $categoriaModel;

    public function __construct()
    {
        $this->cultivoModel   = new Cultivo();
        $this->categoriaModel = new Categoria();
    }

    /**
     * Listado de cultivos
     */
    public function index()
    {
        $cultivos = $this->cultivoModel->all();
        include __DIR__ . '/../views/cultivos/index.php';
    }

    /**
     * Mostrar un cultivo específico con todas sus relaciones
     */
    public function show(int $id)
    {
        $cultivo = $this->cultivoModel->findWithRelations($id);
        if (!$cultivo) {
            $_SESSION['error'] = "El cultivo no existe.";
            header("Location: /mi-proyecto/public/index.php?action=cultivos");
            exit;
        }
        include __DIR__ . '/../views/cultivos/show.php';
    }

    /**
     * Formulario de creación
     */
    public function create()
    {
        $categorias = $this->categoriaModel->all();
        include __DIR__ . '/../views/cultivos/create.php';
    }

    /**
     * Guardar nuevo cultivo con categorías
     */
   public function store()
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;

    $nombre       = trim($_POST['nombre'] ?? '');
    $variedad     = trim($_POST['variedad'] ?? '');
    $latitud      = $_POST['latitud'] ?? null;
    $longitud     = $_POST['longitud'] ?? null;
    $fecha_inicio = $_POST['fecha_inicio'] ?? null;
    $fecha_fin    = $_POST['fecha_fin'] ?? null;
    $categorias   = $_POST['categorias'] ?? [];

    $errors = [];

    if ($nombre === '') $errors[] = "El campo 'Nombre' es obligatorio.";
    if (empty($categorias)) $errors[] = "Debe seleccionar al menos una categoría.";

    // Validar latitud y longitud
    if ($latitud !== null && $latitud !== '' && !is_numeric($latitud)) $errors[] = "La latitud debe ser un número válido.";
    if ($longitud !== null && $longitud !== '' && !is_numeric($longitud)) $errors[] = "La longitud debe ser un número válido.";

    // Validar fechas
    if ($fecha_inicio && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha_inicio)) $errors[] = "La fecha de inicio debe estar en formato YYYY-MM-DD.";
    if ($fecha_fin && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha_fin)) $errors[] = "La fecha de fin debe estar en formato YYYY-MM-DD.";

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: /mi-proyecto/public/index.php?action=crear_cultivo");
        exit;
    }

    // Convertir lat/lon a float si vienen vacíos
    $latitud  = $latitud !== '' ? (float)$latitud : null;
    $longitud = $longitud !== '' ? (float)$longitud : null;

    $data = [
        'nombre'       => $nombre,
        'variedad'     => $variedad !== '' ? $variedad : null,
        'latitud'      => $latitud,
        'longitud'     => $longitud,
        'fecha_inicio' => $fecha_inicio !== '' ? $fecha_inicio : null,
        'fecha_fin'    => $fecha_fin !== '' ? $fecha_fin : null,
    ];

    // Crear cultivo y asignar categorías
    $this->cultivoModel->create($data, $categorias);

    $_SESSION['success'] = "Cultivo creado con éxito.";
    header("Location: /mi-proyecto/public/index.php?action=cultivos");
    exit;
}


    /**
     * Formulario de edición
     */
    public function edit(int $id)
    {
        $cultivo    = $this->cultivoModel->findWithRelations($id);
        $categorias = $this->categoriaModel->all();

        if (!$cultivo) {
            $_SESSION['error'] = "El cultivo no existe.";
            header("Location: /mi-proyecto/public/index.php?action=cultivos");
            exit;
        }

        include __DIR__ . '/../views/cultivos/edit.php';
    }

    /**
     * Actualizar cultivo con categorías
     */
public function update(int $id)
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;

    $nombre       = trim($_POST['nombre'] ?? '');
    $variedad     = trim($_POST['variedad'] ?? '');
    $categorias   = $_POST['categorias'] ?? [];
    $latitud      = $_POST['latitud'] ?? null;
    $longitud     = $_POST['longitud'] ?? null;
    $fecha_inicio = $_POST['fecha_inicio'] ?? null;
    $fecha_fin    = $_POST['fecha_fin'] ?? null;

    $errors = [];

    if ($nombre === '') $errors[] = "El campo 'Nombre' es obligatorio.";
    if (empty($categorias)) $errors[] = "Debe seleccionar al menos una categoría.";

    if ($latitud !== null && $latitud !== '' && !is_numeric($latitud)) $errors[] = "La latitud debe ser un número válido.";
    if ($longitud !== null && $longitud !== '' && !is_numeric($longitud)) $errors[] = "La longitud debe ser un número válido.";

    if ($fecha_inicio && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha_inicio)) $errors[] = "La fecha de inicio debe estar en formato YYYY-MM-DD.";
    if ($fecha_fin && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha_fin)) $errors[] = "La fecha de fin debe estar en formato YYYY-MM-DD.";

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: /mi-proyecto/public/index.php?action=editar_cultivo&id=$id");
        exit;
    }

    $data = [
        'nombre'       => $nombre,
        'variedad'     => $variedad !== '' ? $variedad : null,
        'latitud'      => $latitud !== '' ? (float)$latitud : null,
        'longitud'     => $longitud !== '' ? (float)$longitud : null,
        'fecha_inicio' => $fecha_inicio !== '' ? $fecha_inicio : null,
        'fecha_fin'    => $fecha_fin !== '' ? $fecha_fin : null,
    ];

    $this->cultivoModel->updateWithCategories($id, $data, $categorias);

    $_SESSION['success'] = "Cultivo actualizado con éxito.";
    header("Location: /mi-proyecto/public/index.php?action=cultivos");
    exit;
}


    /**
     * Eliminar cultivo
     */
    public function destroy(int $id)
    {
        $this->cultivoModel->delete($id);
        $_SESSION['success'] = "Cultivo eliminado con éxito.";
        header("Location: /mi-proyecto/public/index.php?action=cultivos");
        exit;
    }
}
