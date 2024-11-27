<?php
session_start(); // Inicia la sesión para acceder a los datos
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Si no está logueado, redirige al login
    exit;
}

include 'conexion.php'; // Incluir la conexión a la base de datos

// Verificar si la conexión se ha establecido correctamente
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos del usuario desde la base de datos
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM usuarios WHERE id = '$user_id'";
$resultado = $conn->query($sql);

if ($resultado === false) {
    die("Error en la consulta SQL: " . $conn->error);
}

if ($resultado->num_rows > 0) {
    $usuario = $resultado->fetch_assoc();
} else {
    echo "Usuario no encontrado.";
    exit;
}

// Cerrar la conexión
$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - Tux Shop</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <!-- Barra Superior -->
    <div class="barra-superior">
        <div class="izquierda">Bienvenido a nuestra tienda online</div>
        <div class="derecha">
            <span>Bienvenido, <?php echo $_SESSION['user_name']; ?> | </span>
            <a href="perfil.php">Mi perfil</a> | 
            <a href="index.php">Inicio</a> |
            <a href="carrito-usuario.php" class="carrito-link">
                Carrito (<span id="numero-carrito"><?php echo count($_SESSION['carrito'] ?? []); ?></span>)
            </a>
        </div>
    </div>

    <!-- Encabezado -->
    <header>
        <h1>Tux Shop</h1>
        <form action="buscar.php" method="GET" style="margin-left: auto;">
            <input type="text" name="buscar" placeholder="Buscar producto" value="">
            <button type="submit">Buscar</button>
        </form>
    </header>

    <!-- Contenido del Perfil -->
    <section class="perfil">
        <h2>Perfil de Usuario</h2>
        <form action="actualizar_perfil.php" method="POST">
            <p><strong>Nombre:</strong> <input type="text" name="nombre" value="<?php echo $usuario['nombre']; ?>"></p>
            <p><strong>Correo electrónico:</strong> <input type="email" name="email" value="<?php echo $usuario['email']; ?>"></p>
            <p><strong>Dirección:</strong> <input type="text" name="direccion" value="<?php echo $usuario['direccion']; ?>"></p>
            <button type="submit" class="btn">Actualizar</button>
        </form>
        <a href="logout.php" class="btn">Cerrar sesión</a>
    </section>

    <!-- Footer -->
    <footer>
        <div class="info">
            <h3>Información</h3>
            <ul>
                <li><a href="#">Contacto</a></li>
                <li><a href="#">Términos</a></li>
                <li><a href="#">Política de Privacidad</a></li>
            </ul>
        </div>
        <div class="social">
            <h3>Síguenos</h3>
            <ul>
                <li><a href="#">Facebook</a></li>
                <li><a href="#">Twitter</a></li>
            </ul>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>