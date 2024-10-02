<?php
require_once 'bd/conexion_login.php'; // Asegúrate de que la clase `Conexion` esté bien incluida

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Verificar si el correo existe en la base de datos
    $conexion = new ConexionLogin();
    $conn = $conexion->conectar();
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bindParam(1, $email);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $token = bin2hex(random_bytes(50));
        $stmt = $conn->prepare("INSERT INTO password_resets (email, token) VALUES (?, ?)");
        $stmt->bindParam(1, $email);
        $stmt->bindParam(2, $token);
        $stmt->execute();

        // Enviar correo electrónico con el enlace de recuperación
        $resetLink = "http://localhost/Proyecto/reset_password.php?token=" . $token;
        $subject = "Recuperar tu contraseña";
        $message = "Haz clic en el siguiente enlace para recuperar tu contraseña: " . $resetLink;
        $headers = "From: sistemas@sedipsasteel.com.mx";

        if (mail($email, $subject, $message, $headers)) {
            echo "Se ha enviado un enlace de recuperación a tu correo electrónico.";
        } else {
            echo "Hubo un error al enviar el correo electrónico.";
        }
    } else {
        echo "El correo electrónico no está registrado.";
    }
}
?>
