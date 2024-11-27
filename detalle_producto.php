<?php
include 'conexion.php'; // Incluir la conexión a la base de datos

// Obtener el nombre del producto desde la URL
$nombreProducto = isset($_GET['nombre']) ? $_GET['nombre'] : '';

// Preparar la consulta para obtener los detalles del producto
$sql = "SELECT * FROM productos WHERE nombre = '$nombreProducto'";
$resultado = $conn->query($sql);

$producto = null;
if ($resultado->num_rows > 0) {
    $producto = $resultado->fetch_assoc();
}

// Cerrar la conexión
$conn->close();
?>

<?php 
include 'funciones.php'; 
session_start(); // Inicia la sesión PHP para poder acceder a $_SESSION
$carrito = obtenerCarrito(); // Obtiene el carrito desde la sesión
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Producto - Tux Shop</title>
    <link rel="stylesheet" href="estilos.css"> <!-- Asegúrate de que la ruta sea correcta -->
    <style>
        .producto-detalle {
            display: flex;
            align-items: flex-start;
            gap: 20px;
            padding: 20px;
        }
        .producto-detalle img {
            max-width: 300px;
            height: auto;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .producto-detalle .detalles {
            max-width: 600px;
        }
        .producto-detalle .detalles h2 {
            margin-top: 0;
        }
    </style>
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

    <div class="producto-detalle">
        <?php if ($producto): ?>
            <img src="<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre']; ?>">
            <div class="detalles">
                <h2><?php echo $producto['nombre']; ?></h2>
                <p><?php echo $producto['descripcion']; ?></p>
                <p>Precio: $<?php echo number_format($producto['precio'], 2); ?></p>
                <button onclick="agregarAlCarrito('<?php echo $producto['nombre']; ?>', <?php echo $producto['precio']; ?>, '<?php echo $producto['imagen']; ?>')">Agregar al carrito</button>
            </div>
        <?php else: ?>
            <p>Producto no encontrado.</p>
        <?php endif; ?>
    </div>

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
        <br>
        <div class="social">
            <h3>Síguenos</h3>
            <ul>
                <li><a href="#">Facebook</a></li>
                <li><a href="#">Twitter</a></li>
            </ul>
        </div>
    </footer>
</body>
</html>