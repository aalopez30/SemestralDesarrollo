<?php
session_start(); // Inicia la sesión para acceder a los datos
if (!isset($_SESSION['user_id']) || $_SESSION['user_rol'] != 'admin') {
    header("Location: index.php"); // Si no es admin, redirige al inicio
    exit;
}

include 'conexion-inventario.php'; // Incluir la conexión a la base de datos

$id = $_GET['id'];
$sql = "SELECT * FROM pedidos WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$pedido = $resultado->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $estado = $_POST['estado'];

    $stmt = $conn->prepare("UPDATE pedidos SET estado = ? WHERE id = ?");
    $stmt->bind_param("si", $estado, $id);

    if ($stmt->execute()) {
        header("Location: admin.php");
        exit;
    } else {
        echo "Error al actualizar el pedido.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Pedido - Tux Shop</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <header>
        <h1>Actualizar Pedido</h1>
    </header>
    <form action="actualizar_pedido.php?id=<?php echo $id; ?>" method="POST">
        <label for="estado">Estado</label>
        <select id="estado" name="estado" required>
            <option value="pendiente" <?php if ($pedido['estado'] == 'pendiente') echo 'selected'; ?>>Pendiente</option>
            <option value="enviado" <?php if ($pedido['estado'] == 'enviado') echo 'selected'; ?>>Enviado</option>
            <option value="entregado" <?php if ($pedido['estado'] == 'entregado') echo 'selected'; ?>>Entregado</option>
        </select>

        <button type="submit">Actualizar Pedido</button>
    </form>
</body>
</html>