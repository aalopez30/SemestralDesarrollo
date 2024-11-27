<?php
include('conexion.php'); // Incluye tu archivo de conexión a la base de datos
session_start(); // Inicia la sesión PHP

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura los datos del formulario
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Buscar el usuario en la base de datos
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $user = $resultado->fetch_assoc();

    // Verificar si el usuario existe y si la contraseña es correcta
    if ($user && password_verify($password, $user['password'])) {
        // Iniciar la sesión del usuario
        $_SESSION['user_id'] = $user['id']; // Guardamos el ID del usuario en la sesión
        $_SESSION['user_name'] = $user['nombre']; // Guardamos el nombre del usuario
        $_SESSION['user_email'] = $user['email']; // Guardamos el email del usuario
        $_SESSION['user_rol'] = $user['rol']; // Guardamos el rol del usuario

        // Redirigir al perfil del usuario
        header("Location: index.php");
        exit;
    } else {
        echo "Email o contraseña incorrectos.";
    }
}
?>