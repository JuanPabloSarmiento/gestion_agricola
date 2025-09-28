<?php
require_once __DIR__ . '/../models/Insumo.php';

class InsumoController
{
    private Insumo $model;

    public function __construct()
    {
        $this->model = new Insumo();
        if (session_status() === PHP_SESSION_NONE) session_start();
    }

    // 🔹 Listar insumos
    public function index()
    {
        $insumos = $this->model->all();
        require __DIR__ . '/../views/insumos/index.php';
    }

    // 🔹 Mostrar formulario de creación
    public function create()
    {
        require __DIR__ . '/../views/insumos/create.php';
    }

    // 🔹 Guardar nuevo insumo
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->create([
                'nombre' => $_POST['nombre'],
                'tipo' => $_POST['tipo'],
                'stock' => $_POST['stock'],
                'fecha_ingreso' => $_POST['fecha_ingreso'] ?? date('Y-m-d')
            ]);
            $_SESSION['success'] = "Insumo registrado correctamente.";
            header("Location: index.php?controller=insumo&action=index");
            exit;
        }
    }

    // 🔹 Editar insumo
    public function edit(int $id)
    {
        $insumo = $this->model->find($id);
        require __DIR__ . '/../views/insumos/edit.php';
    }

    // 🔹 Actualizar insumo
    public function update(int $id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->update($id, [
                'nombre' => $_POST['nombre'],
                'tipo' => $_POST['tipo'],
                'stock' => $_POST['stock'],
                'fecha_ingreso' => $_POST['fecha_ingreso'] ?? date('Y-m-d')
            ]);
            $_SESSION['success'] = "Insumo actualizado correctamente.";
            header("Location: index.php?controller=insumo&action=index");
            exit;
        }
    }

    // 🔹 Eliminar insumo
    public function destroy(int $id)
    {
        if ($this->model->delete($id)) {
            $_SESSION['success'] = "Insumo eliminado correctamente.";
        } else {
            $_SESSION['error'] = "No se puede eliminar el insumo, está siendo utilizado en una aplicación.";
        }
        header("Location: index.php?controller=insumo&action=index");
        exit;
    }
}
