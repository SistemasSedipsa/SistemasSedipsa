<?php
require_once '../bd/conexion_login.php';  // Corrige la ruta

session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: ../dashboard_user.php");
    exit();
}

$conexion = new ConexionLogin();
$conn = $conexion->Conectar();

$mensaje = "";
$tipo = "info";  // Valor por defecto

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = isset($_POST['action']) ? $_POST['action'] : '';
    
    // Debugging: Mostrar los valores de la solicitud POST
    // var_dump($_POST); exit;

    if ($action == 'edit' && !empty($_POST['email']) && !empty($_POST['id'])) {
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];
        $role = $_POST['role'];
        $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);

        if (filter_var($email, FILTER_VALIDATE_EMAIL) && $id !== false) {
            // Si la contraseña no está vacía, actualizarla en la base de datos
            $sql = "UPDATE users SET email = :email, role = :role" . ($password ? ", password = :password" : "") . " WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':role', $role);
            if ($password) {
                $stmt->bindParam(':password', $password);
            }
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                $mensaje = "Usuario actualizado exitosamente.";
                $tipo = "success";
            } else {
                $mensaje = "Error al actualizar el usuario.";
                $tipo = "error";
            }
        } else {
            $mensaje = "Email o ID inválido.";
            $tipo = "error";
        }

    } elseif ($action == 'delete' && !empty($_POST['id'])) {
        $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);

        // Debugging: Verificar el valor del ID
        // var_dump($id); exit;

        if ($id !== false) {
            $sql = "DELETE FROM users WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                $mensaje = "Usuario eliminado exitosamente.";
                $tipo = "success";
            } else {
                $mensaje = "Error al eliminar el usuario.";
                $tipo = "error";
            }
        } else {
            $mensaje = "ID inválido.";
            $tipo = "error";
        }

    } elseif ($action == 'add' && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['role'])) {
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];
        $role = $_POST['role'];

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $sql = "INSERT INTO users (email, password, role) VALUES (:email, :password, :role)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':role', $role);
            if ($stmt->execute()) {
                $mensaje = "Usuario agregado exitosamente.";
                $tipo = "success";
            } else {
                $mensaje = "Error al agregar el usuario.";
                $tipo = "error";
            }
        } else {
            $mensaje = "Email inválido.";
            $tipo = "error";
        }
    } else {
        $mensaje = "Acción no válida o datos faltantes.";
        $tipo = "error";
    }

    header("Location: ../dashboard_user.php?mensaje=" . urlencode($mensaje) . "&tipo=" . urlencode($tipo));
    exit();
}
?>
