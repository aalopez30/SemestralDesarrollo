<?php
session_start(); // Inicia la sesión
include('conexion.php'); // Incluye tu archivo de conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura los datos del formulario
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hashear la contraseña
    $rol = 'usuario'; // Establece el rol por defecto como 'usuario'

    // Verificar si los campos no están vacíos
    if (empty($nombre) || empty($email) || empty($password)) {
        echo "Por favor, completa todos los campos.";
        exit;
    }

    // Verificar si el email ya está registrado
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        // Si el email ya está registrado
        echo "El email ya está registrado.";
    } else {
        // Si el email no está registrado, insertar el nuevo usuario
        $stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, password, rol) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nombre, $email, $password, $rol);

        // Verifica que la ejecución no falle
        if ($stmt->execute()) {
            // Obtener el ID del usuario recién creado
            $userId = $conn->insert_id;

            // Guardar datos del usuario en la sesión
            $_SESSION['user_id'] = $userId;
            $_SESSION['user_name'] = $nombre;
            $_SESSION['user_email'] = $email;
            $_SESSION['user_rol'] = $rol;

            // Redirigir a la página principal después del registro exitoso
            header("Location: index.php");
            exit;
        } else {
            echo "Error al registrar el usuario.";
        }
    }
}
?>