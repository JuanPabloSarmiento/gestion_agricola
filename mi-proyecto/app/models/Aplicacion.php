<?php
require_once __DIR__ . '/../../core/Database.php';

class Aplicacion
{
    private string $table = "aplicaciones";
    private string $primaryKey = "id_aplicacion";


        public function all(): array
    {
        $sql = "SELECT a.*, 
                       c.nombre AS cultivo, 
                       u.nombre AS usuario
                FROM aplicaciones a
                JOIN cultivos c ON a.id_cultivo = c.id_cultivo
                JOIN usuarios u ON a.id_usuario = u.id_usuario
                ORDER BY a.fecha_hora_aplicacion DESC";
        return Database::select($sql);
    }
    public function getByCultivo(int $id_cultivo): array
{
    $sql = "SELECT a.*, u.nombre AS usuario
            FROM aplicaciones a
            JOIN usuarios u ON a.id_usuario = u.id_usuario
            WHERE a.id_cultivo = ?
            ORDER BY a.fecha_hora_aplicacion DESC";
    $apps = Database::select($sql, [$id_cultivo]);

    foreach ($apps as &$app) {
        $app['insumos'] = Database::select(
            "SELECT i.nombre, ai.cantidad 
             FROM aplicacion_insumos ai
             JOIN insumos i ON ai.id_insumo = i.id_insumo
             WHERE ai.id_aplicacion = ?",
            [$app['id_aplicacion']]
        );
    }

    return $apps;
}

    public function createAplicacion(int $id_cultivo, int $id_usuario, ?string $clima, ?string $dosis, ?string $observaciones, array $insumos)
    {
        $pdo = Database::getInstance();
        try {
            $pdo->beginTransaction();

            // Insertar aplicación
            $sql = "INSERT INTO aplicaciones (id_cultivo, id_usuario, clima, fecha_hora_aplicacion, dosis, observaciones)
                    VALUES (?, ?, ?, NOW(), ?, ?)";
            $id_aplicacion = Database::insert($sql, [$id_cultivo, $id_usuario, $clima, $dosis, $observaciones]);

            // Insertar insumos asociados
            foreach ($insumos as $id_insumo => $cantidad) {
                if ($cantidad <= 0) continue;

                // Verificar stock
                $stock = Database::selectOne("SELECT stock FROM insumos WHERE id_insumo = ?", [$id_insumo]);
                if (!$stock || $stock['stock'] < $cantidad) {
                    throw new Exception("Stock insuficiente para insumo ID $id_insumo");
                }

                // Insertar detalle
                $sql = "INSERT INTO aplicacion_insumos (id_aplicacion, id_insumo, cantidad)
                        VALUES (?, ?, ?)";
                Database::insert($sql, [$id_aplicacion, $id_insumo, $cantidad]);

                // Actualizar stock
                $sql = "UPDATE insumos SET stock = stock - ? WHERE id_insumo = ?";
                Database::execute($sql, [$cantidad, $id_insumo]);
            }

            $pdo->commit();
            return $id_aplicacion;
        } catch (Exception $e) {
            $pdo->rollBack();
            throw $e;
        }
    }
}
