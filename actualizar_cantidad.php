<?php
include 'conexion.php';

// Obtener el nombre del producto y la cantidad a reducir (por ejemplo, del carrito)
$nombre_producto = "MacBook Pro"; // Debes obtenerlo dinámicamente del carrito
$cantidad_comprada = 1; // También debes obtener la cantidad del carrito

// Actualizar la cantidad disponible
$sql = "UPDATE productos SET cantidad = cantidad - $cantidad_comprada WHERE nombre = '$nombre_producto'";

if ($conn->query($sql) === TRUE) {
    echo "Cantidad actualizada correctamente";
} else {
    echo "Error al actualizar la cantidad: " . $conn->error;
}

$conn->close();
?>
