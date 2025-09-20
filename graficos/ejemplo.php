<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Grafico con PHP y Chart.js</title>
</head>
<body>
  <canvas id="miGrafico"></canvas>

  <!-- Cargar Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <?php
  // Datos de ejemplo en PHP
  $meses = ['Enero', 'Febrero', 'Marzo', 'Abril','mayo','junio'];
  $ventas = [1200, 1900, 800, 1500,990,2000];
  ?>

  <script>
  const ctx = document.getElementById('miGrafico').getContext('2d');
  const miGrafico = new Chart(ctx, {
    type: 'line',
    data: {
      labels: <?php echo json_encode($meses); ?>,
      datasets: [{
        label: 'Ventas Mensuales',
        data: <?php echo json_encode($ventas); ?>,
        borderColor: [  "#E6CCD3",  "#D9f6aF", "#f7A21C",  "#528A95", "#1C737E", "#d65D69" ],
        fill: false,
        borderWidth: '5',
        tension: '0.3'
      }]
    }
  });
  </script>
</body>
</html>
