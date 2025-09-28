<?php
// app/models/Cultivo.php

require_once __DIR__ . '/../../core/Model.php';
require_once __DIR__ . '/../../core/Database.php';

class Cultivo extends Model
{
    public function __construct()
    {
        parent::__construct('cultivos', 'id_cultivo');
    }

    /**
     * Crear un nuevo cultivo y asignar categorías
     */
    public function create(array $data, array $categorias = []): int
    {
        // Insertar cultivo usando insert() del Model
        $idCultivo = $this->insert($data);

        // Insertar relaciones con categorías
        foreach ($categorias as $idCategoria) {
            $sql = "INSERT INTO cultivo_categoria (id_cultivo, id_categoria) VALUES (?, ?)";
            Database::execute($sql, [$idCultivo, $idCategoria]);
        }

        return $idCultivo;
    }

    /**
     * Actualizar cultivo y sincronizar categorías
     */
    public function updateWithCategories(int $idCultivo, array $data, array $categorias = []): int
    {
        // Actualizar cultivo
        $this->update($idCultivo, $data);

        // Eliminar relaciones existentes
        $sqlDelete = "DELETE FROM cultivo_categoria WHERE id_cultivo = ?";
        Database::execute($sqlDelete, [$idCultivo]);

        // Insertar nuevas relaciones
        foreach ($categorias as $idCategoria) {
            $sqlInsert = "INSERT INTO cultivo_categoria (id_cultivo, id_categoria) VALUES (?, ?)";
            Database::execute($sqlInsert, [$idCultivo, $idCategoria]);
        }

        return $idCultivo;
    }

    /**
     * Buscar cultivos por nombre o variedad
     */
    public function search(string $term): array
    {
        $like = "%{$term}%";
        $sql = "SELECT * 
                  FROM {$this->table} 
                 WHERE nombre LIKE ? 
                    OR variedad LIKE ?";
        return Database::select($sql, [$like, $like]);
    }

    /**
     * Obtener categorías asociadas a un cultivo
     */
    public function getCategories(int $idCultivo): array
    {
        $sql = "SELECT cat.* 
                  FROM categorias cat
                  JOIN cultivo_categoria cc 
                    ON cat.id_categoria = cc.id_categoria
                 WHERE cc.id_cultivo = ?";
        return Database::select($sql, [$idCultivo]);
    }

    /**
     * Obtener reporte climático más reciente
     */
    public function getLastClima(int $idCultivo): ?array
    {
        $sql = "SELECT * 
                  FROM reporte_climatico 
                 WHERE id_cultivo = ? 
              ORDER BY fecha DESC 
                 LIMIT 1";
        return Database::selectOne($sql, [$idCultivo]);
    }

    /**
     * Obtener documentos de exportación asociados
     */
    public function getDocumentos(int $idCultivo): array
    {
        $sql = "SELECT * 
                  FROM documentos_exportacion 
                 WHERE id_cultivo = ?";
        return Database::select($sql, [$idCultivo]);
    }

    /**
     * Obtener QR del cultivo (si existe)
     */
    public function getQr(int $idCultivo): ?array
    {
        $sql = "SELECT * 
                  FROM qr_codes 
                 WHERE id_cultivo = ?";
        return Database::selectOne($sql, [$idCultivo]);
    }

    /**
     * Devuelve un cultivo con todas sus relaciones
     */
    public function findWithRelations(int $idCultivo): ?array
{
    $cultivo = $this->find($idCultivo);
    if (!$cultivo) return null;

    $cultivo['categorias'] = $this->getCategories($idCultivo);
    $cultivo['clima']      = $this->getLastClima($idCultivo);
    $cultivo['documentos'] = $this->getDocumentos($idCultivo);

    // Traemos el QR
    $qr = $this->getQr($idCultivo); // Devuelve un array con token o null
    $cultivo['qr'] = $qr;
    $cultivo['token'] = $qr['token'] ?? null; // Campo que usará la vista para trazabilidad

    return $cultivo;
}

     public function closeCycle(int $id_cultivo)
    {
        $sql = "UPDATE {$this->table} SET fecha_fin = CURDATE() WHERE id_cultivo = ?";
        return Database::execute($sql, [$id_cultivo]);
    }
}

