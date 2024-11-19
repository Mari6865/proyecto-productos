detalle.php
<?php
require_once 'conexion.php';

if (!isset($_GET['id'])) {
    header('Location: listado.php');
    exit();
}

$id = $_GET['id'];

// Obtener detalles del producto
$query = "SELECT p.id, p.codigo, p.nombre, f.nombre AS familia FROM productos p JOIN familias f ON p.familia_id = f.id WHERE p.id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$id]);
$producto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$producto) {
    header('Location: listado.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Detalle del Producto</h1>
    <p><strong>Código:</strong> <?php echo htmlspecialchars($producto['codigo']); ?></p>
    <p><strong>Nombre:</strong> <?php echo htmlspecialchars($producto['nombre']); ?></p>
    <p><strong>Familia:</strong> <?php echo htmlspecialchars($producto['familia']); ?></p>
    <a href="listado.php" class="btn btn-secondary">Volver al Listado</a>
</div>
</body>
</html>
