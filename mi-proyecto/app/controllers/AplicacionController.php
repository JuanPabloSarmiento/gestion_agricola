<?php
require_once __DIR__ . '/../models/Aplicacion.php';
require_once __DIR__ . '/../models/Insumo.php';

class AplicacionController
{
    private Aplicacion $aplicacionModel;
    private Insumo $insumoModel;

    public function __construct()
    {
        $this->aplicacionModel = new Aplicacion();
        $this->insumoModel = new Insumo();

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Listar aplicaciones de un cultivo
     */
    public function index(int $id_cultivo)
    {
        if (!isset($_SESSION['usuario'])) {
            $_SESSION['error'] = "Debes iniciar sesión";
            header("Location: /mi-proyecto/public/index.php?action=login");
            exit;
        }

        $aplicaciones = $this->aplicacionModel->getByCultivo($id_cultivo);
        include __DIR__ . '/../views/aplicaciones/index.php';
    }

    /**
     * Mostrar formulario para crear aplicación
     */
    public function create(int $id_cultivo)
    {
        if (!isset($_SESSION['usuario'])) {
            $_SESSION['error'] = "Debes iniciar sesión";
            header("Location: /mi-proyecto/public/index.php?action=login");
            exit;
        }

        // Solo administradores o agrónomos (empleados) pueden registrar aplicaciones
        $rol = $_SESSION['usuario']['id_rol'] ?? null;
        if (!in_array($rol, [1, 2])) { // 1=admin, 2=empleado
            $_SESSION['error'] = "No tienes permisos para registrar aplicaciones.";
            header("Location: /mi-proyecto/public/index.php?action=cultivos");
            exit;
        }

        $insumos = $this->insumoModel->allConStock();
        include __DIR__ . '/../views/aplicaciones/create.php';
    }

    /**
     * Guardar nueva aplicación
     */
    public function store(int $id_cultivo)
    {
        if (!isset($_SESSION['usuario'])) {
            $_SESSION['error'] = "Debes iniciar sesión";
            header("Location: /mi-proyecto/public/index.php?action=login");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_usuario   = $_SESSION['usuario']['id_usuario'];
            $clima        = $_POST['clima'] ?? null;
            $dosis        = $_POST['dosis'] ?? null;
            $observaciones = $_POST['observaciones'] ?? null;
            $insumos      = $_POST['insumos'] ?? []; // array [id_insumo => cantidad]

            try {
                $this->aplicacionModel->createAplicacion(
                    $id_cultivo,
                    $id_usuario,
                    $clima,
                    $dosis,
                    $observaciones,
                    $insumos
                );

                $_SESSION['success'] = "Aplicación registrada con éxito.";
                header("Location: /mi-proyecto/public/index.php?action=ver_aplicaciones&id_cultivo=$id_cultivo");
                exit;
            } catch (Exception $e) {
                $_SESSION['error'] = $e->getMessage();
                header("Location: /mi-proyecto/public/index.php?action=nueva_aplicacion&id_cultivo=$id_cultivo");
                exit;
            }
        }
    }
}
