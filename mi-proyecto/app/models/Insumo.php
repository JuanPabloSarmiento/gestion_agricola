<?php
require_once __DIR__ . '/../../core/Database.php';

class Insumo
{
    private string $table = "insumos";
    private string $primaryKey = "id_insumo";

    // 🔹 Traer todos los insumos
    public function all(): array
    {
        return Database::select("SELECT * FROM {$this->table} ORDER BY nombre ASC");
    }

    // 🔹 Solo insumos con stock disponible
    public function allConStock(): array
    {
        return Database::select("SELECT * FROM {$this->table} WHERE stock > 0 ORDER BY nombre ASC");
    }

    // 🔹 Buscar un insumo por ID
    public function find(int $id): ?array
    {
        return Database::selectOne(
            "SELECT * FROM {$this->table} WHERE {$this->primaryKey} = ?",
            [$id]
        );
    }

    // 🔹 Crear un nuevo insumo
    public function create(array $data): int
    {
        $fecha = $data['fecha_ingreso'] ?? date('Y-m-d');
        $stock = isset($data['stock']) ? (int)$data['stock'] : 0;

        $sql = "INSERT INTO {$this->table} (nombre, tipo, stock, fecha_ingreso) VALUES (?, ?, ?, ?)";
        return Database::insert($sql, [
            $data['nombre'],
            $data['tipo'] ?? null,
            $stock,
            $fecha
        ]);
    }

    // 🔹 Actualizar un insumo
    public function update(int $id, array $data): bool
    {
        $fecha = $data['fecha_ingreso'] ?? date('Y-m-d');
        $stock = isset($data['stock']) ? (int)$data['stock'] : 0;

        $sql = "UPDATE {$this->table}
                SET nombre = ?, tipo = ?, stock = ?, fecha_ingreso = ?
                WHERE {$this->primaryKey} = ?";
        return (bool) Database::execute($sql, [
            $data['nombre'],
            $data['tipo'] ?? null,
            $stock,
            $fecha,
            $id
        ]);
    }

    // 🔹 Eliminar un insumo (manejo de FK)
    public function delete(int $id): bool
    {
        try {
            $sql = "DELETE FROM {$this->table} WHERE {$this->primaryKey} = ?";
            return (bool) Database::execute($sql, [$id]);
        } catch (PDOException $e) {
            // Retornar false si hay error de FK
            return false;
        }
    }

    // 🔹 Descontar stock (evita negativo)
    public function descontarStock(int $id, int $cantidad): bool
    {
        $sql = "UPDATE {$this->table} 
                SET stock = stock - ? 
                WHERE {$this->primaryKey} = ? AND stock >= ?";
        return (bool) Database::execute($sql, [$cantidad, $id, $cantidad]);
    }

    // 🔹 Aumentar stock
    public function aumentarStock(int $id, int $cantidad): bool
    {
        $sql = "UPDATE {$this->table} SET stock = stock + ? WHERE {$this->primaryKey} = ?";
        return (bool) Database::execute($sql, [$cantidad, $id]);
    }
}
