<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "crud_2019");

// Comprobar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Verificar si el `almacen_id` y `nombreAccesorio` están presentes en el POST
if (isset($_POST['almacen_id']) && !empty($_POST['almacen_id']) && isset($_POST['nombreAccesorio'])) {
    $almacen_id = $_POST['almacen_id'];
    $nombre = $_POST['nombreAccesorio'];
    $modelo = $_POST['modeloAccesorio'];
    $ns = $_POST['nsAccesorio'];
    $condicion = $_POST['condicionAccesorio'];

    // Imprimir el valor de almacen_id para depuración
    echo "almacen_id recibido: " . htmlspecialchars($almacen_id) . "<br>";

    // Comprobar si el `almacen_id` existe en la tabla `almacen`
    $stmt_check = $conexion->prepare("SELECT id FROM almacen WHERE id = ?");
    $stmt_check->bind_param("i", $almacen_id);
    $stmt_check->execute();
    $stmt_check->store_result();
    
    if ($stmt_check->num_rows > 0) {
        // El `almacen_id` existe, proceder con la inserción
        $stmt_check->close();
        
        // Preparar la consulta para insertar los datos en la tabla accesorios
        $stmt = $conexion->prepare("INSERT INTO accesorios (almacen_id, nombre, modelo, ns, condicion) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $almacen_id, $nombre, $modelo, $ns, $condicion);
        
        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Accesorio registrado con éxito.";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error: El ID de almacén no existe.";
    }
    $stmt_check->close();
} else {
    echo "Error: Datos insuficientes proporcionados.";
}

// Cerrar la conexión
$conexion->close();
?>
