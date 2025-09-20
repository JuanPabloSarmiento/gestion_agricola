<?php
require_once __DIR__ . '/tcpdf/tcpdf.php';  // incluimos TCPDF manualmente
require_once "conexion.php";

$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);

$pdf = new TCPDF();
$pdf->AddPage();

// Encabezado
$pdf->SetFont('helvetica', 'B', 18);
$pdf->Cell(0, 10, 'Reporte de Registros', 0, 1, 'C');
$pdf->Ln(5);

// Encabezados de tabla
$pdf->SetFont('helvetica', 'B', 12);
$pdf->SetFillColor(200, 220, 255);
$pdf->Cell(30, 10, 'id_usuario', 1, 0, 'C', true);
$pdf->Cell(60, 10, 'Nombre', 1, 0, 'C', true);
$pdf->Cell(60, 10, 'Email', 1, 1, 'C', true);

// Filas
$pdf->SetFont('helvetica', '', 11);
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(30, 8, $row['id_usuario'], 1, 0, 'C');
        $pdf->Cell(60, 8, $row['nombre'], 1, 0, 'L');
        $pdf->Cell(60, 8, $row['email'], 1, 1, 'L');
    }
} else {
    $pdf->Cell(0, 10, "No hay registros.", 1, 1, 'C');
}
ob_end_clean();
$pdf->Output('reporte.pdf', 'I');
?>