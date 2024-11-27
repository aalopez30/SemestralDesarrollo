<?php
include('conexion.php'); // Incluye tu archivo de conexión a la base de datos
session_start(); // Inicia la sesión PHP

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura los datos del formulario
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Buscar el usuario en la base de datos
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar si el usuario existe y si la contraseña es correcta
    if ($user && password_verify($password, $user['password'])) {
        // Iniciar la sesión del usuario
        $_SESSION['user_id'] = $user['id']; // Guardamos el ID del usuario en la sesión
        $_SESSION['user_name'] = $user['nombre']; // Guardamos el nombre del usuario
        $_SESSION['user_email'] = $user['email']; // Guardamos el email del usuario

        // Redirigir al perfil del usuario
        header("Location: index.php"); // Página del perfil del usuario
        exit;
    } else {
        echo "Email o contraseña incorrectos.";
    }
}
?>
