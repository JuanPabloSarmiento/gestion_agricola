<?php
// controllers/UsuarioController.php

require_once __DIR__ . '/../models/Usuario.php';

class UsuarioController
{
    private Usuario $usuarioModel;

    public function __construct()
    {
        $this->usuarioModel = new Usuario();

        // Iniciar sesión una sola vez
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Registrar nuevo usuario
     */
    public function registrar()
    {
        // Si ya hay usuario logueado, redirige al dashboard
        if (isset($_SESSION['usuario'])) {
            header("Location: /mi-proyecto/public/index.php?action=dashboard");
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nombre     = $_POST['nombre'] ?? '';
            $email      = $_POST['email'] ?? '';
            $contrasena = $_POST['contrasena'] ?? '';
            $id_rol     = $_POST['id_rol'] ?? 2; // 2 = usuario por defecto

            try {
                $this->usuarioModel->registrar([
                    "nombre"     => $nombre,
                    "email"      => $email,
                    "contrasena" => $contrasena,
                    "id_rol"     => $id_rol
                ]);

                $_SESSION['success'] = "Usuario registrado correctamente";
                header("Location: /mi-proyecto/public/index.php?action=login");
                exit;

            } catch (Exception $e) {
                $_SESSION['error'] = $e->getMessage();
                header("Location: /mi-proyecto/public/index.php?action=registrar");
                exit;
            }
        } else {
            include __DIR__ . '/../views/usuarios/registro.php';
        }
    }

    /**
     * Login de usuario
     */
    public function login()
    {
        // Si ya hay usuario logueado, redirige al dashboard
        if (isset($_SESSION['usuario'])) {
            header("Location: /mi-proyecto/public/index.php?action=dashboard");
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $email      = $_POST['email'] ?? '';
            $contrasena = $_POST['contrasena'] ?? '';

            $usuario = $this->usuarioModel->login($email, $contrasena);

            if ($usuario) {
                $_SESSION['usuario'] = $usuario;
                header("Location: /mi-proyecto/public/index.php?action=dashboard");
                exit;
            } else {
                $_SESSION['error'] = "Credenciales incorrectas";
                header("Location: /mi-proyecto/public/index.php?action=login");
                exit;
            }
        } else {
            include __DIR__ . '/../views/usuarios/login.php';
        }
    }

    /**
     * Logout (cerrar sesión)
     */
    public function logout()
    {
        session_destroy();
        header("Location: /mi-proyecto/public/index.php?action=login");
        exit;
    }

    /**
     * Listar usuarios (solo admin)
     */
    public function index()
    {
        // Verificar sesión
        if (!isset($_SESSION['usuario'])) {
            $_SESSION['error'] = "Debes iniciar sesión";
            header("Location: /mi-proyecto/public/index.php?action=login");
            exit;
        }

        // Solo admin puede acceder
        if ($_SESSION['usuario']['id_rol'] != 1) {
            $_SESSION['error'] = "No tienes permisos para ver esta página";
            header("Location: /mi-proyecto/public/index.php?action=dashboard");
            exit;
        }

        $usuarios = $this->usuarioModel->all();
        include __DIR__ . '/../views/usuarios/list.php';
    }

    /**
     * Dashboard
     */
    public function dashboard()
    {
        // Verificar sesión
        if (!isset($_SESSION['usuario'])) {
            $_SESSION['error'] = "Debes iniciar sesión";
            header("Location: /mi-proyecto/public/index.php?action=login");
            exit;
        }

        $usuario = $_SESSION['usuario'];
        include __DIR__ . '/../views/dashboard.php';
    }
}
