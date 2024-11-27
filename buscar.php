<?php
include 'conexion.php';

// Datos del producto
$nombre = "MacBook Pro";
$descripcion = "Laptop con pantalla Retina y procesador M1";
$precio = 1999.00;
$cantidad = 10;
$imagen = "macbook_pro.png";

// Insertar producto en la base de datos
$sql = "INSERT INTO productos (nombre, descripcion, precio, cantidad, imagen)
        VALUES ('$nombre', '$descripcion', $precio, $cantidad, '$imagen')";

// Ejecutar la consulta
if ($conn->query($sql) === TRUE) {
    echo "Producto insertado correctamente";
} else {
    echo "Error al insertar producto: " . $conn->error;
}

$conn->close();
?>
