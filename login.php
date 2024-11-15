<?php
session_start();
require_once 'includes/db.php';
require_once 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $conn = conectarDB();
    $sql = "SELECT id, username, password FROM usuarios WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: index.php");
            exit;
        } else {
            $error = "Credenciales incorrectas";
        }
    } else {
        $error = "Credenciales incorrectas";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Gestor de Inventario</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-800">
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-slate-800 to-slate-900">
        <div class="bg-slate-700 p-8 rounded-lg shadow-xl w-96 border border-slate-600">
            <h1 class="text-2xl font-bold mb-6 text-center text-gray-100">Login</h1>
            <?php if (isset($error)): ?>
                <p class="text-red-400 mb-4 text-center"><?php echo $error; ?></p>
            <?php endif; ?>
            <form action="login.php" method="POST">
                <div class="mb-4">
                    <label for="username" class="block text-gray-200 font-bold mb-2">Usuario:</label>
                    <input type="text" id="username" name="username" required 
                           class="w-full px-3 py-2 bg-slate-600 border border-slate-500 rounded-md 
                                  focus:outline-none focus:ring focus:border-blue-400 text-gray-100">
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-gray-200 font-bold mb-2">Contraseña:</label>
                    <input type="password" id="password" name="password" required 
                           class="w-full px-3 py-2 bg-slate-600 border border-slate-500 rounded-md 
                                  focus:outline-none focus:ring focus:border-blue-400 text-gray-100">
                </div>
                <button type="submit" 
                        class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded 
                               hover:bg-blue-700 focus:outline-none focus:shadow-outline">
                    Iniciar sesión
                </button>
            </form>
        </div>
    </div>
</body>
</html>