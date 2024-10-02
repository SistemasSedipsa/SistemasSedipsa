<?php
include './bd/conexion_login.php';

session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: dashboard_user.php");
    exit();
}

$conexion = new Conexion();
$conn = $conexion->Conectar();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $new_password = $_POST['new_password']; // Hash de la nueva contraseña

    $sql = "UPDATE users SET password = ? WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$new_password, $email]);

    echo "Contraseña actualizada exitosamente.";
}
?>