update.php 
<?php
require_once 'conexion.php';

if (!isset($_GET['id'])) {
    header('Location: listado.php');
    exit();
}

$id = $_GET['id'];

// Obtener el producto
$query = "SELECT * FROM productos WHERE id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$id]);
$producto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$producto) {
    header('Location: listado.php');
    exit();
}

// Obtener familias
$query_familias = "SELECT id, nombre FROM familias";
$stmt_familias = $pdo->prepare($query_familias);
$stmt_familias->execute();
$familias = $stmt_familias->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger datos del formulario
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $familia_id = $_POST['familia'];

    // Actualizar producto
    $query_update = "UPDATE productos SET codigo = ?, nombre = ?, familia_id = ? WHERE id = ?";
    $stmt_update = $pdo->prepare($query_update);
    $stmt_update->execute([$codigo, $nombre, $familia_id, $id]);

    header('Location: listado.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
