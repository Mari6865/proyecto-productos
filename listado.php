listado.php
<?php
require_once 'conexion.php';

// Obtener productos
$query = "SELECT id, codigo, nombre FROM productos";
$stmt = $pdo->prepare($query);
$stmt->execute();
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Listado de Productos</h1>
    <a href="crear.php" class="btn btn-primary mb-3">Nuevo Producto</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $producto): ?>
                <tr>
                    <td><?php echo htmlspecialchars($producto['codigo']); ?></td>
                    <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                    <td>
                        <a href="detalle.php?id=<?php echo $producto['id']; ?>" class="btn btn-info btn-sm">Ver</a>
                        <a href="update.php?id=<?php echo $producto['id']; ?>" class="btn btn-warning btn-sm">Actualizar</a>

                        <!-- Formulario para borrar producto -->
                        <form action="borrar.php" method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas borrar este producto?');">Borrar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
