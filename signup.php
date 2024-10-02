<?php
session_start();
require_once 'bd/conexion_login.php';  // Incluir la nueva clase de conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password =$_POST['password'];  // Encriptar la contraseña

    $conn = ConexionLogin::Conectar();  // Utilizar la nueva clase para conectar

    // Verificar si el correo ya está registrado
    $query = "SELECT id FROM users WHERE email = :email";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "El correo electrónico ya está registrado.";
    } else {
        // Insertar el nuevo usuario en la base de datos
        $query = "INSERT INTO users (email, password, role) VALUES (:email, :password, 'user')";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);

        if ($stmt->execute()) {
            echo "Usuario registrado exitosamente.";
            // Opcionalmente, podrías iniciar la sesión aquí
            $_SESSION['user_id'] = $conn->lastInsertId();
            $_SESSION['role'] = 'user';
            header("Location: index.php");
        } else {
            echo "Hubo un error al registrar el usuario.";
        }
    }
}
?>
