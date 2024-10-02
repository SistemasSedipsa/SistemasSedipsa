<?php
session_start(); // Iniciar la sesión para usarla más adelante

// Verificar si se ha subido un archivo
if ($_FILES['archivo_excel']['error'] === UPLOAD_ERR_OK) {
    $file_tmp = $_FILES['archivo_excel']['tmp_name'];

    // Validar tipo de archivo
    $file_type = pathinfo($_FILES['archivo_excel']['name'], PATHINFO_EXTENSION);
    if ($file_type != 'csv') {
        $_SESSION['mensaje'] = "Error: Solo se permiten archivos CSV.";
        header('Location: equipo.php');
        exit();
    }

    // Abrir el archivo CSV
    if (($handle = fopen($file_tmp, "r")) !== FALSE) {
        // Conexión a la base de datos
        require_once 'bd/conexion.php';
        $objeto = new Conexion();
        $conexion = $objeto->Conectar();

        // Preparar consulta para insertar datos
        $insertConsulta = "INSERT INTO equipos (id, equipo, talla, entrada, unidades, precio, salida, salida_unidad, personal, restantes, proveedor) VALUES (:id, :equipo, :talla, :entrada, :unidades, :precio, :salida, :salida_unidad, :personal, :restantes, :proveedor)";
        $stmtInsert = $conexion->prepare($insertConsulta);

        // Preparar consulta para actualizar datos
        $updateConsulta = "UPDATE equipos SET equipo = :equipo, talla = :talla, entrada = :entrada, unidades = :unidades, precio = :precio, salida = :salida, salida_unidad = :salida_unidad, personal = :personal, restantes = :restantes, proveedor = :proveedor WHERE id = :id";
        $stmtUpdate = $conexion->prepare($updateConsulta);

        // Preparar consulta para verificar existencia antes de insertar
        $existeConsulta = "SELECT COUNT(*) AS num_rows FROM equipos WHERE id = :id";
        $stmtExiste = $conexion->prepare($existeConsulta);

        // Leer y procesar el archivo CSV
        $header = fgetcsv($handle); // Leer encabezados
        while (($row = fgetcsv($handle)) !== FALSE) {
            // Asignar los valores a variables
            $id = $row[0];
            $equipo = $row[1];
            $talla = $row[2];
            $entrada = $row[3];
            $unidades = $row[4];
            $precio = $row[5];
            $salida = $row[6];
            $salida_unidad = $row[7];
            $personal = $row[8];
            $restantes = $row[9];
            $proveedor = $row[10];

            // Verificar si el registro ya existe
            $stmtExiste->bindParam(':id', $id);
            $stmtExiste->execute();
            $resultado = $stmtExiste->fetch(PDO::FETCH_ASSOC);

            if ($resultado['num_rows'] > 0) {
                // Ejecutar consulta para actualizar
                $stmtUpdate->bindParam(':id', $id);
                $stmtUpdate->bindParam(':equipo', $equipo);
                $stmtUpdate->bindParam(':talla', $talla);
                $stmtUpdate->bindParam(':entrada', $entrada);
                $stmtUpdate->bindParam(':unidades', $unidades);
                $stmtUpdate->bindParam(':precio', $precio);
                $stmtUpdate->bindParam(':salida', $salida);
                $stmtUpdate->bindParam(':salida_unidad', $salida_unidad);
                $stmtUpdate->bindParam(':personal', $personal);
                $stmtUpdate->bindParam(':restantes', $restantes);
                $stmtUpdate->bindParam(':proveedor', $proveedor);

                // Ejecutar la consulta de actualización
                $stmtUpdate->execute();
            } else {
                // Ejecutar consulta para inserción
                $stmtInsert->bindParam(':id', $id);
                $stmtInsert->bindParam(':equipo', $equipo);
                $stmtInsert->bindParam(':talla', $talla);
                $stmtInsert->bindParam(':entrada', $entrada);
                $stmtInsert->bindParam(':unidades', $unidades);
                $stmtInsert->bindParam(':precio', $precio);
                $stmtInsert->bindParam(':salida', $salida);
                $stmtInsert->bindParam(':salida_unidad', $salida_unidad);
                $stmtInsert->bindParam(':personal', $personal);
                $stmtInsert->bindParam(':restantes', $restantes);
                $stmtInsert->bindParam(':proveedor', $proveedor);

                // Ejecutar la consulta de inserción
                $stmtInsert->execute();
            }
        }

        fclose($handle);
        $_SESSION['mensaje'] = "Registros Guardados";
        header('Location: equipo.php');
        exit();
    } else {
        $_SESSION['mensaje'] = "Error al abrir el archivo CSV";
        header('Location: equipo.php');
        exit();
    }
} else {
    $_SESSION['mensaje'] = "Error al subir el archivo CSV";
    header('Location: equipo.php');
    exit();
}
?>
