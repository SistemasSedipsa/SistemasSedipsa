<?php
require_once './bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $archivoId = $_POST['archivo_id'];
    
    $nuevoArchivoPdf = 'uploads/' . basename($_FILES['nuevo_archivo_pdf']['name']);
    move_uploaded_file($_FILES['nuevo_archivo_pdf']['tmp_name'], $nuevoArchivoPdf);

    $consulta = "UPDATE archivo_almacen SET archivo_pdf = ? WHERE id = ?";
    $stmt = $conexion->prepare($consulta);
    $stmt->execute([$nuevoArchivoPdf, $archivoId]);
    
    header('Location: index.php');
}
?>
