<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inventario_supermercado";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function obtenerProductos() {
    global $conn;
    $sql = "SELECT * FROM productos ORDER BY id ASC";
    $result = $conn->query($sql);
    $productos = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $productos[] = $row;
        }
    }
    return $productos;
}

function agregarProducto($nombre, $descripcion, $precio, $stock, $stock_minimo) {
    global $conn;
    $sql = "INSERT INTO productos (nombre, descripcion, precio, stock, stock_minimo) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdii", $nombre, $descripcion, $precio, $stock, $stock_minimo);
    return $stmt->execute();
}

function obtenerProductoPorId($id) {
    global $conn;
    $sql = "SELECT * FROM productos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function actualizarProducto($id, $nombre, $descripcion, $precio, $stock, $stock_minimo) {
    global $conn;
    $sql = "UPDATE productos SET nombre = ?, descripcion = ?, precio = ?, stock = ?, stock_minimo = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdiis", $nombre, $descripcion, $precio, $stock, $stock_minimo, $id);
    return $stmt->execute();
}

function eliminarProducto($id) {
    global $conn;
    $sql = "DELETE FROM productos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}

function obtenerConfiguracion() {
    global $conn;
    $sql = "SELECT * FROM configuracion LIMIT 1";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        return $result->fetch_assoc();
    }
    // Si no hay configuración, devolver valores por defecto
    return [
        'nombre_tienda' => 'Mi Tienda',
        'direccion' => 'Dirección no configurada',
        'telefono' => 'Teléfono no configurado',
        'email' => 'Email no configurado'
    ];
}

function guardarConfiguracion($nombre_tienda, $direccion, $telefono, $email) {
    global $conn;
    $sql = "UPDATE configuracion SET 
            nombre_tienda = ?, 
            direccion = ?, 
            telefono = ?, 
            email = ? 
            WHERE id = 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nombre_tienda, $direccion, $telefono, $email);
    return $stmt->execute();
}

// Función para verificar las credenciales del usuario
function verificarCredenciales($username, $password) {
    global $conn;
    $sql = "SELECT id, username, password FROM usuarios WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            return $user;
        }
    }
    return false;
}
?>