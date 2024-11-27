<?php
include 'conexion-inventario.php'; // Incluir la conexión a la base de datos

// Obtener el término de búsqueda
$buscar = isset($_GET['buscar']) ? $_GET['buscar'] : '';

// Preparar la consulta de búsqueda
$sql = "SELECT * FROM productos WHERE nombre LIKE '%$buscar%' OR descripcion LIKE '%$buscar%' ORDER BY nombre LIMIT 5";

$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    // Mostrar los productos encontrados
    while ($producto = $resultado->fetch_assoc()) {
        echo "<div>";
        echo "<h3>".$producto['nombre']."</h3>";
        echo "<p>".$producto['descripcion']."</p>";
        echo "<p><strong>Cantidad disponible:</strong> ".$producto['cantidad']."</p>";
        echo "<p><strong>Precio:</strong> $".$producto['precio']."</p>";
        echo "</div><br>";
    }
} else {
    echo "No se encontraron productos que coincidan con tu búsqueda.";
}

$conn->close();
?>