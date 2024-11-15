<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
require_once 'includes/functions.php';
$productos = obtenerProductos();
$config = obtenerConfiguracion();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Inventario</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-slate-800 to-slate-900 min-h-screen">
    <header class="bg-slate-900 text-white p-4 shadow-lg border-b border-slate-700">
        <div class="container mx-auto flex flex-col sm:flex-row justify-between items-center">
            <h1 class="text-2xl font-bold mb-2 sm:mb-0 text-blue-100"><?php echo htmlspecialchars($config['nombre_tienda']); ?> - Gestor de Inventario</h1>
            <div class="flex flex-col sm:flex-row items-center">
                <span class="mb-2 sm:mb-0 sm:mr-4 text-gray-300">Bienvenido, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                <a href="logout.php" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition duration-300">
                    Cerrar sesión
                </a>
            </div>
        </div>
    </header>
    <main class="container mx-auto px-4 py-8">
        <section class="mb-8 flex flex-wrap items-center justify-between">
            <div class="flex flex-wrap mb-4 sm:mb-0">
                <a href="agregar_producto.php" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded inline-block mb-2 sm:mb-0 sm:mr-2 transition duration-300">
                    Agregar Producto
                </a>
                <a href="reportes.php" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-block mb-2 sm:mb-0 sm:mr-2 transition duration-300">
                    Ver Reportes
                </a>
                <a href="exportar.php" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded inline-block mb-2 sm:mb-0 sm:mr-2 transition duration-300">
                    Exportar Datos
                </a>
            </div>
            <div class="flex items-center">
                <input type="text" id="searchInput" placeholder="Buscar productos" 
                       class="px-3 py-2 bg-slate-700 border border-slate-600 rounded-md text-gray-100
                              focus:outline-none focus:ring focus:border-blue-400 mr-2">
                <a href="configuracion.php" class="bg-slate-600 hover:bg-slate-700 text-white font-bold py-2 px-4 rounded inline-block transition duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </section>
        <section class="bg-slate-700 shadow-xl rounded-lg overflow-hidden border border-slate-600">
            <h2 class="text-xl font-semibold p-4 bg-slate-800 text-gray-100 border-b border-slate-600">Lista de Productos</h2>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-slate-800 text-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left">ID</th>
                            <th class="px-4 py-2 text-left">Nombre</th>
                            <th class="px-4 py-2 text-left">Descripción</th>
                            <th class="px-4 py-2 text-left">Precio</th>
                            <th class="px-4 py-2 text-left">Stock</th>
                            <th class="px-4 py-2 text-left">Stock Mínimo</th>
                            <th class="px-4 py-2 text-left">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-100">
                        <?php foreach ($productos as $producto): ?>
                        <tr class="border-b border-slate-600 <?php echo $producto['stock'] <= $producto['stock_minimo'] ? 'bg-red-900/50' : ''; ?> hover:bg-slate-600">
                            <td class="px-4 py-2"><?php echo $producto['id']; ?></td>
                            <td class="px-4 py-2"><?php echo htmlspecialchars($producto['nombre']); ?></td>
                            <td class="px-4 py-2"><?php echo htmlspecialchars($producto['descripcion']); ?></td>
                            <td class="px-4 py-2">$<?php echo number_format($producto['precio'], 2); ?></td>
                            <td class="px-4 py-2"><?php echo $producto['stock']; ?></td>
                            <td class="px-4 py-2"><?php echo $producto['stock_minimo']; ?></td>
                            <td class="px-4 py-2">
                                <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2">
                                    <a href="editar_producto.php?id=<?php echo $producto['id']; ?>" 
                                       class="bg-amber-500 hover:bg-amber-600 text-white font-bold py-1 px-2 rounded text-sm text-center transition duration-300">Editar</a>
                                    <a href="eliminar_producto.php?id=<?php echo $producto['id']; ?>" 
                                       class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-2 rounded text-sm text-center transition duration-300" 
                                       onclick="return confirm('¿Estás seguro de que quieres eliminar este producto?');">Eliminar</a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
    <script>
    document.getElementById('searchInput').addEventListener('input', function() {
        var searchTerm = this.value.toLowerCase();
        var rows = document.querySelectorAll('tbody tr');
        
        rows.forEach(function(row) {
            var productName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            if(productName.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
    </script>
</body>
</html>