<?php
// funciones.php
function agregarAlCarrito($producto, $precio, $imagen) {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }
    $_SESSION['carrito'][] = ['producto' => $producto, 'precio' => $precio, 'imagen' => $imagen];
}

function obtenerCarrito() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    return $_SESSION['carrito'] ?? [];
}

function eliminarDelCarrito($index) {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_SESSION['carrito'][$index])) {
        array_splice($_SESSION['carrito'], $index, 1);
    }
}

function calcularTotal() {
    $carrito = obtenerCarrito();
    $total = 0;
    foreach ($carrito as $item) {
        $total += $item['precio'];
    }
    return $total;
}

// Función para verificar si el usuario está logueado
function estaLogueado() {
    return isset($_SESSION['user_id']);
}

?>

