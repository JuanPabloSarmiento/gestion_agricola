<?php
// app/controllers/CategoriaController.php

require_once __DIR__ . '/../models/Categoria.php';

class CategoriaController
{
    private $categoriaModel;

    public function __construct()
    {
        $this->categoriaModel = new Categoria();
    }

    /**
     * Listado de categorías
     */
    public function index()
    {
        // Solo admin
        if ($_SESSION['role'] !== 'admin') {
            $_SESSION['error'] = "Acceso denegado.";
            header("Location: /mi-proyecto/public/index.php?action=dashboard");
            exit;
        }

        $categorias = $this->categoriaModel->all();
        include __DIR__ . '/../views/categorias/index.php';
    }

    /**
     * Formulario de creación
     */
    public function create()
    {
        if ($_SESSION['role'] !== 'admin') {
            $_SESSION['error'] = "Acceso denegado.";
            header("Location: /mi-proyecto/public/index.php?action=dashboard");
            exit;
        }

        include __DIR__ . '/../views/categorias/create.php';
    }

    /**
     * Guardar nueva categoría
     */
    public function store()
    {
        if ($_SESSION['role'] !== 'admin') {
            $_SESSION['error'] = "Acceso denegado.";
            header("Location: /mi-proyecto/public/index.php?action=dashboard");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre'] ?? '');
            $descripcion = trim($_POST['descripcion'] ?? '');

            $errors = [];
            if ($nombre === '') {
                $errors[] = "El campo 'Nombre' es obligatorio.";
            }

            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                header("Location: /mi-proyecto/public/index.php?action=nueva_categoria");
                exit;
            }

            $data = [
                'nombre' => $nombre,
                'descripcion' => $descripcion !== '' ? $descripcion : null,
            ];

            $this->categoriaModel->create($data);
            $_SESSION['success'] = "Categoría creada con éxito.";
            header("Location: /mi-proyecto/public/index.php?action=categorias");
            exit;
        }
    }

    /**
     * Formulario de edición
     */
    public function edit(int $id)
    {
        if ($_SESSION['role'] !== 'admin') {
            $_SESSION['error'] = "Acceso denegado.";
            header("Location: /mi-proyecto/public/index.php?action=dashboard");
            exit;
        }

        $categoria = $this->categoriaModel->find($id);
        if (!$categoria) {
            $_SESSION['error'] = "Categoría no encontrada.";
            header("Location: /mi-proyecto/public/index.php?action=categorias");
            exit;
        }

        include __DIR__ . '/../views/categorias/edit.php';
    }

    /**
     * Actualizar categoría
     */
    public function update(int $id)
    {
        if ($_SESSION['role'] !== 'admin') {
            $_SESSION['error'] = "Acceso denegado.";
            header("Location: /mi-proyecto/public/index.php?action=dashboard");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre'] ?? '');
            $descripcion = trim($_POST['descripcion'] ?? '');

            $errors = [];
            if ($nombre === '') {
                $errors[] = "El campo 'Nombre' es obligatorio.";
            }

            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                header("Location: /mi-proyecto/public/index.php?action=editar_categoria&id=$id");
                exit;
            }

            $data = [
                'nombre' => $nombre,
                'descripcion' => $descripcion !== '' ? $descripcion : null,
            ];

            $this->categoriaModel->update($id, $data);
            $_SESSION['success'] = "Categoría actualizada con éxito.";
            header("Location: /mi-proyecto/public/index.php?action=categorias");
            exit;
        }
    }

    /**
     * Eliminar categoría
     */
    public function destroy(int $id)
    {
        if ($_SESSION['role'] !== 'admin') {
            $_SESSION['error'] = "Acceso denegado.";
            header("Location: /mi-proyecto/public/index.php?action=dashboard");
            exit;
        }

        $this->categoriaModel->delete($id);
        $_SESSION['success'] = "Categoría eliminada con éxito.";
        header("Location: /mi-proyecto/public/index.php?action=categorias");
        exit;
    }
}
