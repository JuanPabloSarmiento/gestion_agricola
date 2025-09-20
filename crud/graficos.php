<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfico Usuarios</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h2>Gráfico de Edades de Usuarios</h2>
    <canvas id="miBarras"></canvas>
    <canvas id="miLineas"></canvas>
    <canvas id="miPie"></canvas>

<?php
// 1. Conexión a la base de datos con PDO
$dsn = "mysql:host=localhost;dbname=mi_db;charset=utf8"; 
$usuario = "root"; 
$clave = "";

try {
    $pdo = new PDO($dsn, $usuario, $clave);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 2. Consultar datos de la tabla usuario
    $stmt = $pdo->query("SELECT nombre, edad FROM usuarios");
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 3. Extraer columnas separadas para Chart.js
    $nombres = array_column($usuarios, 'nombre');
    $edades = array_column($usuarios, 'edad');

} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>

<script>
// 4. Pasar datos de PHP a JavaScript con json_encode
const nombres = <?php echo json_encode($nombres); ?>;
const edades = <?php echo json_encode($edades); ?>;
const opciones = {
    responsive: true,
        plugins: {
            legend: { display: true }
        }

}
const datos = {
     labels: nombres, // nombres desde PHP
        datasets: [{
            label: 'Edades de Usuarios',
            data: edades, // edades desde PHP
            backgroundColor: [  "#E6CCD3",  "#D9f6aF", "#f7A21C",  "#528A95", "#1C737E", "#d65D69" ]
        }]
}
// 5. Crear el gráfico
const barras = document.getElementById('miBarras').getContext('2d');
const miBarras = new Chart(barras, {
    type: 'bar',
    data: {
     ...datos
    },
    options: {
        ...opciones
    }
});

const lineas = document.getElementById('miLineas').getContext('2d');
const miLineas = new Chart(lineas, {
    type: 'line',
    data: {
    ...datos,
    fill: false,
    tension: 0.5

    },
    options: {
        ...opciones
    }
});

const pie = document.getElementById('miPie').getContext('2d');
const miGrafico = new Chart(pie, {
    type: 'pie',
    data: {
    ...datos
    },
    options: {
        ...opciones
    }
});
</script>
</body>
</html>
