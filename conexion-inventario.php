<?php
// Datos de conexión a la base de datos
$servidor = "localhost";  // Cambia si usas otro servidor
$usuario = "root";        // Tu usuario de MySQL
$clave = "";              // Tu clave de MySQL (vacío por defecto en localhost)
$base_de_datos = "tienda"; // El nombre de tu base de datos

// Crear la conexión
$conn = new mysqli($servidor, $usuario, $clave, $base_de_datos);

// Verificar la conexión
if ($conn->connect_error) {
    die("La conexión ha fallado: " . $conn->connect_error);
}
?>
