<?php
session_start(); // Inicia la sesión para acceder a los datos
if (!isset($_SESSION['user_id']) || $_SESSION['user_rol'] != 'admin') {
    header("Location: index.php"); // Si no es admin, redirige al inicio
    exit;
}

include 'conexion.php'; // Incluir la conexión a la base de datos

$id = $_GET['id'];
$sql = "DELETE FROM productos WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: admin.php");
    exit;
} else {
    echo "Error al eliminar el producto.";
}
?>