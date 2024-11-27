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
    <link rel="stylesheet" href="estilos.css">
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
</body>
</html>