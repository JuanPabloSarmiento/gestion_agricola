<?php
require_once __DIR__ . '/../models/Cultivo.php';
require_once __DIR__ . '/../models/Aplicacion.php';
require_once __DIR__ . '/../models/ReporteClimatico.php';
require_once __DIR__ . '/../models/Documento.php';

class ReporteComparativoController
{
    private Cultivo $cultivoModel;
    private Aplicacion $aplicacionModel;
    private ReporteClimatico $climaModel;
    private Documento $documentoModel;

    public function __construct()
    {
        $this->cultivoModel     = new Cultivo();
        $this->aplicacionModel  = new Aplicacion();
        $this->climaModel       = new ReporteClimatico();
        $this->documentoModel   = new Documento();

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Vista comparativa con gráficas
     */
    public function comparativo()
    {
        // Traer todos los cultivos
        $cultivos = Database::select("CALL sp_get_all_cultivos()");

        // Traer todas las aplicaciones
        $aplicaciones = Database::select("CALL sp_get_all_aplicaciones()");

        // Preparamos métricas
        $metricas = [];

        foreach ($cultivos as $c) {
            $id = $c['id_cultivo'];

            // Filtrar aplicaciones de este cultivo
            $apps = array_filter($aplicaciones, fn($a) => $a['id_cultivo'] == $id);

            // Cantidad de aplicaciones
            $cantidadApps = count($apps);

            // Duración (fecha_fin - fecha_inicio)
            $fechaInicio = $c['fecha_inicio'] ? new DateTime($c['fecha_inicio']) : null;
            $fechaFin    = $c['fecha_fin'] ? new DateTime($c['fecha_fin']) : new DateTime();
            $duracion    = $fechaInicio ? $fechaInicio->diff($fechaFin)->days : 0;

            $metricas[] = [
                'nombre'       => $c['nombre'],
                'aplicaciones' => $cantidadApps,
                'duracion'     => $duracion,
                'fecha_inicio' => $c['fecha_inicio'],
            ];
        }

        // Pasar a la vista
        include __DIR__ . '/../views/reportes/comparativo.php';
    }
}
