<?php
include 'funciones.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'];

    if ($accion === 'agregar') {
        $producto = $_POST['producto'];
        $precio = $_POST['precio'];
        $imagen = $_POST['imagen'];
        agregarAlCarrito($producto, $precio, $imagen);
    } elseif ($accion === 'eliminar') {
        $index = $_POST['index'];
        eliminarDelCarrito($index);
    }
}

header('Content-Type: application/json');
echo json_encode([
    'carrito' => obtenerCarrito(),
    'total' => calcularTotal(),
]);
exit;
?>