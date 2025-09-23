<?php
// app/models/Categoria.php

require_once __DIR__ . '/../../core/Model.php';
require_once __DIR__ . '/../../core/Database.php';

class Categoria extends Model
{
    public function __construct()
    {
        // tabla, primary key
        parent::__construct('categorias', 'id_categoria');
    }

    /**
     * Crear una nueva categoría
     */
    public function create(array $data): int
    {
        return $this->insert($data);
    }

    /**
     * Actualizar categoría
     */
    public function update(int $id, array $data): int
    {
        return parent::update($id, $data);
    }

    /**
     * Eliminar categoría
     */
    public function delete(int $id): int
    {
        return parent::delete($id);
    }

    /**
     * Buscar categorías por nombre
     */
    public function search(string $term): array
    {
        $like = "%{$term}%";
        $sql = "SELECT * FROM {$this->table} WHERE nombre LIKE ?";
        return Database::select($sql, [$like]);
    }
}
