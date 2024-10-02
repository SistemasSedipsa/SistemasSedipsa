<?php
require 'SimpleXLSXGen.php'; // Asegúrate de que esta ruta apunte al archivo SimpleXLSXGen.php

use Shuchkin\SimpleXLSXGen;

// Configura la conexión a la base de datos
$dsn = 'mysql:host=localhost;dbname=crud_2019';
$username = 'root';
$password = '';
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die('Error de conexión: ' . $e->getMessage());
}

// Consulta para obtener los datos de la tabla principal con accesorios concatenados
$sql = "SELECT almacen.*, GROUP_CONCAT(CONCAT(accesorios.nombre, ' (Modelo: ', accesorios.modelo, ', NS: ', accesorios.ns, ', Condición: ', accesorios.condicion, ')') ORDER BY accesorios.nombre SEPARATOR ', ') AS accesorios FROM almacen LEFT JOIN accesorios ON almacen.id = accesorios.accesorio_id GROUP BY almacen.id"; // Asegúrate de ajustar los nombres de las columnas y tablas según tu esquema
$stmt = $pdo->prepare($sql);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($data)) {
    header('Location: almacen.php');
    exit;
}

// Preparar datos para el archivo Excel
$header = array_keys($data[0]);
$rows = array_map('array_values', $data);
array_unshift($rows, $header);

// Crear el archivo Excel
$xlsx = SimpleXLSXGen::fromArray($rows);
$filename = 'Programa_Calibracion_2024.xlsx';

header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Length: ' . strlen($xlsx));
header('Cache-Control: max-age=0');

// Enviar el archivo Excel al navegador
$xlsx->saveAs('php://output');
exit;
?>
