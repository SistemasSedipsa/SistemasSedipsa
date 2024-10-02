<?php
session_start(); // Iniciar la sesión para usarla más adelante

// Verificar si se ha subido un archivo
if ($_FILES['archivo_excel']['error'] === UPLOAD_ERR_OK) {
    $file_tmp = $_FILES['archivo_excel']['tmp_name'];

    // Validar tipo de archivo
    $file_type = pathinfo($_FILES['archivo_excel']['name'], PATHINFO_EXTENSION);
    if ($file_type != 'csv') {
        $_SESSION['mensaje'] = "Error: Solo se permiten archivos CSV.";
        header('Location: radiacion.php');
        exit();
    }

    // Abrir el archivo CSV
    if (($handle = fopen($file_tmp, "r")) !== FALSE) {
        // Conexión a la base de datos
        require_once 'bd/conexion.php';
        $objeto = new Conexion();
        $conexion = $objeto->Conectar();

        // Preparar consultas para insertar y actualizar datos en la tabla `equipo_radiacion`
        $insertConsulta = "INSERT INTO equipo_radiacion (num_int, descripcion, serie, modelo, marca, calibracion, verificacion, ultima, proxima, status_c, ubicacion, prueba, condiciones, observaciones, archivo_pdf) VALUES (:num_int, :descripcion, :serie, :modelo, :marca, :calibracion, :verificacion, :ultima, :proxima, :status_c, :ubicacion, :prueba, :condiciones, :observaciones, :archivo_pdf)";
        $stmtInsert = $conexion->prepare($insertConsulta);

        $updateConsulta = "UPDATE equipo_radiacion SET descripcion = :descripcion, serie = :serie, modelo = :modelo, marca = :marca, calibracion = :calibracion, verificacion = :verificacion, ultima = :ultima, proxima = :proxima, status_c = :status_c, ubicacion = :ubicacion, prueba = :prueba, condiciones = :condiciones, observaciones = :observaciones, archivo_pdf = :archivo_pdf WHERE num_int = :num_int";
        $stmtUpdate = $conexion->prepare($updateConsulta);

        $existeConsulta = "SELECT id FROM equipo_radiacion WHERE num_int = :num_int";
        $stmtExiste = $conexion->prepare($existeConsulta);

        // Consultas para manejar accesorios
        $insertAccesoriosConsulta = "INSERT INTO accesorios_radiacion (radiacion_id, nombre) VALUES (:radiacion_id, :nombre)";
        $stmtInsertAccesorios = $conexion->prepare($insertAccesoriosConsulta);

        $deleteAccesoriosConsulta = "DELETE FROM accesorios_radiacion WHERE radiacion_id = :radiacion_id";
        $stmtDeleteAccesorios = $conexion->prepare($deleteAccesoriosConsulta);

        // Leer y procesar el archivo CSV
        $header = fgetcsv($handle); // Leer encabezados
        while (($row = fgetcsv($handle)) !== FALSE) {
            // Asignar los valores a variables
            $num_int = $row[0]; // Asegúrate de que el índice es correcto según tu archivo CSV
            $descripcion = $row[1];
            $serie = $row[2];
            $modelo = $row[3];
            $marca = $row[4];
            $calibracion = $row[5];
            $verificacion = $row[6];
            $ultima = $row[7];
            $proxima = $row[8];
            $status_c = $row[9];
            $ubicacion = $row[10];
            $prueba = $row[11];
            $condiciones = $row[12];
            $observaciones = $row[13];
            $accesorios = explode(',', $row[14]); // Suponiendo que los accesorios están separados por '|'
            $archivo_pdf = ''; // Asignar un valor predeterminado

            // Verificar si el registro ya existe en equipo_radiacion
            $stmtExiste->bindParam(':num_int', $num_int);
            $stmtExiste->execute();
            $resultado = $stmtExiste->fetch(PDO::FETCH_ASSOC);

            if ($resultado) {
                // Obtener el ID del equipo_radiacion
                $radiacion_id = $resultado['id'];

                // Ejecutar consulta para actualizar equipo_radiacion
                $stmtUpdate->bindParam(':num_int', $num_int);
                $stmtUpdate->bindParam(':descripcion', $descripcion);
                $stmtUpdate->bindParam(':serie', $serie);
                $stmtUpdate->bindParam(':modelo', $modelo);
                $stmtUpdate->bindParam(':marca', $marca);
                $stmtUpdate->bindParam(':calibracion', $calibracion);
                $stmtUpdate->bindParam(':verificacion', $verificacion);
                $stmtUpdate->bindParam(':ultima', $ultima);
                $stmtUpdate->bindParam(':proxima', $proxima);
                $stmtUpdate->bindParam(':status_c', $status_c);
                $stmtUpdate->bindParam(':ubicacion', $ubicacion);
                $stmtUpdate->bindParam(':prueba', $prueba);
                $stmtUpdate->bindParam(':condiciones', $condiciones);
                $stmtUpdate->bindParam(':observaciones', $observaciones);
                $stmtUpdate->bindParam(':archivo_pdf', $archivo_pdf);

                // Ejecutar la consulta de actualización
                $stmtUpdate->execute();
                
                // Borrar accesorios existentes para este radiacion_id
                $stmtDeleteAccesorios->bindParam(':radiacion_id', $radiacion_id);
                $stmtDeleteAccesorios->execute();
            } else {
                // Ejecutar consulta para inserción en equipo_radiacion
                $stmtInsert->bindParam(':num_int', $num_int);
                $stmtInsert->bindParam(':descripcion', $descripcion);
                $stmtInsert->bindParam(':serie', $serie);
                $stmtInsert->bindParam(':modelo', $modelo);
                $stmtInsert->bindParam(':marca', $marca);
                $stmtInsert->bindParam(':calibracion', $calibracion);
                $stmtInsert->bindParam(':verificacion', $verificacion);
                $stmtInsert->bindParam(':ultima', $ultima);
                $stmtInsert->bindParam(':proxima', $proxima);
                $stmtInsert->bindParam(':status_c', $status_c);
                $stmtInsert->bindParam(':ubicacion', $ubicacion);
                $stmtInsert->bindParam(':prueba', $prueba);
                $stmtInsert->bindParam(':condiciones', $condiciones);
                $stmtInsert->bindParam(':observaciones', $observaciones);
                $stmtInsert->bindParam(':archivo_pdf', $archivo_pdf);

                // Ejecutar la consulta de inserción
                $stmtInsert->execute();

                // Obtener el ID recién insertado
                $radiacion_id = $conexion->lastInsertId();
            }

            // Insertar accesorios
            foreach ($accesorios as $accesorio) {
                $stmtInsertAccesorios->bindParam(':radiacion_id', $radiacion_id);
                $stmtInsertAccesorios->bindParam(':nombre', trim($accesorio)); // Elimina espacios en blanco
                $stmtInsertAccesorios->execute();
            }
        }

        fclose($handle);
        $_SESSION['mensaje'] = "Registros Guardados";
        header('Location: radiacion.php');
        exit();
    } else {
        $_SESSION['mensaje'] = "Error al abrir el archivo CSV";
        header('Location: radiacion.php');
        exit();
    }
} else {
    $_SESSION['mensaje'] = "Error al subir el archivo CSV";
    header('Location: radiacion.php');
    exit();
}
?>
