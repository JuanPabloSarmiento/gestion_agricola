<?php
require_once __DIR__ . '/../../core/Database.php';

class Documento
{
    private string $table = "documentos_exportacion";
    private string $primaryKey = "id_documento";

    // Subir documento
    public function upload(int $id_cultivo, string $tipo_documento, string $file_content, ?string $observaciones)
    {
        $sql = "INSERT INTO {$this->table} (id_cultivo, tipo_documento, archivo, fecha_emision, observaciones)
                VALUES (?, ?, ?, CURDATE(), ?)";
        return Database::insert($sql, [$id_cultivo, $tipo_documento, $file_content, $observaciones]);
    }

    // Listar documentos por cultivo
    public function getByCultivo(int $id_cultivo): array
    {
        $sql = "SELECT id_documento, tipo_documento, fecha_emision, observaciones
                FROM {$this->table} 
                WHERE id_cultivo = ? 
                ORDER BY fecha_emision DESC";
        return Database::select($sql, [$id_cultivo]);
    }

    public function find(int $id_documento): ?array
{
    return Database::selectOne("SELECT * FROM documentos_exportacion WHERE id_documento = ?", [$id_documento]);
}


    // Obtener documento para descarga
    public function getFile(int $id_documento): ?array
    {
        return Database::selectOne("SELECT archivo, tipo_documento FROM {$this->table} WHERE id_documento = ?", [$id_documento]);
    }
}
