<?php
session_start();
require_once 'bd/conexion_login.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $conn = ConexionLogin::Conectar();

    $query = "SELECT id, role FROM users WHERE email = :email AND password = :password";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);

    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['role'] = $row['role'];

        // Redirigir según el rol del usuario
        if ($row['role'] == 'admin') {
            header("Location: dashboard_user.php?mensaje=Inicio%20de%20sesión%20exitoso&tipo=success");
        } else if ($row['role'] == 'user') {
            header("Location: index1.php?mensaje=Inicio%20de%20sesión%20exitoso&tipo=success");
        } else if ($row['role'] == 'cont') {
            header("Location: contador/index.php?mensaje=Inicio%20de%20sesión%20exitoso&tipo=success");
        } else if ($row['role'] == 'calidad') {
            header("Location: calidad/index.php?mensaje=Inicio%20de%20sesión%20exitoso&tipo=success");
        } else {
            header("Location: index.php?mensaje=Rol%20desconocido&tipo=warning");
        }
    } else {
        header("Location: index.php?mensaje=Datos%20incorrectos&tipo=error");
    }

    exit();
}
?>