<?php 
include 'funciones.php'; 
session_start(); // Inicia la sesión PHP para poder acceder a $_SESSION

// Si el usuario no está logueado, redirigimos al login
if (!estaLogueado()) {
    // Aseguramos que no haya salida antes de la redirección
    header("Location: login.html");
    exit; // Es importante llamar a exit para evitar que el código continúe ejecutándose
}

$carrito = obtenerCarrito(); // Obtiene el carrito desde la sesión
$total = calcularTotal(); // Calcula el total de la compra
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <!-- Barra Superior -->
    <div class="barra-superior">
        <div class="izquierda">Bienvenido a nuestra tienda online</div>
        <div class="derecha">
            <?php if (estaLogueado()): ?>
                <span>Bienvenido, <?php echo $_SESSION['user_name']; ?> | </span>
                <a href="perfil.php">Mi perfil</a> | 
            <?php else: ?>
                <a href="login.php">Iniciar sesión</a> | 
                <a href="registro.php">Crear una cuenta</a>
            <?php endif; ?>
            <a href="index.php" class="carrito-link">
                Volver al Inicio
            </a>
        </div>
    </div>

    <!-- Encabezado -->
    <div class="banner">
        <header>
            <h1>Carrito de Compras</h1>
        </header>
    </div>

    <main>
        <section class="carrito">
            <ul id="lista-carrito">
                <?php if (empty($carrito)): ?>
                    <li>Tu carrito está vacío.</li>
                <?php else: ?>
                    <?php foreach ($carrito as $index => $item): ?>
                        <li>
                            <img src="<?php echo $item['imagen']; ?>" alt="<?php echo $item['producto']; ?>" width="50">
                            <p><?php echo $item['producto']; ?> - $<?php echo number_format($item['precio'], 2); ?></p>
                            <a href="eliminar_carrito.php?index=<?php echo $index; ?>">Eliminar</a>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
            <p>Total: $<span id="total-carrito"><?php echo number_format($total, 2); ?></span></p>
            <a href="finalizar_compra.php" class="btn">Finalizar Compra</a>
        </section>
    </main>

    <footer>
        <p>© 2024 Tienda de Computadoras. Todos los derechos reservados.</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>
