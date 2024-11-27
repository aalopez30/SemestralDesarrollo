<?php
include 'conexion-inventario.php'; // Incluir la conexión a la base de datos

// Verificar si la conexión se ha establecido correctamente
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Array con productos de prueba (productos de tecnología)
$productos = [
    ["nombre" => "Laptop Dell XPS 13", "descripcion" => "Laptop ultradelgada con procesador Intel i7, 16GB RAM, 512GB SSD", "cantidad" => 10, "precio" => 1500],
    ["nombre" => "Monitor Samsung 24''", "descripcion" => "Monitor Full HD de 24 pulgadas, 75Hz, con puertos HDMI y VGA", "cantidad" => 15, "precio" => 250],
    ["nombre" => "Teclado mecánico Corsair K95", "descripcion" => "Teclado mecánico RGB, switches Cherry MX, con retroiluminación RGB", "cantidad" => 30, "precio" => 120],
    ["nombre" => "Auriculares Bose QuietComfort 35", "descripcion" => "Auriculares inalámbricos con cancelación activa de ruido, batería de 20 horas", "cantidad" => 25, "precio" => 350],
    ["nombre" => "Ratón Logitech G502", "descripcion" => "Ratón gaming con 11 botones programables, sensor HERO 25K", "cantidad" => 50, "precio" => 80],
    ["nombre" => "SSD Kingston A2000 1TB", "descripcion" => "Disco sólido NVMe de 1TB, velocidad de lectura de 2200 MB/s", "cantidad" => 40, "precio" => 100],
    ["nombre" => "Router TP-Link Archer AX50", "descripcion" => "Router Wi-Fi 6 de alto rendimiento con puertos gigabit", "cantidad" => 60, "precio" => 130],
    ["nombre" => "Webcam Logitech C920", "descripcion" => "Cámara web Full HD 1080p, ideal para videoconferencias y streaming", "cantidad" => 35, "precio" => 75],
];

// Insertar cada producto
foreach ($productos as $producto) {
    $nombre = mysqli_real_escape_string($conn, $producto['nombre']);
    $descripcion = mysqli_real_escape_string($conn, $producto['descripcion']);
    $cantidad = (int)$producto['cantidad'];
    $precio = (float)$producto['precio'];

    $sql = "INSERT INTO productos (nombre, descripcion, cantidad, precio) VALUES ('$nombre', '$descripcion', $cantidad, $precio)";
    if ($conn->query($sql) === TRUE) {
        echo "Producto $nombre insertado correctamente.<br>";
    } else {
        echo "Error al insertar producto $nombre: " . $conn->error . "<br>";
    }
}

$conn->close();
?>