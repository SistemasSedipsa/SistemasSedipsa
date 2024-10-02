<?php
session_start(); // Iniciar la sesión para usarla más adelante

// Verificar si se ha subido un archivo
if ($_FILES['archivo_excel']['error'] === UPLOAD_ERR_OK) {
    $file_tmp = $_FILES['archivo_excel']['tmp_name'];

    // Validar tipo de archivo
    $file_type = pathinfo($_FILES['archivo_excel']['name'], PATHINFO_EXTENSION);
    if ($file_type != 'csv') {
        $_SESSION['mensaje'] = "Error: Solo se permiten archivos CSV.";
        header('Location: vehiculos.php');
        exit();
    }

    // Abrir el archivo CSV
    if (($handle = fopen($file_tmp, "r")) !== FALSE) {
        // Conexión a la base de datos
        require_once 'bd/conexion.php';
        $objeto = new Conexion();
        $conexion = $objeto->Conectar();

        // Preparar consulta para insertar datos
        $insertConsulta = "INSERT INTO vehiculos(id, num, placas, marca, modelo, color, motor, serie, trabajador, fecha, servicio, ultima_mant, proxima_mant, kilometraje, status_mant, ultima_ver, proxima_ver, status_ver, tag, gasolina, compania, numero, inicia, termina, carta, factura, otros, archivo_vehiculo) VALUES (:id, :num, :placas, :marca, :modelo, :color, :motor, :serie, :trabajador, :fecha, :servicio, :ultima_mant, :proxima_mant, :kilometraje, :status_mant, :ultima_ver, :proxima_ver, :status_ver, :tag, :gasolina, :compania, :numero, :inicia, :termina, :carta, :factura, :otros, :archivo_vehiculo)";
        $stmtInsert = $conexion->prepare($insertConsulta);

        // Preparar consulta para actualizar datos
        $updateConsulta = "UPDATE vehiculos SET num = :num, placas = :placas, marca = :marca, modelo = :modelo, color = :color, motor = :motor, serie = :serie, trabajador = :trabajador, fecha = :fecha, servicio = :servicio, ultima_mant = :ultima_mant, proxima_mant = :proxima_mant, kilometraje = :kilometraje, status_mant = :status_mant, ultima_ver = :ultima_ver, proxima_ver = :proxima_ver, status_ver = :status_ver, tag = :tag, gasolina = :gasolina, compania = :compania, numero = :numero, inicia = :inicia, termina = :termina, carta = :carta, factura = :factura, otros = :otros, archivo_vehiculo = :archivo_vehiculo WHERE id = :id";
        $stmtUpdate = $conexion->prepare($updateConsulta);

        // Preparar consulta para verificar existencia antes de insertar
        $existeConsulta = "SELECT COUNT(*) AS num_rows FROM vehiculos WHERE id = :id";
        $stmtExiste = $conexion->prepare($existeConsulta);

        // Leer y procesar el archivo CSV
        $header = fgetcsv($handle); // Leer encabezados
        while (($row = fgetcsv($handle)) !== FALSE) {
            // Asignar los valores a variables
            $id = $row[0];
            $num = $row[1];
            $placas = $row[2];
            $marca = $row[3];
            $modelo = $row[4];
            $color = $row[5];
            $motor = $row[6];
            $serie = $row[7];
            $trabajador = $row[8];
            $fecha = $row[9];
            $servicio = $row[10];
            $ultima_mant = $row[11];
            $proxima_mant = $row[12];
            $kilometraje = $row[13];
            $status_mant = $row[14];
            $ultima_ver = $row[15];
            $proxima_ver = $row[16];
            $status_ver = $row[17];
            $tag = $row[18];
            $gasolina = $row[19];
            $compania = $row[20];
            $numero = $row[21];
            $inicia = $row[22];
            $termina = $row[23];
            $carta = $row[24];
            $factura = $row[25];
            $otros = $row[26];
            $archivo_vehiculo = ''; // Asignar un valor predeterminado

            // Verificar si el registro ya existe
            $stmtExiste->bindParam(':id', $id);
            $stmtExiste->execute();
            $resultado = $stmtExiste->fetch(PDO::FETCH_ASSOC);

            if ($resultado['num_rows'] > 0) {
                // Ejecutar consulta para actualizar
                $stmtUpdate->bindParam(':id', $id);
                $stmtUpdate->bindParam(':num', $num);
                $stmtUpdate->bindParam(':placas', $placas);
                $stmtUpdate->bindParam(':marca', $marca);
                $stmtUpdate->bindParam(':modelo', $modelo);
                $stmtUpdate->bindParam(':color', $color);
                $stmtUpdate->bindParam(':motor', $motor);
                $stmtUpdate->bindParam(':serie', $serie);
                $stmtUpdate->bindParam(':trabajador', $trabajador);
                $stmtUpdate->bindParam(':fecha', $fecha);
                $stmtUpdate->bindParam(':servicio', $servicio);
                $stmtUpdate->bindParam(':ultima_mant', $ultima_mant);
                $stmtUpdate->bindParam(':proxima_mant', $proxima_mant);
                $stmtUpdate->bindParam(':kilometraje', $kilometraje);
                $stmtUpdate->bindParam(':status_mant', $status_mant);
                $stmtUpdate->bindParam(':ultima_ver', $ultima_ver);
                $stmtUpdate->bindParam(':proxima_ver', $proxima_ver);
                $stmtUpdate->bindParam(':status_ver', $status_ver);
                $stmtUpdate->bindParam(':tag', $tag);
                $stmtUpdate->bindParam(':gasolina', $gasolina);
                $stmtUpdate->bindParam(':compania', $compania);
                $stmtUpdate->bindParam(':numero', $numero);
                $stmtUpdate->bindParam(':inicia', $inicia);
                $stmtUpdate->bindParam(':termina', $termina);
                $stmtUpdate->bindParam(':carta', $carta);
                $stmtUpdate->bindParam(':factura', $factura);
                $stmtUpdate->bindParam(':otros', $otros);
                $stmtUpdate->bindParam(':archivo_vehiculo', $archivo_vehiculo);

                // Ejecutar la consulta de actualización
                $stmtUpdate->execute();
            } else {
                // Ejecutar consulta para inserción
                $stmtInsert->bindParam(':id', $id);
                $stmtInsert->bindParam(':num', $num);
                $stmtInsert->bindParam(':placas', $placas);
                $stmtInsert->bindParam(':marca', $marca);
                $stmtInsert->bindParam(':modelo', $modelo);
                $stmtInsert->bindParam(':color', $color);
                $stmtInsert->bindParam(':motor', $motor);
                $stmtInsert->bindParam(':serie', $serie);
                $stmtInsert->bindParam(':trabajador', $trabajador);
                $stmtInsert->bindParam(':fecha', $fecha);
                $stmtInsert->bindParam(':servicio', $servicio);
                $stmtInsert->bindParam(':ultima_mant', $ultima_mant);
                $stmtInsert->bindParam(':proxima_mant', $proxima_mant);
                $stmtInsert->bindParam(':kilometraje', $kilometraje);
                $stmtInsert->bindParam(':status_mant', $status_mant);
                $stmtInsert->bindParam(':ultima_ver', $ultima_ver);
                $stmtInsert->bindParam(':proxima_ver', $proxima_ver);
                $stmtInsert->bindParam(':status_ver', $status_ver);
                $stmtInsert->bindParam(':tag', $tag);
                $stmtInsert->bindParam(':gasolina', $gasolina);
                $stmtInsert->bindParam(':compania', $compania);
                $stmtInsert->bindParam(':numero', $numero);
                $stmtInsert->bindParam(':inicia', $inicia);
                $stmtInsert->bindParam(':termina', $termina);
                $stmtInsert->bindParam(':carta', $carta);
                $stmtInsert->bindParam(':factura', $factura);
                $stmtInsert->bindParam(':otros', $otros);
                $stmtInsert->bindParam(':archivo_vehiculo', $archivo_vehiculo);

                // Ejecutar la consulta de inserción
                $stmtInsert->execute();
            }
        }

        fclose($handle);
        $_SESSION['mensaje'] = "Registros Guardados";
        header('Location: vehiculos.php');
        exit();
    } else {
        $_SESSION['mensaje'] = "Error al abrir el archivo CSV";
        header('Location: vehiculos.php');
        exit();
    }
} else {
    $_SESSION['mensaje'] = "Error al subir el archivo CSV";
    header('Location: vehiculos.php');
    exit();
}
?>
