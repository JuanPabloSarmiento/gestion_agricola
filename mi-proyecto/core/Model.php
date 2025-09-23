<?php
// core/Model.php

require_once __DIR__ . '/Database.php';

abstract class Model
{
    protected string $table;       // nombre de la tabla
    protected string $primaryKey;  // campo clave primaria

    public function __construct(string $table, string $primaryKey = "id")
    {
        $this->table = $table;
        $this->primaryKey = $primaryKey;
    }

    /**
     * Devuelve todos los registros de la tabla
     */
    public function all(): array
    {
        $sql = "SELECT * FROM {$this->table}";
        return Database::select($sql);
    }

    /**
     * Busca un registro por su clave primaria
     */
    public function find(int $id): ?array
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$this->primaryKey} = ?";
        return Database::selectOne($sql, [$id]);
    }

    /**
     * Inserta un nuevo registro y devuelve el ID insertado
     */
    public function insert(array $data): int
    {
        $columns = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_fill(0, count($data), "?"));

        $sql = "INSERT INTO {$this->table} ($columns) VALUES ($placeholders)";
        return Database::insert($sql, array_values($data));
    }

    /**
     * Actualiza un registro por su clave primaria
     */
    public function update(int $id, array $data): int
    {
        $set = implode(", ", array_map(fn($col) => "$col = ?", array_keys($data)));
        $sql = "UPDATE {$this->table} SET $set WHERE {$this->primaryKey} = ?";

        $params = array_values($data);
        $params[] = $id;

        return Database::execute($sql, $params);
    }

    /**
     * Elimina un registro por su clave primaria
     */
    public function delete(int $id): int
    {
        $sql = "DELETE FROM {$this->table} WHERE {$this->primaryKey} = ?";
        return Database::execute($sql, [$id]);
    }
}

