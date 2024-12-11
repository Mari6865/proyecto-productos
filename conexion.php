conexion.php
<?php
$host = 'localhost:3307'; // Cambiar según tu configuración
$dbname = 'proyecto'; // Nombre de la base de datos
$username = 'root'; // Usuario de la base de datos
$password = 'abc123.'; // Contraseña de la base de datos

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Configurar el manejo de errores
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    die();
}
?>
