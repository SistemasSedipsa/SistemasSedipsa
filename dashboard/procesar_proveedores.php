<?php
session_start(); // Iniciar la sesión para usarla más adelante

// Verificar si se ha subido un archivo
if ($_FILES['archivo_excel']['error'] === UPLOAD_ERR_OK) {
    $file_tmp = $_FILES['archivo_excel']['tmp_name'];

    // Validar tipo de archivo
    $file_type = pathinfo($_FILES['archivo_excel']['name'], PATHINFO_EXTENSION);
    if ($file_type != 'csv') {
        $_SESSION['mensaje'] = "Error: Solo se permiten archivos CSV.";
        header('Location: mostrar_proveedores.php');
        exit();
    }

    // Abrir el archivo CSV
    if (($handle = fopen($file_tmp, "r")) !== FALSE) {
        // Conexión a la base de datos
        require_once 'bd/conexion.php';
        $objeto = new Conexion();
        $conexion = $objeto->Conectar();

        // Preparar consulta para insertar datos
        $insertConsulta = "INSERT INTO proveedor (nombre, correo, producto, alta, seleccion, notas) VALUES (:nombre, :correo, :producto, :alta, :seleccion, :notas)";
        $stmtInsert = $conexion->prepare($insertConsulta);

        // Preparar consulta para actualizar datos
        $updateConsulta = "UPDATE proveedor SET nombre = :nombre, correo = :correo, producto = :producto, alta = :alta, seleccion = :seleccion, notas = :notas WHERE id = :id";
        $stmtUpdate = $conexion->prepare($updateConsulta);

        // Preparar consulta para verificar existencia antes de insertar
        $existeConsulta = "SELECT id FROM proveedor WHERE id = :id";
        $stmtExiste = $conexion->prepare($existeConsulta);

        // Leer y procesar el archivo CSV
        $header = fgetcsv($handle); // Leer encabezados
        while (($row = fgetcsv($handle)) !== FALSE) {
            // Asignar los valores a variables
            $id = $row[0]; // Suponiendo que la primera columna contiene el ID
            $nombre = $row[1];
            $correo = $row[2];
            $producto = $row[3];
            $alta = $row[4];
            $seleccion = $row[5];
            $notas = $row[6];

            // Verificar si el registro ya existe en proveedor
            $stmtExiste->bindParam(':id', $id);
            $stmtExiste->execute();
            $resultado = $stmtExiste->fetch(PDO::FETCH_ASSOC);

            if ($resultado) {
                // Ejecutar consulta para actualizar proveedor
                $stmtUpdate->bindParam(':id', $id);
                $stmtUpdate->bindParam(':nombre', $nombre);
                $stmtUpdate->bindParam(':correo', $correo);
                $stmtUpdate->bindParam(':producto', $producto);
                $stmtUpdate->bindParam(':alta', $alta);
                $stmtUpdate->bindParam(':seleccion', $seleccion);
                $stmtUpdate->bindParam(':notas', $notas);

                // Ejecutar la consulta de actualización
                $stmtUpdate->execute();
            } else {
                // Ejecutar consulta para inserción en proveedor
                $stmtInsert->bindParam(':nombre', $nombre);
                $stmtInsert->bindParam(':correo', $correo);
                $stmtInsert->bindParam(':producto', $producto);
                $stmtInsert->bindParam(':alta', $alta);
                $stmtInsert->bindParam(':seleccion', $seleccion);
                $stmtInsert->bindParam(':notas', $notas);

                // Ejecutar la consulta de inserción
                $stmtInsert->execute();
            }
        }

        fclose($handle);
        $_SESSION['mensaje'] = "Registros Guardados";
        header('Location: mostrar_proveedores.php');
        exit();
    } else {
        $_SESSION['mensaje'] = "Error al abrir el archivo CSV";
        header('Location: mostrar_proveedores.php');
        exit();
    }
} else {
    $_SESSION['mensaje'] = "Error al subir el archivo CSV";
    header('Location: mostrar_proveedores.php');
    exit();
}
?>
