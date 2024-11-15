<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require_once 'includes/functions.php';

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_tienda = $_POST['nombre_tienda'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];

    if (guardarConfiguracion($nombre_tienda, $direccion, $telefono, $email)) {
        $mensaje = "Configuración guardada con éxito.";
    } else {
        $mensaje = "Error al guardar la configuración.";
    }
}

$config = obtenerConfiguracion();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración - Gestor de Inventario</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-slate-800 to-slate-900 min-h-screen">
    <header class="bg-slate-900 text-white p-4 shadow-lg border-b border-slate-700">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold text-blue-100">Configuración de la Tienda</h1>
            <a href="index.php" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300">
                Volver al Inicio
            </a>
        </div>
    </header>
    <main class="container mx-auto px-4 py-8">
        <?php if ($mensaje): ?>
            <div class="bg-emerald-900/50 border border-emerald-600 text-emerald-100 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline"><?php echo $mensaje; ?></span>
            </div>
        <?php endif; ?>
        <section class="bg-slate-700 shadow-xl rounded-lg overflow-hidden border border-slate-600">
            <h2 class="text-xl font-semibold p-4 bg-slate-800 text-gray-100 border-b border-slate-600">Configuración de la Tienda</h2>
            <form action="configuracion.php" method="POST" class="p-4">
                <div class="mb-4">
                    <label class="block text-gray-100 text-sm font-bold mb-2">Nombre de la Tienda:</label>
                    <input type="text" name="nombre_tienda" 
                           value="<?php echo htmlspecialchars($config['nombre_tienda']); ?>" 
                           class="w-full px-3 py-2 bg-slate-600 border border-slate-500 rounded-md 
                                  text-gray-100 focus:outline-none focus:ring focus:border-blue-400">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-100 text-sm font-bold mb-2">Dirección:</label>
                    <input type="text" name="direccion" 
                           value="<?php echo htmlspecialchars($config['direccion']); ?>" 
                           class="w-full px-3 py-2 bg-slate-600 border border-slate-500 rounded-md 
                                  text-gray-100 focus:outline-none focus:ring focus:border-blue-400">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-100 text-sm font-bold mb-2">Teléfono:</label>
                    <input type="tel" name="telefono" 
                           value="<?php echo htmlspecialchars($config['telefono']); ?>" 
                           class="w-full px-3 py-2 bg-slate-600 border border-slate-500 rounded-md 
                                  text-gray-100 focus:outline-none focus:ring focus:border-blue-400">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-100 text-sm font-bold mb-2">Email:</label>
                    <input type="email" name="email" 
                           value="<?php echo htmlspecialchars($config['email']); ?>" 
                           class="w-full px-3 py-2 bg-slate-600 border border-slate-500 rounded-md 
                                  text-gray-100 focus:outline-none focus:ring focus:border-blue-400">
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded 
                                   transition duration-300 focus:outline-none focus:shadow-outline">
                        Guardar Configuración
                    </button>
                </div>
            </form>
        </section>
    </main>
</body>
</html>