<?php
session_start();

include_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
$password = (isset($_POST['password'])) ? $_POST['password'] : '';

$pass_encriptada = md5($password);

$consulta = "SELECT * FROM usuarios WHERE usuario = :usuario";
$resultado = $conexion->prepare($consulta);
$resultado->bindParam(':usuario', $usuario, PDO::PARAM_STR);
$resultado->execute();

if ($resultado->rowCount() == 0) {
    $consulta = "INSERT INTO usuarios (usuario, password) VALUES (:usuario, :password)";
    $statement = $conexion->prepare($consulta);
    $statement->bindParam(':usuario', $usuario, PDO::PARAM_STR);
    $statement->bindParam(':password', $pass_encriptada, PDO::PARAM_STR);

    if ($statement->execute()) {
        $_SESSION["s_usuario"] = $usuario;
        $response = array('status' => true, 'message' => 'Usuario registrado correctamente');
    } else {
        $response = array('status' => false, 'message' => 'Error al registrar el usuario');
    }
} else {
    $response = array('status' => false, 'message' => 'El usuario ya existe en la base de datos');
}

print json_encode($response);

$conexion = null;
?>