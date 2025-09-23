<?php
// models/Usuario.php

require_once __DIR__ . '../../../core/Model.php';

class Usuario extends Model
{
    public function __construct()
    {
        parent::__construct("usuarios", "id_usuario");
    }

    /**
     * Buscar usuario por email
     */
    public function findByEmail(string $email): ?array
    {
        $sql = "SELECT * FROM {$this->table} WHERE email = ?";
        return Database::selectOne($sql, [$email]);
    }

    /**
     * Registrar nuevo usuario
     * - Valida que no exista el email
     * - Guarda con contraseña hasheada
     */
    public function registrar(array $data): int
    {
        // Validar que no exista el email
        $existe = $this->findByEmail($data['email']);
        if ($existe) {
            throw new Exception("El correo ya está registrado");
        }

        // Hashear la contraseña antes de guardar
        $data['contrasena'] = password_hash($data['contrasena'], PASSWORD_DEFAULT);

        return $this->insert($data);
    }

    /**
     * Verificar login de usuario
     */
    public function login(string $email, string $password): ?array
    {
        $usuario = $this->findByEmail($email);

        if ($usuario && password_verify($password, $usuario['contrasena'])) {
            return $usuario; // login exitoso
        }

        return null; // credenciales inválidas
    }
}

