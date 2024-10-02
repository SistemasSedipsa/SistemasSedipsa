<?php
require_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $proveedor_id = $_GET['proveedor_id'];

    $consulta = "SELECT id, proveedor_id, nombre, correo, producto, alta, seleccion, notas FROM proveedor_eq WHERE proveedor_id = ?";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute([$proveedor_id]);
    $proveedores = $resultado->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($proveedores);
}