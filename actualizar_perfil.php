<?php
session_start(); // Inicia la sesión para acceder a los datos
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Si no está logueado, redirige al login
    exit;
}

include 'conexion.php'; // Incluir la conexión a la base de datos

// Obtener los datos del formulario
$user_id = $_SESSION['user_id'];
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$direccion = $_POST['direccion'];

// Actualizar los datos del usuario en la base de datos
$sql = "UPDATE usuarios SET nombre = '$nombre', email = '$email', direccion = '$direccion' WHERE id = '$user_id'";
if ($conn->query($sql) === TRUE) {
    $_SESSION['user_name'] = $nombre;
    $_SESSION['user_email'] = $email;
    header("Location: perfil.php"); // Redirige al perfil después de actualizar
} else {
    echo "Error al actualizar el perfil: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>