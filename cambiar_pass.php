<?php
session_start();

include_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de datos enviados mediante POST desde AJAX
$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
$nuevaPassword = (isset($_POST['nuevaPassword'])) ? $_POST['nuevaPassword'] : '';

// Validación básica del formulario
if(empty($usuario) || empty($nuevaPassword)) {
    $response = array(
        'status' => false,
        'message' => 'Por favor, completa todos los campos.'
    );
    echo json_encode($response);
    exit;
}

try {
    // Encriptar la nueva contraseña (opcional: utilizar password_hash para seguridad mejorada)
    $hashedPassword = md5($nuevaPassword); // Ejemplo utilizando md5, se recomienda usar password_hash
    
    // Preparar consulta SQL para actualizar la contraseña
    $stmt = $conexion->prepare("UPDATE usuarios SET password = :password WHERE usuario = :usuario");
    $stmt->bindParam(':password', $hashedPassword);
    $stmt->bindParam(':usuario', $usuario);

    // Ejecutar consulta
    if ($stmt->execute()) {
        $response = array(
            'status' => true,
            'message' => 'Contraseña cambiada exitosamente.'
        );
    } else {
        $response = array(
            'status' => false,
            'message' => 'No se pudo cambiar la contraseña. Inténtalo de nuevo más tarde.'
        );
    }
} catch(PDOException $e) {
    $response = array(
        'status' => false,
        'message' => 'Error al conectar a la base de datos: ' . $e->getMessage()
    );
}

// Enviar respuesta JSON
echo json_encode($response);

// Cerrar conexión
$conexion = null;
?>
