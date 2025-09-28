<?php
require_once __DIR__ . '/../models/Documento.php';
require_once __DIR__ . '/../models/Cultivo.php';
require_once __DIR__ . '/../models/Aplicacion.php';
require_once __DIR__ . '/../models/ReporteClimatico.php';
require_once __DIR__ . '/../libraries/fpdf/tcpdf.php';

class DocumentoController
{
    private Documento $documentoModel;
    private Cultivo $cultivoModel;
    private Aplicacion $aplicacionModel;
    private ReporteClimatico $climaModel;

    public function __construct()
    {
        $this->documentoModel  = new Documento();
        $this->cultivoModel    = new Cultivo();
        $this->aplicacionModel = new Aplicacion();
        $this->climaModel      = new ReporteClimatico();

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Subir documento
    public function subir(int $id_cultivo)
    {
        if (!in_array($_SESSION['usuario']['id_rol'], [1, 2])) {
            $_SESSION['error'] = "No tienes permisos para subir documentos";
            header("Location: /mi-proyecto/public/index.php?action=ver_trazabilidad&token=" . $_GET['token']);
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tipo_documento = $_POST['tipo_documento'];
            $observaciones  = $_POST['observaciones'] ?? '';
            $archivo        = file_get_contents($_FILES['archivo']['tmp_name']);

            $this->documentoModel->upload($id_cultivo, $tipo_documento, $archivo, $observaciones);

            $_SESSION['success'] = "Documento subido con éxito";
            header("Location: /mi-proyecto/public/index.php?action=ver_trazabilidad&token=" . $_POST['token']);
            exit;
        }

        include __DIR__ . '/../views/documentos/subir.php';
    }

    // Descargar documento individual
    public function descargar(int $id_documento)
    {
        $documento = $this->documentoModel->find($id_documento);

        if (!$documento) {
            $_SESSION['error'] = "Documento no encontrado.";
            header("Location: /mi-proyecto/public/index.php?action=cultivos");
            exit;
        }

        header("Content-Type: application/pdf");
        header("Content-Disposition: attachment; filename=\"" . $documento['tipo_documento'] . ".pdf\"");
        header("Content-Length: " . strlen($documento['archivo']));

        echo $documento['archivo'];
        exit;
    }

    // Descargar informe completo del cultivo
    public function descargarInforme(int $id_cultivo)
    {
        $cultivo      = $this->cultivoModel->findWithRelations($id_cultivo);
        $aplicaciones = $this->aplicacionModel->getByCultivo($id_cultivo);
        $reportes     = $this->climaModel->getByCultivo($id_cultivo);
        $documentos   = $this->documentoModel->getByCultivo($id_cultivo);

        if (!$cultivo) {
            $_SESSION['error'] = "Cultivo no encontrado.";
            header("Location: /mi-proyecto/public/index.php?action=cultivos");
            exit;
        }

        $pdf = new TCPDF();
        $pdf->AddPage();

        $pdf->SetFont('helvetica','B',16);
        $pdf->Cell(0,10,"Informe del Cultivo: " . $cultivo['nombre'],0,1,'C');
        $pdf->Ln(10);

        // Datos generales
        $pdf->SetFont('helvetica','B',12);
        $pdf->Cell(0,10,"Datos Generales",0,1);
        $pdf->SetFont('helvetica','',11);
        $pdf->MultiCell(0,6,"Variedad: {$cultivo['variedad']}\nFecha inicio: {$cultivo['fecha_inicio']}\nFecha fin: {$cultivo['fecha_fin']}");

        // Aplicaciones
        $pdf->Ln(5);
        $pdf->SetFont('helvetica','B',12);
        $pdf->Cell(0,10,"Aplicaciones de Insumos",0,1);
        $pdf->SetFont('helvetica','',11);
        if (!empty($aplicaciones)) {
            foreach ($aplicaciones as $app) {
                $pdf->MultiCell(0,6,"Fecha: {$app['fecha_hora_aplicacion']}, Usuario: {$app['usuario']}, Clima: {$app['clima']}, Dosis: {$app['dosis']}");
                if (!empty($app['insumos'])) {
                    foreach ($app['insumos'] as $insumo) {
                        $pdf->MultiCell(0,6,"   - {$insumo['nombre']}: {$insumo['cantidad']}");
                    }
                }
                $pdf->Ln(2);
            }
        } else {
            $pdf->Cell(0,6,"No hay aplicaciones registradas.",0,1);
        }

        // Reportes climáticos
        $pdf->Ln(5);
        $pdf->SetFont('helvetica','B',12);
        $pdf->Cell(0,10,"Reportes Climáticos",0,1);
        $pdf->SetFont('helvetica','',11);
        if (!empty($reportes)) {
            foreach ($reportes as $rep) {
                $pdf->MultiCell(0,6,"Fecha: {$rep['fecha']}, Temp: {$rep['temperatura']}°C, Humedad: {$rep['humedad']}%, Precipitación: {$rep['precipitacion']} mm");
            }
        } else {
            $pdf->Cell(0,6,"No hay reportes climáticos.",0,1);
        }

        // Documentos de exportación
        $pdf->Ln(5);
        $pdf->SetFont('helvetica','B',12);
        $pdf->Cell(0,10,"Documentos de Exportación",0,1);
        $pdf->SetFont('helvetica','',11);
        if (!empty($documentos)) {
            foreach ($documentos as $doc) {
                $pdf->MultiCell(0,6,"Tipo: {$doc['tipo_documento']}, Fecha: {$doc['fecha_emision']}");
            }
        } else {
            $pdf->Cell(0,6,"No hay documentos vinculados.",0,1);
        }

        $pdf->Output("Informe_Cultivo_{$cultivo['id_cultivo']}.pdf","D");
        exit;
    }
}
