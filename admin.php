<?php
session_start(); // Inicia la sesión para acceder a los datos
if (!isset($_SESSION['user_id']) || $_SESSION['user_rol'] != 'admin') {
    header("Location: index.php"); // Si no es admin, redirige al inicio
    exit;
}

include 'conexion.php'; // Incluir la conexión a la base de datos unificada

// Obtener la lista de productos
$sqlProductos = "SELECT * FROM productos";
$resultadoProductos = $conn->query($sqlProductos);
if ($resultadoProductos === false) {
    die("Error en la consulta SQL de productos: " . $conn->error);
}

// Obtener la lista de usuarios
$sqlUsuarios = "SELECT * FROM usuarios";
$resultadoUsuarios = $conn->query($sqlUsuarios);
if ($resultadoUsuarios === false) {
    die("Error en la consulta SQL de usuarios: " . $conn->error);
}

// Obtener la lista de pedidos
$sqlPedidos = "SELECT * FROM pedidos";
$resultadoPedidos = $conn->query($sqlPedidos);
if ($resultadoPedidos === false) {
    die("Error en la consulta SQL de pedidos: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración - Tux Shop</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <!-- Barra Superior -->
    <div class="barra-superior">
        <div class="izquierda">Panel de Administración</div>
        <div class="derecha">
            <span>Bienvenido, <?php echo $_SESSION['user_name']; ?> | </span>
            <a href="index.php">Inicio</a> |
            <a href="logout.php">Cerrar sesión</a>
        </div>
    </div>

    <!-- Encabezado -->
    <header>
        <h1>Panel de Administración</h1>
    </header>

    <!-- Gestión de Productos -->
    <section class="admin-seccion">
        <h2>Gestión de Productos</h2>
        <a href="agregar_producto.php" class="btn">Agregar Producto</a>
        <table>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Acciones</th>
            </tr>
            <?php while ($producto = $resultadoProductos->fetch_assoc()): ?>
            <tr>
                <td><?php echo $producto['nombre']; ?></td>
                <td><?php echo $producto['descripcion']; ?></td>
                <td><?php echo $producto['precio']; ?></td>
                <td><?php echo $producto['cantidad']; ?></td>
                <td>
                    <a href="editar_producto.php?nombre=<?php echo $producto['nombre']; ?>" class="btn">Editar</a>
                    <a href="eliminar_producto.php?nombre=<?php echo $producto['nombre']; ?>" class="btn">Eliminar</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </section>

    <!-- Gestión de Usuarios -->
    <section class="admin-seccion">
        <h2>Gestión de Usuarios</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
            <?php while ($usuario = $resultadoUsuarios->fetch_assoc()): ?>
            <tr>
                <td><?php echo $usuario['id']; ?></td>
                <td><?php echo $usuario['nombre']; ?></td>
                <td><?php echo $usuario['email']; ?></td>
                <td><?php echo $usuario['rol']; ?></td>
                <td>
                    <a href="cambiar_rol.php?id=<?php echo $usuario['id']; ?>" class="btn">Cambiar Rol</a>
                    <a href="eliminar_usuario.php?id=<?php echo $usuario['id']; ?>" class="btn">Eliminar</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </section>

    <!-- Gestión de Pedidos -->
    <section class="admin-seccion">
        <h2>Gestión de Pedidos</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
            <?php while ($pedido = $resultadoPedidos->fetch_assoc()): ?>
            <tr>
                <td><?php echo $pedido['id']; ?></td>
                <td><?php echo $pedido['usuario_id']; ?></td>
                <td><?php echo $pedido['producto_nombre']; ?></td>
                <td><?php echo $pedido['cantidad']; ?></td>
                <td><?php echo $pedido['estado']; ?></td>
                <td>
                    <a href="actualizar_pedido.php?id=<?php echo $pedido['id']; ?>" class="btn">Actualizar</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
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
</body>
</html>