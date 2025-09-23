<?php
class Database
{
    /** @var PDO|null */
    private static $pdo = null;

    /**
     * Retorna una conexión PDO única (singleton)
     */
    public static function getInstance(): PDO
    {
        if (self::$pdo === null) {
            $cfg = require __DIR__ . '/../config/database.php';

            $dsn = "mysql:host={$cfg['host']};port={$cfg['port']};dbname={$cfg['db']};charset={$cfg['charset']}";

            try {
                self::$pdo = new PDO($dsn, $cfg['user'], $cfg['pass'], [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Lanza excepciones en errores
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Resultados como arrays asociativos
                    PDO::ATTR_PERSISTENT => false, // Conexión no persistente
                ]);
            } catch (PDOException $e) {
                die("Error de conexión a la base de datos: " . $e->getMessage());
            }
        }

        return self::$pdo;
    }

    /**
     * Ejecuta un SELECT con parámetros y devuelve todos los resultados
     */
    public static function select(string $sql, array $params = []): array
    {
        $stmt = self::getInstance()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    /**
     * Ejecuta un SELECT con parámetros y devuelve una sola fila
     */
    public static function selectOne(string $sql, array $params = []): ?array
    {
        $stmt = self::getInstance()->prepare($sql);
        $stmt->execute($params);
        $row = $stmt->fetch();
        return $row === false ? null : $row;
    }

    /**
     * Ejecuta INSERT/UPDATE/DELETE con parámetros y devuelve número de filas afectadas
     */
    public static function execute(string $sql, array $params = []): int
    {
        $stmt = self::getInstance()->prepare($sql);
        $stmt->execute($params);
        return $stmt->rowCount();
    }

    /**
     * Ejecuta un INSERT y devuelve el último ID insertado
     */
    public static function insert(string $sql, array $params = []): int
    {
        $stmt = self::getInstance()->prepare($sql);
        $stmt->execute($params);
        return (int) self::getInstance()->lastInsertId();
    }
}

