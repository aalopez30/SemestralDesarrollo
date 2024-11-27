<?php
session_start();
$productos = isset($_SESSION['resultados_busqueda']) ? $_SESSION['resultados_busqueda'] : [];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados de Búsqueda - Tux Shop</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <!-- Barra Superior -->
    <div class="barra-superior">
        <div class="izquierda">Bienvenido a nuestra tienda online</div>
        <div class="derecha">
            <?php if (isset($_SESSION['user_name'])): ?>
                <span>Bienvenido, <?php echo $_SESSION['user_name']; ?> | </span>
                <a href="perfil.php">Mi perfil</a> | 
                <a href="logout.php">Cerrar sesión</a> |
            <?php else: ?>
                <a href="login.html">Iniciar sesión</a> | 
                <a href="registro.html">Crear una cuenta</a> |
            <?php endif; ?>
            <a href="carrito-usuario.php" class="carrito-link">
                Carrito (<span id="numero-carrito"><?php echo count($_SESSION['carrito'] ?? []); ?></span>)
            </a>
        </div>
    </div>

    <!-- Encabezado -->
    <header>
        <h1>Tux Shop</h1>
        <form action="buscar.php" method="GET">
            <input type="text" name="buscar" placeholder="Buscar producto" value="">
            <button type="submit">Buscar</button>
        </form>
    </header>

    <!-- Resultados de Búsqueda -->
    <section class="productos">
        <h2>Resultados de Búsqueda</h2>
        <div class="grid-productos">
            <?php if (empty($productos)): ?>
                <p>No se encontraron productos que coincidan con tu búsqueda.</p>
            <?php else: ?>
                <?php foreach ($productos as $producto): ?>
                    <div class="producto">
                        <img src="<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre']; ?>">
                        <h3><?php echo $producto['nombre']; ?></h3>
                        <p><?php echo $producto['descripcion']; ?></p>
                        <p>$<?php echo number_format($producto['precio'], 2); ?></p>
                        <button onclick="agregarAlCarrito('<?php echo $producto['nombre']; ?>', <?php echo $producto['precio']; ?>, '<?php echo $producto['imagen']; ?>')">Agregar al carrito</button>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
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