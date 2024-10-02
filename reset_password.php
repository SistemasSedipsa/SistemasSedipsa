<?php
require_once 'bd/conexion_login.php'; // Asegúrate de que la clase `Conexion` esté bien incluida

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $newPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Verificar el token
    $conexion = new ConexionLogin();
    $conn = $conexion->conectar();
    $stmt = $conn->prepare("SELECT email FROM password_resets WHERE token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $email = $row['email'];

        // Actualizar la contraseña del usuario
        $stmt = $conn->prepare("UPDATE usuarios SET password = ? WHERE email = ?");
        $stmt->bind_param("ss", $newPassword, $email);
        if ($stmt->execute()) {
            echo "Tu contraseña ha sido actualizada correctamente.";
        } else {
            echo "Hubo un error al actualizar tu contraseña.";
        }

        // Eliminar el token utilizado
        $stmt = $conn->prepare("DELETE FROM password_resets WHERE token = ?");
        $stmt->bind_param("s", $token);
        $stmt->execute();
    } else {
        echo "Token inválido o expirado.";
    }
} else if (isset($_GET['token'])) {
    $token = $_GET['token'];
    // Mostrar el formulario para ingresar una nueva contraseña
    echo '
    <form action="reset_password.php" method="POST">
        <input type="hidden" name="token" value="' . $token . '">
        <div class="input-box">
            <input type="password" name="password" required>
            <label>Nueva Contraseña</label>
        </div>
        <button type="submit" class="btn">Actualizar Contraseña</button>
    </form>';
}
?>
