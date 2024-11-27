
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
    <title>Tux Shop</title>
    <link rel="stylesheet" href="estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <!-- Barra Superior -->
    <div class="barra-superior">
        <div class="izquierda">Bienvenido a nuestra tienda online</div>
        <div class="derecha">
            <?php if (estaLogueado()): ?>
                <span>Bienvenido, <?php echo $_SESSION['user_name']; ?> | </span>
                <a href="perfil.php">Mi perfil</a> | 
                <a href="logout.php">Cerrar sesión</a> |
            <?php else: ?>
                <a href="login.html">Iniciar sesión</a> | 
                <a href="registro.html">Crear una cuenta</a> |
            <?php endif; ?>
            <a href="carrito-usuario.php" class="carrito-link">
                Carrito (<span id="numero-carrito"><?php echo count($carrito); ?></span>)
            </a>
        </div>
    </div>

    <!-- Encabezado -->
    <header>
        <h1>Tux Shop</h1>
        <input type="text" placeholder="Buscar en la tienda...">
    </header>

    <!-- Menú de Navegación -->
    <nav>
        <ul>
            <li><a href="#">Inicio</a></li>
            <li><a href="#">Productos</a></li>
            <li><a href="#">Blog</a></li>
            <li><a href="#">Nosotros</a></li>
            <li><a href="#">Contacto</a></li>
        </ul>
    </nav>

    <!-- Banner Principal (Carrusel) -->
    <div id="carrusel" class="banner">
        <div class="productos-container">
            <div class="producto-carrusel active">
                <h2>MacBook Pro</h2>
                <img src="mac.png" alt="MacBook Pro">
                <p>Con pantalla Retina por solo <span>$1999</span></p>
                <button onclick="agregarAlCarrito('MacBook Pro', 1999, 'mac.png')">Agregar al carrito</button>
            </div>
            <div class="producto-carrusel">
                <h2>Dell XPS 13</h2>
                <img src="dell.png" alt="Dell XPS 13">
                <p>Portátil ultraligero por <span>$1599</span></p>
                <button onclick="agregarAlCarrito('Dell XPS 13', 1599, 'dell.png')">Agregar al carrito</button>
            </div>
            <div class="producto-carrusel">
                <h2>Asus ROG Zephyrus</h2>
                <img src="asus.png" alt="Asus ROG Zephyrus">
                <p>Máximo rendimiento por <span>$2199</span></p>
                <button onclick="agregarAlCarrito('Asus ROG Zephyrus', 2199, 'asus.png')">Agregar al carrito</button>
            </div>
        </div>
        <button class="boton-carrusel izquierdo">&#10094;</button>
        <button class="boton-carrusel derecho">&#10095;</button>
    </div>
    
    <img src="separacion.png" height="22px">

    <!-- Productos Destacados -->
    <section class="productos">
        <h2>Productos Destacados</h2>
        <div class="grid-productos">
            <div class="producto">
                <img src="pc1.png" alt="PC 1">
                <h3>PC Gamer</h3>
                <p>$500.00</p>
                <button onclick="agregarAlCarrito('PC Gamer', 500, 'pc1.png')">Agregar al carrito</button>
            </div>
            <div class="producto">
                <img src="pc2.jpg" alt="Laptop 1">
                <h3>Laptop Gamer</h3>
                <p>$700.00</p>
                <button onclick="agregarAlCarrito('Laptop Gamer', 700, 'pc2.jpg')">Agregar al carrito</button>
            </div>
            <div class="producto">
                <img src="https://cdn.panacompu.com/cdn-img/pv/824142319192-1.jpg?width=550&height=400&fixedwidthheight=false" alt="Grafica">
                <h3>Tarjeta Grafica</h3>
                <p>$500.00</p>
                <button onclick="agregarAlCarrito('Tarjeta Grafica', 500, 'https://cdn.panacompu.com/cdn-img/pv/824142319192-1.jpg?width=550&height=400&fixedwidthheight=false')">Agregar al carrito</button>
            </div>
            <div class="producto">
                <img src="https://m.media-amazon.com/images/I/61XmhmEup8L._AC_SL1000_.jpg" alt="Ram">
                <h3>Ram</h3>
                <p>$30.00</p>
                <button onclick="agregarAlCarrito('Ram','30','https://m.media-amazon.com/images/I/61XmhmEup8L._AC_SL1000_.jpg')">Agregar al carrito</button>
            </div>
            <div class="producto">
                <img src="https://dojiw2m9tvv09.cloudfront.net/9549/product/redtec0409674.jpg" alt="Teclado Gamer">
                <h3>Teclado Gamer</h3>
                <p>$25.00</p>
                <button onclick="agregarAlCarrito('Teclado Gamer','25','https://dojiw2m9tvv09.cloudfront.net/9549/product/redtec0409674.jpg')">Agregar al carrito</button>
            </div>
            <div class="producto">
                <img src="https://www.apcomputadores.com/wp-content/uploads/mouse-gamer-logitech-g502x.jpg.webp" alt="Mouse Gamer">
                <h3>Mouse Gamer</h3>
                <p>$250.00</p>
                <button onclick="agregarAlCarrito('Mouse Gamer','250','https://www.apcomputadores.com/wp-content/uploads/mouse-gamer-logitech-g502x.jpg.webp')">Agregar al carrito</button>
            </div>
            <!-- Añade más productos según sea necesario -->
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

    <script>
// Selecciona todos los productos del carrusel
const productos = document.querySelectorAll(".producto-carrusel");
const container = document.querySelector(".productos-container");
let indiceActivo = 0;

// Función para actualizar el producto activo
function mostrarProducto(indice) {
    // Remueve la clase 'active' de todos los productos
    productos.forEach((producto) => {
        producto.classList.remove("active");
    });
    
    // Agrega la clase 'active' al producto que corresponde al índice
    productos[indice].classList.add("active");
    
    // Desplaza el contenedor para mostrar el producto activo
    container.style.transform = `translateX(-${indice * 100}%)`;
}

// Botones del carrusel
const botonIzquierdo = document.querySelector(".boton-carrusel.izquierdo");
const botonDerecho = document.querySelector(".boton-carrusel.derecho");

botonIzquierdo.addEventListener("click", () => {
    indiceActivo = (indiceActivo - 1 + productos.length) % productos.length;
    mostrarProducto(indiceActivo);
    reiniciarCambioAutomatico(); // Reinicia el contador cuando se cambia manualmente
});

botonDerecho.addEventListener("click", () => {
    indiceActivo = (indiceActivo + 1) % productos.length;
    mostrarProducto(indiceActivo);
    reiniciarCambioAutomatico(); // Reinicia el contador cuando se cambia manualmente
});

// Mostrar el primer producto al cargar la página
mostrarProducto(indiceActivo);

// Cambio automático cada 5 segundos
let intervalo;
function iniciarCambioAutomatico() {
    intervalo = setInterval(() => {
        indiceActivo = (indiceActivo + 1) % productos.length;
        mostrarProducto(indiceActivo);
    }, 5000); // Cambia cada 5 segundos
}

// Detener el cambio automático cuando el usuario interactúa
function reiniciarCambioAutomatico() {
    clearInterval(intervalo);
    iniciarCambioAutomatico();
}

iniciarCambioAutomatico(); // Inicia el cambio automático desde el principio
    </script>

    <script src="script.js"></script>
</body>
</html>