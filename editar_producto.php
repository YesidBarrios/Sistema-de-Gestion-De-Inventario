<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
require_once 'includes/functions.php';

$error = '';
$producto = null;

if (isset($_GET['id'])) {
    $producto = obtenerProductoPorId($_GET['id']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $stock_minimo = $_POST['stock_minimo'] ?? $producto['stock_minimo']; // Usa el valor existente si no se proporciona uno nuevo

    if (actualizarProducto($id, $nombre, $descripcion, $precio, $stock, $stock_minimo)) {
        header("Location: index.php");
        exit;
    } else {
        $error = "Error al actualizar el producto";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-slate-800 to-slate-900 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-100">Editar Producto</h1>
            <a href="index.php" class="bg-slate-700 hover:bg-slate-600 text-white font-bold py-2 px-4 rounded transition duration-300">
                Volver
            </a>
        </div>
        <?php if ($error): ?>
            <p class="text-red-400 mb-4"><?php echo $error; ?></p>
        <?php endif; ?>
        <?php if ($producto): ?>
            <form action="editar_producto.php" method="POST" 
                  class="bg-slate-700 shadow-xl rounded-lg px-8 pt-6 pb-8 mb-4 border border-slate-600">
                <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
                <div class="mb-4">
                    <label class="block text-gray-100 text-sm font-bold mb-2" for="nombre">
                        Nombre
                    </label>
                    <input class="w-full px-3 py-2 bg-slate-600 border border-slate-500 rounded-md 
                                text-gray-100 focus:outline-none focus:ring focus:border-blue-400"
                           id="nombre" type="text" name="nombre" value="<?php echo htmlspecialchars($producto['nombre']); ?>" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-100 text-sm font-bold mb-2" for="descripcion">
                        Descripción
                    </label>
                    <textarea class="w-full px-3 py-2 bg-slate-600 border border-slate-500 rounded-md 
                                    text-gray-100 focus:outline-none focus:ring focus:border-blue-400"
                              id="descripcion" name="descripcion"><?php echo htmlspecialchars($producto['descripcion']); ?></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-100 text-sm font-bold mb-2" for="precio">
                        Precio
                    </label>
                    <input class="w-full px-3 py-2 bg-slate-600 border border-slate-500 rounded-md 
                                text-gray-100 focus:outline-none focus:ring focus:border-blue-400"
                           id="precio" type="number" step="0.01" name="precio" value="<?php echo $producto['precio']; ?>" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-100 text-sm font-bold mb-2" for="stock">
                        Stock
                    </label>
                    <input class="w-full px-3 py-2 bg-slate-600 border border-slate-500 rounded-md 
                                text-gray-100 focus:outline-none focus:ring focus:border-blue-400"
                           id="stock" type="number" name="stock" value="<?php echo $producto['stock']; ?>" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-100 text-sm font-bold mb-2" for="stock_minimo">
                        Stock Mínimo
                    </label>
                    <input class="w-full px-3 py-2 bg-slate-600 border border-slate-500 rounded-md 
                                text-gray-100 focus:outline-none focus:ring focus:border-blue-400"
                           id="stock_minimo" type="number" name="stock_minimo" value="<?php echo $producto['stock_minimo']; ?>" required>
                </div>
                <div class="flex items-center justify-between">
                    <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded 
                                 transition duration-300 focus:outline-none focus:shadow-outline" type="submit">
                        Actualizar Producto
                    </button>
                    <a class="text-blue-400 hover:text-blue-300 font-bold transition duration-300" 
                       href="index.php">Cancelar</a>
                </div>
            </form>
        <?php else: ?>
            <p class="text-red-400">Producto no encontrado.</p>
        <?php endif; ?>
    </div>
</body>
</html>