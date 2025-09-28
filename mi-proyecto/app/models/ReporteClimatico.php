<?php
require_once __DIR__ . '/../../core/Database.php';

class ReporteClimatico
{
    private string $table = "reporte_climatico";
    private string $primaryKey = "id_reporte";

    // Crear nuevo reporte climático
    public function create(int $id_cultivo, ?float $temperatura, ?float $humedad, ?float $precipitacion, ?string $otros_datos)
    {
        $sql = "INSERT INTO {$this->table} (id_cultivo, fecha, temperatura, humedad, precipitacion, otros_datos)
                VALUES (?, CURDATE(), ?, ?, ?, ?)";
        return Database::insert($sql, [$id_cultivo, $temperatura, $humedad, $precipitacion, $otros_datos]);
    }

    // Obtener todos los reportes de un cultivo
    public function getByCultivo(int $id_cultivo): array
    {
        $sql = "SELECT * FROM {$this->table} WHERE id_cultivo = ? ORDER BY fecha DESC";
        return Database::select($sql, [$id_cultivo]);
    }

    // Obtener un reporte específico
    public function getById(int $id_reporte): ?array
    {
        return Database::selectOne("SELECT * FROM {$this->table} WHERE id_reporte = ?", [$id_reporte]);
    }
}
