<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    $producto_id = $_POST['producto_id'];

    // Agregar el ID del producto al carrito
    $_SESSION['carrito'][] = $producto_id;

    // Puedes redirigir al usuario a la página del carrito o a donde prefieras
    header('Location: carrito.php');
    exit;
}
?>
