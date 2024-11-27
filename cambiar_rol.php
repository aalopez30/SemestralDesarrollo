<?php
session_start(); // Inicia la sesión para acceder a los datos
if (!isset($_SESSION['user_id']) || $_SESSION['user_rol'] != 'admin') {
    header("Location: index.php"); // Si no es admin, redirige al inicio
    exit;
}

include 'conexion.php'; // Incluir la conexión a la base de datos

$id = $_GET['id'];
$sql = "SELECT * FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$usuario = $resultado->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rol = $_POST['rol'];

    $stmt = $conn->prepare("UPDATE usuarios SET rol = ? WHERE id = ?");
    $stmt->bind_param("si", $rol, $id);

    if ($stmt->execute()) {
        header("Location: admin.php");
        exit;
    } else {
        echo "Error al actualizar el rol del usuario.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Rol - Tux Shop</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <header>
        <h1>Cambiar Rol</h1>
    </header>
    <form action="cambiar_rol.php?id=<?php echo $id; ?>" method="POST">
        <label for="rol">Rol</label>
        <select id="rol" name="rol" required>
            <option value="usuario" <?php if ($usuario['rol'] == 'usuario') echo 'selected'; ?>>Usuario</option>
            <option value="admin" <?php if ($usuario['rol'] == 'admin') echo 'selected'; ?>>Administrador</option>
        </select>

        <button type="submit">Actualizar Rol</button>
    </form>
</body>
</html>