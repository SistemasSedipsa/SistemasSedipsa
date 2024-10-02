<?php
$host = 'localhost';
$dbname = 'crud_2019';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT nombre, correo, producto, alta, seleccion, notas FROM proveedores_seleccionados";
    $stmt = $pdo->query($sql);

    $registros = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($registros);

} catch (PDOException $e) {
    echo json_encode(['error' => 'Error al conectar a la base de datos: ' . $e->getMessage()]);
}
?>
