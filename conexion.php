<?php
$host = 'localhost';
$db = 'usuariostux'; // Nombre de tu base de datos
$user = 'root'; // Usuario de MySQL (por defecto en XAMPP es 'root')
$pass = ''; // Contraseña (por defecto en XAMPP es vacío)

try {
    // Crear una instancia PDO para conectarse a la base de datos
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
