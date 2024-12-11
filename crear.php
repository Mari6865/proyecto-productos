crear.php
<?php
require_once 'conexion.php';

// Obtener familias de productos
$query = "SELECT cod, nombre FROM familias";
$stmt = $pdo->prepare($query);
$stmt->execute();
$familias = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger datos del formulario
    $codigo = $_POST['cod'];
    $nombre = $_POST['nombre'];
    $familia_id = $_POST['familia'];

    // Insertar el producto
    $query = "INSERT INTO productos (cod, nombre, familia_id) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$codigo, $nombre, $familia_id]);

    header('Location: listado.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Crear Nuevo Producto</h1>
    <form action="crear.php" method="POST">
        <div class="mb-3">
            <label for="codigo" class="form-label">Código</label>
            <input type="text" name="codigo" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="familia" class="form-label">Familia</label>
            <select name="familia" class="form-select" required>
                <?php foreach ($familias as $familia): ?>
                    <option value="<?php echo $familia['cod']; ?>"><?php echo $familia['nombre']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Crear Producto</button>
    </form>
</div>
</body>
</html>
