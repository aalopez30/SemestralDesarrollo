<?php
session_start(); // Inicia la sesión para acceder a los datos
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Si no está logueado, redirige al login
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - Tux Shop</title>
</head>
<body>
    <h1>Bienvenido, <?php echo $_SESSION['user_name']; ?>!</h1>
    <p>Tu correo electrónico: <?php echo $_SESSION['user_email']; ?></p>
    <a href="logout.php">Cerrar sesión</a>
</body>
</html>
