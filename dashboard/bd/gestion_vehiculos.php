<?php
session_start();
require_once 'conexion.php'; // Asegúrate de que este archivo contiene la lógica de conexión correcta

$objeto = new Conexion();
$conexion = $objeto->Conectar();

$id = isset($_POST['id']) ? $_POST['id'] : '';
$num = isset($_POST['num']) ? $_POST['num'] : '';
$placas = isset($_POST['placas']) ? $_POST['placas'] : '';
$marca = isset($_POST['marca']) ? $_POST['marca'] : '';
$modelo = isset($_POST['modelo']) ? $_POST['modelo'] : '';
$color = isset($_POST['color']) ? $_POST['color'] : '';
$motor = isset($_POST['motor']) ? $_POST['motor'] : '';
$serie = isset($_POST['serie']) ? $_POST['serie'] : '';
$trabajador = isset($_POST['trabajador']) ? $_POST['trabajador'] : '';
$fecha = isset($_POST['fecha']) ? $_POST['fecha'] : '';
$servicio = isset($_POST['servicio']) ? $_POST['servicio'] : '';
$ultima_mant = isset($_POST['ultima_mant']) ? $_POST['ultima_mant'] : '';
$proxima_mant = isset($_POST['proxima_mant']) ? $_POST['proxima_mant'] : '';
$kilometraje = isset($_POST['kilometraje']) ? $_POST['kilometraje'] : '';
$status_mant = isset($_POST['status_mant']) ? $_POST['status_mant'] : '';
$ultima_ver = isset($_POST['ultima_ver']) ? $_POST['ultima_ver'] : '';
$proxima_ver = isset($_POST['proxima_ver']) ? $_POST['proxima_ver'] : '';
$status_ver = isset($_POST['status_ver']) ? $_POST['status_ver'] : '';
$tag = isset($_POST['tag']) ? $_POST['tag'] : '';
$gasolina = isset($_POST['gasolina']) ? $_POST['gasolina'] : '';
$compania = isset($_POST['compania']) ? $_POST['compania'] : '';
$numero = isset($_POST['numero']) ? $_POST['numero'] : '';
$inicia = isset($_POST['inicia']) ? $_POST['inicia'] : '';
$termina = isset($_POST['termina']) ? $_POST['termina'] : '';
$carta = isset($_POST['carta']) ? $_POST['carta'] : '';
$factura = isset($_POST['factura']) ? $_POST['factura'] : '';
$otros = isset($_POST['otros']) ? $_POST['otros'] : '';
$opcion = isset($_POST['opcion']) ? $_POST['opcion'] : '';

// Manejo del archivo PDF
$archivo_vehiculo = '';
if (isset($_FILES['archivo_vehiculo']) && $_FILES['archivo_vehiculo']['error'] === UPLOAD_ERR_OK) {
    $pdf_tmp = $_FILES['archivo_vehiculo']['tmp_name'];
    $pdf_nombre = basename($_FILES['archivo_vehiculo']['name']);
    $ruta_pdf = '../docs/' . $pdf_nombre; // Especifica tu directorio de subida

    if (move_uploaded_file($pdf_tmp, $ruta_pdf)) {
        $archivo_vehiculo = $pdf_nombre; // Solo almacenar el nombre del archivo en la base de datos
    } else {
        $_SESSION['mensaje'] = "Error al mover el archivo PDF.";
    }
}

try {
    switch ($opcion) {
        case 1: // Nuevo
            $consulta = "INSERT INTO vehiculos(num, placas, marca, modelo, color, motor, serie, trabajador, fecha, servicio, ultima_mant, proxima_mant, kilometraje, status_mant, ultima_ver, proxima_ver, status_ver, tag, gasolina, compania, numero, inicia, termina, carta, factura, otros, archivo_vehiculo)
                         VALUES (:num, :placas, :marca, :modelo, :color, :motor, :serie, :trabajador, :fecha, :servicio, :ultima_mant, :proxima_mant, :kilometraje, :status_mant, :ultima_ver, :proxima_ver, :status_ver, :tag, :gasolina, :compania, :numero, :inicia, :termina, :carta, :factura, :otros, :archivo_vehiculo)";
            $resultado = $conexion->prepare($consulta);
            $resultado->bindParam(':num', $num);
            $resultado->bindParam(':placas', $placas);
            $resultado->bindParam(':marca', $marca);
            $resultado->bindParam(':modelo', $modelo);
            $resultado->bindParam(':color', $color);
            $resultado->bindParam(':motor', $motor);
            $resultado->bindParam(':serie', $serie);
            $resultado->bindParam(':trabajador', $trabajador);
            $resultado->bindParam(':fecha', $fecha);
            $resultado->bindParam(':servicio', $servicio);
            $resultado->bindParam(':ultima_mant', $ultima_mant);
            $resultado->bindParam(':proxima_mant', $proxima_mant);
            $resultado->bindParam(':kilometraje', $kilometraje);
            $resultado->bindParam(':status_mant', $status_mant);
            $resultado->bindParam(':ultima_ver', $ultima_ver);
            $resultado->bindParam(':proxima_ver', $proxima_ver);
            $resultado->bindParam(':status_ver', $status_ver);
            $resultado->bindParam(':tag', $tag);
            $resultado->bindParam(':gasolina', $gasolina);
            $resultado->bindParam(':compania', $compania);
            $resultado->bindParam(':numero', $numero);
            $resultado->bindParam(':inicia', $inicia);
            $resultado->bindParam(':termina', $termina);
            $resultado->bindParam(':carta', $carta);
            $resultado->bindParam(':factura', $factura);
            $resultado->bindParam(':otros', $otros);
            $resultado->bindParam(':archivo_vehiculo', $archivo_vehiculo);
            if ($resultado->execute()) {
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error al agregar el registro.']);
            }
            break;

        case 2: // Modificación
            $consulta = "UPDATE vehiculos SET num=:num, placas=:placas, marca=:marca, modelo=:modelo, color=:color, motor=:motor, serie=:serie, trabajador=:trabajador, fecha=:fecha, servicio=:servicio, ultima_mant=:ultima_mant, proxima_mant=:proxima_mant, kilometraje=:kilometraje, status_mant=:status_mant, ultima_ver=:ultima_ver, proxima_ver=:proxima_ver, status_ver=:status_ver, tag=:tag, gasolina=:gasolina, compania=:compania, numero=:numero, inicia=:inicia, termina=:termina, carta=:carta, factura=:factura, otros=:otros";
            if (!empty($archivo_vehiculo)) {
                $consulta .= ", archivo_vehiculo=:archivo_vehiculo";
            }
            $consulta .= " WHERE id=:id";
            $resultado = $conexion->prepare($consulta);
            $resultado->bindParam(':num', $num);
            $resultado->bindParam(':placas', $placas);
            $resultado->bindParam(':marca', $marca);
            $resultado->bindParam(':modelo', $modelo);
            $resultado->bindParam(':color', $color);
            $resultado->bindParam(':motor', $motor);
            $resultado->bindParam(':serie', $serie);
            $resultado->bindParam(':trabajador', $trabajador);
            $resultado->bindParam(':fecha', $fecha);
            $resultado->bindParam(':servicio', $servicio);
            $resultado->bindParam(':ultima_mant', $ultima_mant);
            $resultado->bindParam(':proxima_mant', $proxima_mant);
            $resultado->bindParam(':kilometraje', $kilometraje);
            $resultado->bindParam(':status_mant', $status_mant);
            $resultado->bindParam(':ultima_ver', $ultima_ver);
            $resultado->bindParam(':proxima_ver', $proxima_ver);
            $resultado->bindParam(':status_ver', $status_ver);
            $resultado->bindParam(':tag', $tag);
            $resultado->bindParam(':gasolina', $gasolina);
            $resultado->bindParam(':compania', $compania);
            $resultado->bindParam(':numero', $numero);
            $resultado->bindParam(':inicia', $inicia);
            $resultado->bindParam(':termina', $termina);
            $resultado->bindParam(':carta', $carta);
            $resultado->bindParam(':factura', $factura);
            $resultado->bindParam(':otros', $otros);
            if (!empty($archivo_vehiculo)) {
                $resultado->bindParam(':archivo_vehiculo', $archivo_vehiculo);
            }
            $resultado->bindParam(':id', $id);
            if ($resultado->execute()) {
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error al actualizar el registro.']);
            }
            break;

        case 3: // Eliminación
            try {
                $conexion->beginTransaction();

                // Elimina los registros relacionados en la tabla archivo_vehiculos
                $consulta = "DELETE FROM archivo_vehiculos WHERE vehiculo_id=:id";
                $resultado = $conexion->prepare($consulta);
                $resultado->bindParam(':id', $id);
                $resultado->execute();

                // Luego, elimina el registro de la tabla vehiculos
                $consulta = "DELETE FROM vehiculos WHERE id=:id";
                $resultado = $conexion->prepare($consulta);
                $resultado->bindParam(':id', $id);
                if ($resultado->execute()) {
                    $conexion->commit();
                    echo json_encode(['status' => 'success', 'message' => 'Registro eliminado correctamente.']);
                } else {
                    $conexion->rollBack();
                    echo json_encode(['status' => 'error', 'message' => 'Error al eliminar el registro.']);
                }
            } catch (Exception $e) {
                $conexion->rollBack();
                echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
            }
            break;

        default:
            echo json_encode(['status' => 'error', 'message' => 'Opción no válida.']);
    }
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}

$conexion = null;
?>
