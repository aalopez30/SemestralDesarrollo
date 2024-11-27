<?php
include 'conexion-inventario.php'; // Incluir la conexión a la base de datos

// Verificar si la conexión se ha establecido correctamente
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Array con productos extraídos del index.php
$productos = [
    ["nombre" => "MacBook Pro", "descripcion" => "Con pantalla Retina", "cantidad" => 10, "precio" => 1999, "imagen" => "mac.png"],
    ["nombre" => "Dell XPS 13", "descripcion" => "Portátil ultraligero", "cantidad" => 15, "precio" => 1599, "imagen" => "dell.png"],
    ["nombre" => "Asus ROG Zephyrus", "descripcion" => "Máximo rendimiento", "cantidad" => 20, "precio" => 2199, "imagen" => "asus.png"],
    ["nombre" => "PC Gamer", "descripcion" => "PC Gamer de alto rendimiento", "cantidad" => 25, "precio" => 500, "imagen" => "pc1.png"],
    ["nombre" => "Laptop Gamer", "descripcion" => "Laptop Gamer de alto rendimiento", "cantidad" => 30, "precio" => 700, "imagen" => "pc2.jpg"],
    ["nombre" => "Tarjeta Grafica", "descripcion" => "Tarjeta gráfica de alto rendimiento", "cantidad" => 40, "precio" => 500, "imagen" => "grafica.jpg"],
    ["nombre" => "Ram", "descripcion" => "Memoria RAM de alta velocidad", "cantidad" => 50, "precio" => 30, "imagen" => "ram.jpg"],
    ["nombre" => "Teclado Gamer", "descripcion" => "Teclado mecánico para gaming", "cantidad" => 60, "precio" => 25, "imagen" => "teclado.jpg"],
    ["nombre" => "Mouse Gamer", "descripcion" => "Mouse gaming de alta precisión", "cantidad" => 70, "precio" => 250, "imagen" => "mouse.webp"],
];

// Insertar cada producto
foreach ($productos as $producto) {
    $nombre = mysqli_real_escape_string($conn, $producto['nombre']);
    $descripcion = mysqli_real_escape_string($conn, $producto['descripcion']);
    $cantidad = (int)$producto['cantidad'];
    $precio = (float)$producto['precio'];
    $imagen = mysqli_real_escape_string($conn, $producto['imagen']);

    $sql = "INSERT INTO productos (nombre, descripcion, cantidad, precio, imagen) VALUES ('$nombre', '$descripcion', $cantidad, $precio, '$imagen')";
    if ($conn->query($sql) === TRUE) {
        echo "Producto $nombre insertado correctamente.<br>";
    } else {
        echo "Error al insertar producto $nombre: " . $conn->error . "<br>";
    }
}

$conn->close();
?>