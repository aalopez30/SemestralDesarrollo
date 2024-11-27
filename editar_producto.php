<?php
session_start(); // Inicia la sesión para acceder a los datos
if (!isset($_SESSION['user_id']) || $_SESSION['user_rol'] != 'admin') {
    header("Location: index.php"); // Si no es admin, redirige al inicio
    exit;
}

include 'conexion.php'; // Incluir la conexión a la base de datos

$nombre = $_GET['nombre'];
$sql = "SELECT * FROM productos WHERE nombre = ?";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Error en la preparación de la consulta SQL: " . $conn->error);
}
$stmt->bind_param("s", $nombre);
$stmt->execute();
$resultado = $stmt->get_result();
$producto = $resultado->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nuevoNombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    $imagen = $_POST['imagen'];

    // Verificar si el nuevo nombre ya existe
    $sqlVerificar = "SELECT * FROM productos WHERE nombre = ? AND nombre != ?";
    $stmtVerificar = $conn->prepare($sqlVerificar);
    if ($stmtVerificar === false) {
        die("Error en la preparación de la consulta SQL: " . $conn->error);
    }
    $stmtVerificar->bind_param("ss", $nuevoNombre, $nombre);
    $stmtVerificar->execute();
    $resultadoVerificar = $stmtVerificar->get_result();

    if ($resultadoVerificar->num_rows > 0) {
        echo "Error: Ya existe otro producto con el mismo nombre.";
    } else {
        $sql = "UPDATE productos SET nombre = ?, descripcion = ?, precio = ?, cantidad = ?, imagen = ? WHERE nombre = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die("Error en la preparación de la consulta SQL: " . $conn->error);
        }
        $stmt->bind_param("ssdisi", $nuevoNombre, $descripcion, $precio, $cantidad, $imagen, $nombre);

        if ($stmt->execute()) {
            header("Location: admin.php");
            exit;
        } else {
            echo "Error al actualizar el producto: " . $stmt->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto - Tux Shop</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <header>
        <h1>Editar Producto</h1>
    </header>
    <form action="editar_producto.php?nombre=<?php echo $nombre; ?>" method="POST">
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $producto['nombre']; ?>" required>

        <label for="descripcion">Descripción</label>
        <textarea id="descripcion" name="descripcion" required><?php echo $producto['descripcion']; ?></textarea>

        <label for="precio">Precio</label>
        <input type="number" id="precio" name="precio" step="0.01" value="<?php echo $producto['precio']; ?>" required>

        <label for="cantidad">Cantidad</label>
        <input type="number" id="cantidad" name="cantidad" value="<?php echo $producto['cantidad']; ?>" required>

        <label for="imagen">Imagen</label>
        <input type="text" id="imagen" name="imagen" value="<?php echo $producto['imagen']; ?>" required>

        <button type="submit">Actualizar Producto</button>
    </form>
</body>
</html>