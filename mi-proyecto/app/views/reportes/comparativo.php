<?php
ob_start();
?>

<h2 class="mb-4">Reporte Comparativo de Cultivos</h2>

<div class="row">
    <!-- Card para Aplicaciones -->
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                Cantidad de Aplicaciones por Cultivo
            </div>
            <div class="card-body">
                <canvas id="chartAplicaciones" width="400" height="200"></canvas>
            </div>
        </div>
    </div>

    <!-- Card para Duración -->
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                Duración del Ciclo por Cultivo (días)
            </div>
            <div class="card-body">
                <canvas id="chartDuracion" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const cultivos = <?= json_encode(array_column($metricas, 'nombre')) ?>;
    const aplicaciones = <?= json_encode(array_column($metricas, 'aplicaciones')) ?>;
    const duraciones = <?= json_encode(array_column($metricas, 'duracion')) ?>;

    // Gráfico de aplicaciones
    new Chart(document.getElementById('chartAplicaciones'), {
        type: 'bar',
        data: {
            labels: cultivos,
            datasets: [{
                label: 'Cantidad de Aplicaciones',
                data: aplicaciones,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)'
                ],
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });

    // Gráfico de duración
    new Chart(document.getElementById('chartDuracion'), {
        type: 'bar',
        data: {
            labels: cultivos,
            datasets: [{
                label: 'Duración del ciclo (días)',
                data: duraciones,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)'
                ],
                fill: false,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
