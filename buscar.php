<?php
include 'conexion-inventario.php'; // Incluir la conexión a la base de datos

// Obtener el término de búsqueda
$buscar = isset($_GET['buscar']) ? $_GET['buscar'] : '';

// Preparar la consulta de búsqueda
$sql = "SELECT * FROM productos WHERE nombre LIKE '%$buscar%' OR descripcion LIKE '%$buscar%' ORDER BY nombre LIMIT 5";

$resultado = $conn->query($sql);

$productos = [];
if ($resultado->num_rows > 0) {
    // Guardar los productos encontrados en un array
    while ($producto = $resultado->fetch_assoc()) {
        $productos[] = $producto;
    }
}

// Cerrar la conexión
$conn->close();

// Redirigir a la página de resultados con los productos encontrados
session_start();
$_SESSION['resultados_busqueda'] = $productos;
header("Location: resultados_busqueda.php");
exit;
?>