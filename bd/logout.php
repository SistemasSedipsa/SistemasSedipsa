<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit();
}

// Deshabilitar caché del navegador para evitar volver a la página después de cerrar sesión
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Fecha en el pasado
header("Pragma: no-cache"); // HTTP/1.0

require_once './bd/conexion_login.php';