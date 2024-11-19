borrar.php
<?php
require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    // Obtener el ID del producto a borrar
    $id = $_POST['id'];

    // Eliminar el producto de la base de datos
    $query = "DELETE FROM productos WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);

    // Redirigir a la página de listado con un mensaje de éxito
    $mensaje = "Producto eliminado con éxito.";
} else {
    // Si no se recibe un ID o no es una petición POST, redirigir al listado
    header('Location: listado.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Producto Borrado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Producto Borrado</h1>
    <p class="alert alert-success"><?php echo htmlspecialchars($mensaje); ?></p>
    <a href="listado.php" class="btn btn-primary">Volver al Listado</a>
</div>
</body>
</html>
