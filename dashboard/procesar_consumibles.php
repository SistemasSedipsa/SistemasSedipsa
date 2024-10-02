<?php
session_start(); // Iniciar la sesión para usarla más adelante

// Verificar si se ha subido un archivo
if ($_FILES['archivo_excel']['error'] === UPLOAD_ERR_OK) {
    $file_tmp = $_FILES['archivo_excel']['tmp_name'];

    // Validar tipo de archivo
    $file_type = pathinfo($_FILES['archivo_excel']['name'], PATHINFO_EXTENSION);
    if ($file_type != 'csv') {
        $_SESSION['mensaje'] = "Error: Solo se permiten archivos CSV.";
        header('Location: consumibles.php');
        exit();
    }

    // Abrir el archivo CSV
    if (($handle = fopen($file_tmp, "r")) !== FALSE) {
        // Conexión a la base de datos
        require_once 'bd/conexion.php';
        $objeto = new Conexion();
        $conexion = $objeto->Conectar();

        // Consultas para manejar datos en la tabla `consumibles`
        $insertConsulta = "INSERT INTO consumibles (id, consumible, metodo, marca, cliente, entrada, lote, modelo, unidades, accesorios, ns, inventario, precio, caducidad, fecha, salida, personal, restantes, status_con, condiciones, ubicacion, proveedor) VALUES (:id, :consumible, :metodo, :marca, :cliente, :entrada, :lote, :modelo, :unidades, :accesorios, :ns, :inventario, :precio, :caducidad, :fecha, :salida, :personal, :restantes, :status_con, :condiciones, :ubicacion, :proveedor)";
        $stmtInsert = $conexion->prepare($insertConsulta);

        $updateConsulta = "UPDATE consumibles SET consumible = :consumible, metodo = :metodo, marca = :marca, cliente = :cliente, entrada = :entrada, lote = :lote, modelo = :modelo, unidades = :unidades, accesorios = :accesorios, ns = :ns, inventario = :inventario, precio = :precio, caducidad = :caducidad, fecha = :fecha, salida = :salida, personal = :personal, restantes = :restantes, status_con = :status_con, condiciones = :condiciones, ubicacion = :ubicacion, proveedor = :proveedor WHERE id = :id";
        $stmtUpdate = $conexion->prepare($updateConsulta);

        $existeConsulta = "SELECT id FROM consumibles WHERE id = :id";
        $stmtExiste = $conexion->prepare($existeConsulta);

        // Consultas para manejar accesorios
        $insertAccesoriosConsulta = "INSERT INTO accesorios_consumibles (consumible_id, nombre, modelo, ns, condicion) VALUES (:consumible_id, :nombre, :modelo, :ns, :condicion)";
        $stmtInsertAccesorios = $conexion->prepare($insertAccesoriosConsulta);

        $deleteAccesoriosConsulta = "DELETE FROM accesorios_consumibles WHERE consumible_id = :consumible_id";
        $stmtDeleteAccesorios = $conexion->prepare($deleteAccesoriosConsulta);

        // Leer y procesar el archivo CSV
        $header = fgetcsv($handle); // Leer encabezados
        while (($row = fgetcsv($handle)) !== FALSE) {
            // Asignar los valores a variables
            $id = $row[0];
            $consumible = $row[1];
            $metodo = $row[2];
            $marca = $row[3];
            $cliente = $row[4];
            $entrada = $row[5];
            $lote = $row[6];
            $modelo = $row[7];
            $unidades = $row[8];
            $accesorios = $row[9]; // Suponiendo que los accesorios están en una lista separada por '|'
            $ns = $row[10];
            $inventario = $row[11];
            $precio = $row[12];
            $caducidad = $row[13];
            $fecha = $row[14];
            $salida = $row[15];
            $personal = $row[16];
            $restantes = $row[17];
            $status_con = $row[18];
            $condiciones = $row[19];
            $ubicacion = $row[20];
            $proveedor = $row[21];

            // Verificar si el registro ya existe
            $stmtExiste->bindParam(':id', $id);
            $stmtExiste->execute();
            $resultado = $stmtExiste->fetch(PDO::FETCH_ASSOC);

            if ($resultado) {
                // Obtener el ID del consumible
                $consumible_id = $resultado['id'];

                // Ejecutar consulta para actualizar consumibles
                $stmtUpdate->bindParam(':id', $id);
                $stmtUpdate->bindParam(':consumible', $consumible);
                $stmtUpdate->bindParam(':metodo', $metodo);
                $stmtUpdate->bindParam(':marca', $marca);
                $stmtUpdate->bindParam(':cliente', $cliente);
                $stmtUpdate->bindParam(':entrada', $entrada);
                $stmtUpdate->bindParam(':lote', $lote);
                $stmtUpdate->bindParam(':modelo', $modelo);
                $stmtUpdate->bindParam(':unidades', $unidades);
                $stmtUpdate->bindParam(':accesorios', $accesorios);
                $stmtUpdate->bindParam(':ns', $ns);
                $stmtUpdate->bindParam(':inventario', $inventario);
                $stmtUpdate->bindParam(':precio', $precio);
                $stmtUpdate->bindParam(':caducidad', $caducidad);
                $stmtUpdate->bindParam(':fecha', $fecha);
                $stmtUpdate->bindParam(':salida', $salida);
                $stmtUpdate->bindParam(':personal', $personal);
                $stmtUpdate->bindParam(':restantes', $restantes);
                $stmtUpdate->bindParam(':status_con', $status_con);
                $stmtUpdate->bindParam(':condiciones', $condiciones);
                $stmtUpdate->bindParam(':ubicacion', $ubicacion);
                $stmtUpdate->bindParam(':proveedor', $proveedor);

                // Ejecutar la consulta de actualización
                $stmtUpdate->execute();
                
                // Borrar accesorios existentes para este consumible_id
                $stmtDeleteAccesorios->bindParam(':consumible_id', $consumible_id);
                $stmtDeleteAccesorios->execute();
            } else {
                // Ejecutar consulta para inserción en consumibles
                $stmtInsert->bindParam(':id', $id);
                $stmtInsert->bindParam(':consumible', $consumible);
                $stmtInsert->bindParam(':metodo', $metodo);
                $stmtInsert->bindParam(':marca', $marca);
                $stmtInsert->bindParam(':cliente', $cliente);
                $stmtInsert->bindParam(':entrada', $entrada);
                $stmtInsert->bindParam(':lote', $lote);
                $stmtInsert->bindParam(':modelo', $modelo);
                $stmtInsert->bindParam(':unidades', $unidades);
                $stmtInsert->bindParam(':accesorios', $accesorios);
                $stmtInsert->bindParam(':ns', $ns);
                $stmtInsert->bindParam(':inventario', $inventario);
                $stmtInsert->bindParam(':precio', $precio);
                $stmtInsert->bindParam(':caducidad', $caducidad);
                $stmtInsert->bindParam(':fecha', $fecha);
                $stmtInsert->bindParam(':salida', $salida);
                $stmtInsert->bindParam(':personal', $personal);
                $stmtInsert->bindParam(':restantes', $restantes);
                $stmtInsert->bindParam(':status_con', $status_con);
                $stmtInsert->bindParam(':condiciones', $condiciones);
                $stmtInsert->bindParam(':ubicacion', $ubicacion);
                $stmtInsert->bindParam(':proveedor', $proveedor);

                // Ejecutar la consulta de inserción
                $stmtInsert->execute();

                // Obtener el ID recién insertado
                $consumible_id = $conexion->lastInsertId();
            }

            // Insertar accesorios
            $accesoriosArray = explode(',', $accesorios); // Suponiendo que los accesorios están separados por '|'
            foreach ($accesoriosArray as $accesorio) {
                $accesorioDetails = explode(',', trim($accesorio)); // Suponiendo que los detalles del accesorio están separados por ','

                if (count($accesorioDetails) === 4) {
                    list($nombre, $modelo, $ns, $condicion) = $accesorioDetails;

                    $stmtInsertAccesorios->bindParam(':consumible_id', $consumible_id);
                    $stmtInsertAccesorios->bindParam(':nombre', $nombre);
                    $stmtInsertAccesorios->bindParam(':modelo', $modelo);
                    $stmtInsertAccesorios->bindParam(':ns', $ns);
                    $stmtInsertAccesorios->bindParam(':condicion', $condicion);

                    // Ejecutar la consulta de inserción de accesorios
                    $stmtInsertAccesorios->execute();
                }
            }
        }

        fclose($handle);
        $_SESSION['mensaje'] = "Registros Guardados";
        header('Location: consumibles.php');
        exit();
    } else {
        $_SESSION['mensaje'] = "Error al abrir el archivo CSV";
        header('Location: consumibles.php');
        exit();
    }
} else {
    $_SESSION['mensaje'] = "Error al subir el archivo CSV";
    header('Location: consumibles.php');
    exit();
}
?>
