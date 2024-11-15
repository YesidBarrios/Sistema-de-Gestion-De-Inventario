<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
require_once 'includes/functions.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $stock_minimo = $_POST['stock_minimo'] ?? 0; // Valor predeterminado si no se proporciona

    if (agregarProducto($nombre, $descripcion, $precio, $stock, $stock_minimo)) {
        header("Location: index.php");
        exit;
    } else {
        $error = "Error al agregar el producto";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-slate-800 to-slate-900 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-100">Agregar Producto</h1>
            <a href="index.php" class="bg-slate-700 hover:bg-slate-600 text-white font-bold py-2 px-4 rounded transition duration-300">
                Volver
            </a>
        </div>
        <?php if ($error): ?>
            <p class="text-red-400 mb-4"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="agregar_producto.php" method="POST" 
              class="bg-slate-700 shadow-xl rounded-lg px-8 pt-6 pb-8 mb-4 border border-slate-600">
            <div class="mb-4">
                <label class="block text-gray-100 text-sm font-bold mb-2">
                    Nombre del Producto
                </label>
                <input class="w-full px-3 py-2 bg-slate-600 border border-slate-500 rounded-md 
                            text-gray-100 focus:outline-none focus:ring focus:border-blue-400"
                       type="text" name="nombre" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-100 text-sm font-bold mb-2">
                    Descripción
                </label>
                <textarea class="w-full px-3 py-2 bg-slate-600 border border-slate-500 rounded-md 
                       text-gray-100 focus:outline-none focus:ring focus:border-blue-400"
                  name="descripcion" rows="3"></textarea>
            </div>
            <div class="mb-4">
                <label class="block text-gray-100 text-sm font-bold mb-2">
                    Precio
                </label>
                <input class="w-full px-3 py-2 bg-slate-600 border border-slate-500 rounded-md 
                    text-gray-100 focus:outline-none focus:ring focus:border-blue-400"
               type="number" step="0.01" name="precio" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-100 text-sm font-bold mb-2">
                    Stock Actual
                </label>
                <input class="w-full px-3 py-2 bg-slate-600 border border-slate-500 rounded-md 
                    text-gray-100 focus:outline-none focus:ring focus:border-blue-400"
               type="number" name="stock" required>
            </div>
            <div class="mb-6">
                <label class="block text-gray-100 text-sm font-bold mb-2">
                    Stock Mínimo
                </label>
                <input class="w-full px-3 py-2 bg-slate-600 border border-slate-500 rounded-md 
                    text-gray-100 focus:outline-none focus:ring focus:border-blue-400"
               type="number" name="stock_minimo" required>
            </div>
            <div class="flex items-center justify-between">
                <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded 
                             transition duration-300 focus:outline-none focus:shadow-outline" type="submit">
                    Agregar Producto
                </button>
                <a class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded
                          transition duration-300 focus:outline-none focus:shadow-outline" 
                   href="index.php">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</body>
</html>