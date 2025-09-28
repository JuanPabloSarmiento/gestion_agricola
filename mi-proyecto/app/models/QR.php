<?php
require_once __DIR__ . '/../../core/Database.php';

class QR
{
    private string $table = "qr_codes";
    private string $primaryKey = "id_qr";

    // Generar token único y guardar QR
    public function generarToken(int $id_cultivo): string
    {
        $token = bin2hex(random_bytes(16)); // token de 32 caracteres
        $sql = "INSERT INTO {$this->table} (id_cultivo, token) VALUES (?, ?)";
        Database::insert($sql, [$id_cultivo, $token]);
        return $token;
    }

    // Obtener QR por token
    public function getByToken(string $token): ?array
    {
        $sql = "SELECT * FROM {$this->table} WHERE token = ?";
        return Database::selectOne($sql, [$token]);
    }

    // Obtener QR por cultivo (opcional)
    public function getByCultivo(int $id_cultivo): ?array
    {
        $sql = "SELECT * FROM {$this->table} WHERE id_cultivo = ? ORDER BY created_at DESC LIMIT 1";
        return Database::selectOne($sql, [$id_cultivo]);
    }
}
