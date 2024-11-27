<?php
session_start(); // Inicia la sesión para acceder a los datos
if (!isset($_SESSION['user_id']) || $_SESSION['user_rol'] != 'admin') {
    header("Location: index.php"); // Si no es admin, redirige al inicio
    exit;
}

include 'conexion.php'; // Incluir la conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    $imagen = $_POST['imagen'];

    $stmt = $conn->prepare("INSERT INTO productos (nombre, descripcion, precio, cantidad, imagen) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdis", $nombre, $descripcion, $precio, $cantidad, $imagen);

    if ($stmt->execute()) {
        header("Location: admin.php");
        exit;
    } else {
        echo "Error al agregar el producto.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto - Tux Shop</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <header>
        <h1>Agregar Producto</h1>
    </header>
    <form action="agregar_producto.php" method="POST">
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="descripcion">Descripción</label>
        <textarea id="descripcion" name="descripcion" required></textarea>

        <label for="precio">Precio</label>
        <input type="number" id="precio" name="precio" step="0.01" required>

        <label for="cantidad">Cantidad</label>
        <input type="number" id="cantidad" name="cantidad" required>

        <label for="imagen">Imagen</label>
        <input type="text" id="imagen" name="imagen" required>

        <button type="submit">Agregar Producto</button>
    </form>
</body>
</html>