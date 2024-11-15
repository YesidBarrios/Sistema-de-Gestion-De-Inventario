<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require_once 'includes/functions.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];

if (eliminarProducto($id)) {
    header('Location: index.php');
    exit;
} else {
    echo "Error al eliminar el producto";
}?>