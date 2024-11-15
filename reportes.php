<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
require_once 'includes/functions.php';
$productos = obtenerProductos();

// Cálculos para el reporte
$total_productos = count($productos);
$valor_total_inventario = array_sum(array_map(function($p) { return $p['precio'] * $p['stock']; }, $productos));
$productos_bajos = count(array_filter($productos, function($p) { return $p['stock'] <= $p['stock_minimo']; }));
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes - Gestor de Inventario</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gradient-to-br from-slate-800 to-slate-900 min-h-screen">
    <header class="bg-slate-900 text-white p-4 shadow-lg border-b border-slate-700">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold text-blue-100">Reportes de Inventario</h1>
            <a href="index.php" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300">
                Volver al Inicio
            </a>
        </div>
    </header>
    <main class="container mx-auto px-4 py-8">
        <section class="bg-slate-700 shadow-xl rounded-lg overflow-hidden mb-8 border border-slate-600">
            <h2 class="text-xl font-semibold p-4 bg-slate-800 text-gray-100 border-b border-slate-600">
                Resumen del Inventario
            </h2>
            <div class="p-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-slate-800/50 p-4 rounded-lg border border-blue-500/30">
                    <h3 class="font-bold text-lg text-gray-100">Total de Productos</h3>
                    <p class="text-3xl font-bold text-blue-400"><?php echo $total_productos; ?></p>
                </div>
                <div class="bg-slate-800/50 p-4 rounded-lg border border-emerald-500/30">
                    <h3 class="font-bold text-lg text-gray-100">Valor Total del Inventario</h3>
                    <p class="text-3xl font-bold text-emerald-400">$<?php echo number_format($valor_total_inventario, 2); ?></p>
                </div>
                <div class="bg-slate-800/50 p-4 rounded-lg border border-red-500/30">
                    <h3 class="font-bold text-lg text-gray-100">Productos con Stock Bajo</h3>
                    <p class="text-3xl font-bold text-red-400"><?php echo $productos_bajos; ?></p>
                </div>
            </div>
        </section>
        <section class="bg-slate-700 shadow-xl rounded-lg overflow-hidden mb-8 border border-slate-600">
            <h2 class="text-xl font-semibold p-4 bg-slate-800 text-gray-100 border-b border-slate-600">
                Gráfico de Inventario
            </h2>
            <div class="p-4">
                <canvas id="inventarioChart"></canvas>
            </div>
        </section>
    </main>
    <script>
    var ctx = document.getElementById('inventarioChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode(array_map(function($p) { return $p['nombre']; }, $productos)); ?>,
            datasets: [{
                label: 'Stock Actual',
                data: <?php echo json_encode(array_map(function($p) { return $p['stock']; }, $productos)); ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }, {
                label: 'Stock Mínimo',
                data: <?php echo json_encode(array_map(function($p) { return $p['stock_minimo']; }, $productos)); ?>,
                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                legend: {
                    labels: {
                        color: '#e2e8f0' // text-gray-100
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#475569' // slate-600
                    },
                    ticks: {
                        color: '#e2e8f0' // text-gray-100
                    }
                },
                x: {
                    grid: {
                        color: '#475569' // slate-600
                    },
                    ticks: {
                        color: '#e2e8f0' // text-gray-100
                    }
                }
            }
        }
    });
    </script>
</body>
</html>