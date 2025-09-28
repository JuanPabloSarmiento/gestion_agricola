<?php
require_once __DIR__ . '/../models/Aplicacion.php';
require_once __DIR__ . '/../models/ReporteClimatico.php';
require_once __DIR__ . '/../models/Documento.php';
require_once __DIR__ . '/../models/QR.php';
require_once __DIR__ . '/../models/Cultivo.php'; 

class TrazabilidadController
{
    private Aplicacion $aplicacionModel;
    private ReporteClimatico $climaModel;
    private Documento $documentoModel;
    private QR $qrModel;

    public function __construct()
    {
        $this->aplicacionModel = new Aplicacion();
        $this->climaModel      = new ReporteClimatico();
        $this->documentoModel  = new Documento();
        $this->qrModel         = new QR();

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Ver trazabilidad completa por token
    public function verTrazabilidad(string $token)
    {
        $qr = $this->qrModel->getByToken($token);
        if (!$qr) {
            $_SESSION['error'] = "QR inválido o inexistente";
            header("Location: /mi-proyecto/public/index.php?action=cultivos");
            exit;
        }

        $id_cultivo = $qr['id_cultivo'];

        // Traer todos los datos relacionados
        $aplicaciones = $this->aplicacionModel->getByCultivo($id_cultivo);
        $reportes     = $this->climaModel->getByCultivo($id_cultivo);
        $documentos   = $this->documentoModel->getByCultivo($id_cultivo);

        include __DIR__ . '/../views/trazabilidad/index.php';
    }
}
