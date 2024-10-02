<?php
session_start(); // Iniciar la sesión para usarla más adelante

// Verificar si se ha subido un archivo
if ($_FILES['archivo_excel']['error'] === UPLOAD_ERR_OK) {
    $file_tmp = $_FILES['archivo_excel']['tmp_name'];

    // Validar tipo de archivo
    $file_type = pathinfo($_FILES['archivo_excel']['name'], PATHINFO_EXTENSION);
    if ($file_type != 'csv') {
        $_SESSION['mensaje'] = "Error: Solo se permiten archivos CSV.";
        header('Location: index.php');
        exit();
    }

    // Abrir el archivo CSV
    if (($handle = fopen($file_tmp, "r")) !== FALSE) {
        // Conexión a la base de datos
        require_once 'bd/conexion.php';
        $objeto = new Conexion();
        $conexion = $objeto->Conectar();

        // Preparar consulta para insertar datos
        $insertConsulta = "INSERT INTO almacen (num_int, descripcion, metodo, serie, inventario, modelo, marca, accesorios, calibracion, verificacion, ultima, informe, proxima, status_c, ubicacion, prueba, condiciones, observaciones, situacion, bodega, archivo_pdf) VALUES (:num_int, :descripcion, :metodo, :serie, :inventario, :modelo, :marca, :accesorios, :calibracion, :verificacion, :ultima, :informe, :proxima, :status_c, :ubicacion, :prueba, :condiciones, :observaciones, :situacion, :bodega, :archivo_pdf)";
        $stmtInsert = $conexion->prepare($insertConsulta);

        // Preparar consulta para actualizar datos
        $updateConsulta = "UPDATE almacen SET descripcion = :descripcion, metodo = :metodo, serie = :serie, inventario = :inventario, modelo = :modelo, marca = :marca, accesorios = :accesorios, calibracion = :calibracion, verificacion = :verificacion, ultima = :ultima, informe = :informe, proxima = :proxima, status_c = :status_c, ubicacion = :ubicacion, prueba = :prueba, condiciones = :condiciones, observaciones = :observaciones, situacion = :situacion, bodega = :bodega, archivo_pdf = :archivo_pdf WHERE num_int = :num_int";
        $stmtUpdate = $conexion->prepare($updateConsulta);

        // Preparar consulta para verificar existencia antes de insertar
        $existeConsulta = "SELECT COUNT(*) AS num_rows FROM almacen WHERE num_int = :num_int";
        $stmtExiste = $conexion->prepare($existeConsulta);

        // Leer y procesar el archivo CSV
        $header = fgetcsv($handle); // Leer encabezados
        while (($row = fgetcsv($handle)) !== FALSE) {
            // Asignar los valores a variables
            $num_int = $row[1];
            $descripcion = $row[2];
            $metodo = $row[3];
            $serie = $row[4];
            $inventario = $row[5];
            $modelo = $row[6];
            $marca = $row[7];
            $accesorios = $row[8];
            $calibracion = $row[9];
            $verificacion = $row[10];
            $ultima = $row[11];
            $informe = $row[12];
            $proxima = $row[13];
            $status_c = $row[14];
            $ubicacion = $row[15];
            $prueba = $row[16];
            $condiciones = $row[17];
            $observaciones = $row[18];
            $situacion = $row[19];
            $bodega = $row[20];
            $archivo_pdf = ''; // Asignar un valor predeterminado

            // Verificar si el registro ya existe
            $stmtExiste->bindParam(':num_int', $num_int);
            $stmtExiste->execute();
            $resultado = $stmtExiste->fetch(PDO::FETCH_ASSOC);

            if ($resultado['num_rows'] > 0) {
                // Ejecutar consulta para actualizar
                $stmtUpdate->bindParam(':num_int', $num_int);
                $stmtUpdate->bindParam(':descripcion', $descripcion);
                $stmtUpdate->bindParam(':metodo', $metodo);
                $stmtUpdate->bindParam(':serie', $serie);
                $stmtUpdate->bindParam(':inventario', $inventario);
                $stmtUpdate->bindParam(':modelo', $modelo);
                $stmtUpdate->bindParam(':marca', $marca);
                $stmtUpdate->bindParam(':accesorios', $accesorios);
                $stmtUpdate->bindParam(':calibracion', $calibracion);
                $stmtUpdate->bindParam(':verificacion', $verificacion);
                $stmtUpdate->bindParam(':ultima', $ultima);
                $stmtUpdate->bindParam(':informe', $informe);
                $stmtUpdate->bindParam(':proxima', $proxima);
                $stmtUpdate->bindParam(':status_c', $status_c);
                $stmtUpdate->bindParam(':ubicacion', $ubicacion);
                $stmtUpdate->bindParam(':prueba', $prueba);
                $stmtUpdate->bindParam(':condiciones', $condiciones);
                $stmtUpdate->bindParam(':observaciones', $observaciones);
                $stmtUpdate->bindParam(':situacion', $situacion);
                $stmtUpdate->bindParam(':bodega', $bodega);
                $stmtUpdate->bindParam(':archivo_pdf', $archivo_pdf);

                // Ejecutar la consulta de actualización
                $stmtUpdate->execute();
            } else {
                // Ejecutar consulta para inserción
                $stmtInsert->bindParam(':num_int', $num_int);
                $stmtInsert->bindParam(':descripcion', $descripcion);
                $stmtInsert->bindParam(':metodo', $metodo);
                $stmtInsert->bindParam(':serie', $serie);
                $stmtInsert->bindParam(':inventario', $inventario);
                $stmtInsert->bindParam(':modelo', $modelo);
                $stmtInsert->bindParam(':marca', $marca);
                $stmtInsert->bindParam(':accesorios', $accesorios);
                $stmtInsert->bindParam(':calibracion', $calibracion);
                $stmtInsert->bindParam(':verificacion', $verificacion);
                $stmtInsert->bindParam(':ultima', $ultima);
                $stmtInsert->bindParam(':informe', $informe);
                $stmtInsert->bindParam(':proxima', $proxima);
                $stmtInsert->bindParam(':status_c', $status_c);
                $stmtInsert->bindParam(':ubicacion', $ubicacion);
                $stmtInsert->bindParam(':prueba', $prueba);
                $stmtInsert->bindParam(':condiciones', $condiciones);
                $stmtInsert->bindParam(':observaciones', $observaciones);
                $stmtInsert->bindParam(':situacion', $situacion);
                $stmtInsert->bindParam(':bodega', $bodega);
                $stmtInsert->bindParam(':archivo_pdf', $archivo_pdf);

                // Ejecutar la consulta de inserción
                $stmtInsert->execute();
            }
        }

        fclose($handle);
        $_SESSION['mensaje'] = "Registros Guardados";
        header('Location: index.php');
        exit();
    } else {
        $_SESSION['mensaje'] = "Error al abrir el archivo CSV";
        header('Location: index.php');
        exit();
    }
} else {
    $_SESSION['mensaje'] = "Error al subir el archivo CSV";
    header('Location: index.php');
    exit();
}
?>
