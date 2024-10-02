<?php
session_start();
require_once 'conexion.php'; // Asegúrate de que este archivo contiene la lógica de conexión correcta

$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recoger datos del POST
$id = isset($_POST['id']) ? $_POST['id'] : '';
$num_int = isset($_POST['num_int']) ? $_POST['num_int'] : '';
$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
$metodo = isset($_POST['metodo']) ? $_POST['metodo'] : '';
$serie = isset($_POST['serie']) ? $_POST['serie'] : '';
$inventario = isset($_POST['inventario']) ? $_POST['inventario'] : '';
$modelo = isset($_POST['modelo']) ? $_POST['modelo'] : '';
$marca = isset($_POST['marca']) ? $_POST['marca'] : '';
$accesorios = isset($_POST['accesorios']) ? $_POST['accesorios'] : '';
$calibracion = isset($_POST['calibracion']) ? $_POST['calibracion'] : '';
$verificacion = isset($_POST['verificacion']) ? $_POST['verificacion'] : '';
$ultima = isset($_POST['ultima']) ? $_POST['ultima'] : '';
$informe = isset($_POST['informe']) ? $_POST['informe'] : '';
$proxima = isset($_POST['proxima']) ? $_POST['proxima'] : '';
$status_c = isset($_POST['status_c']) ? $_POST['status_c'] : '';
$ubicacion = isset($_POST['ubicacion']) ? $_POST['ubicacion'] : '';
$prueba = isset($_POST['prueba']) ? $_POST['prueba'] : '';
$condiciones = isset($_POST['condiciones']) ? $_POST['condiciones'] : '';
$observaciones = isset($_POST['observaciones']) ? $_POST['observaciones'] : '';
$situacion = isset($_POST['situacion']) ? $_POST['situacion'] : '';
$bodega = isset($_POST['bodega']) ? $_POST['bodega'] : '';
$opcion = isset($_POST['opcion']) ? $_POST['opcion'] : '';

// Manejo del archivo PDF
$archivo_pdf = '';
if (isset($_FILES['archivo_pdf']) && $_FILES['archivo_pdf']['error'] === UPLOAD_ERR_OK) {
    $pdf_tmp = $_FILES['archivo_pdf']['tmp_name'];
    $pdf_nombre = basename($_FILES['archivo_pdf']['name']);
    $ruta_pdf = './uploads/' . $pdf_nombre; // Especifica tu directorio de subida

    if (move_uploaded_file($pdf_tmp, $ruta_pdf)) {
        $archivo_pdf = $pdf_nombre; // Solo guardar el nombre del archivo en la base de datos
    } else {
        $_SESSION['mensaje'] = "Error al mover el archivo PDF.";
    }
}

try {
    switch ($opcion) {
        case 1: // Nuevo
            $consulta = "INSERT INTO almacen 
                (num_int, descripcion, metodo, serie, inventario, modelo, marca, accesorios, calibracion, verificacion, ultima, informe, proxima, status_c, ubicacion, prueba, condiciones, observaciones, situacion, bodega, archivo_pdf) 
                VALUES 
                (:num_int, :descripcion, :metodo, :serie, :inventario, :modelo, :marca, :accesorios, :calibracion, :verificacion, :ultima, :informe, :proxima, :status_c, :ubicacion, :prueba, :condiciones, :observaciones, :situacion, :bodega, :archivo_pdf)";
            $resultado = $conexion->prepare($consulta);
            // Vinculación de parámetros
            $resultado->bindParam(':num_int', $num_int);
            $resultado->bindParam(':descripcion', $descripcion);
            $resultado->bindParam(':metodo', $metodo);
            $resultado->bindParam(':serie', $serie);
            $resultado->bindParam(':inventario', $inventario);
            $resultado->bindParam(':modelo', $modelo);
            $resultado->bindParam(':marca', $marca);
            $resultado->bindParam(':accesorios', $accesorios);
            $resultado->bindParam(':calibracion', $calibracion);
            $resultado->bindParam(':verificacion', $verificacion);
            $resultado->bindParam(':ultima', $ultima);
            $resultado->bindParam(':informe', $informe);
            $resultado->bindParam(':proxima', $proxima);
            $resultado->bindParam(':status_c', $status_c);
            $resultado->bindParam(':ubicacion', $ubicacion);
            $resultado->bindParam(':prueba', $prueba);
            $resultado->bindParam(':condiciones', $condiciones);
            $resultado->bindParam(':observaciones', $observaciones);
            $resultado->bindParam(':situacion', $situacion);
            $resultado->bindParam(':bodega', $bodega);
            $resultado->bindParam(':archivo_pdf', $archivo_pdf);
            if ($resultado->execute()) {
                echo json_encode(['status' => 'success', 'message' => 'Registro insertado correctamente.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error al insertar el registro.']);
            }
            break;

        case 2: // Modificación
            $consulta = "UPDATE almacen 
                SET num_int=:num_int, descripcion=:descripcion, metodo=:metodo, serie=:serie, inventario=:inventario, modelo=:modelo, marca=:marca, accesorios=:accesorios, calibracion=:calibracion, verificacion=:verificacion, ultima=:ultima, informe=:informe, proxima=:proxima, status_c=:status_c, ubicacion=:ubicacion, prueba=:prueba, condiciones=:condiciones, observaciones=:observaciones, situacion=:situacion, bodega=:bodega, archivo_pdf=:archivo_pdf 
                WHERE id=:id";
            $resultado = $conexion->prepare($consulta);
            // Vinculación de parámetros
            $resultado->bindParam(':id', $id);
            $resultado->bindParam(':num_int', $num_int);
            $resultado->bindParam(':descripcion', $descripcion);
            $resultado->bindParam(':metodo', $metodo);
            $resultado->bindParam(':serie', $serie);
            $resultado->bindParam(':inventario', $inventario);
            $resultado->bindParam(':modelo', $modelo);
            $resultado->bindParam(':marca', $marca);
            $resultado->bindParam(':accesorios', $accesorios);
            $resultado->bindParam(':calibracion', $calibracion);
            $resultado->bindParam(':verificacion', $verificacion);
            $resultado->bindParam(':ultima', $ultima);
            $resultado->bindParam(':informe', $informe);
            $resultado->bindParam(':proxima', $proxima);
            $resultado->bindParam(':status_c', $status_c);
            $resultado->bindParam(':ubicacion', $ubicacion);
            $resultado->bindParam(':prueba', $prueba);
            $resultado->bindParam(':condiciones', $condiciones);
            $resultado->bindParam(':observaciones', $observaciones);
            $resultado->bindParam(':situacion', $situacion);
            $resultado->bindParam(':bodega', $bodega);
            $resultado->bindParam(':archivo_pdf', $archivo_pdf);
            if ($resultado->execute()) {
                echo json_encode(['status' => 'success', 'message' => 'Registro actualizado correctamente.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error al actualizar el registro.']);
            }
            break;

        case 3: // Eliminación
            $consulta = "SELECT archivo_pdf FROM almacen WHERE id=:id";
            $resultado = $conexion->prepare($consulta);
            $resultado->bindParam(':id', $id);
            $resultado->execute();
            $archivo = $resultado->fetch(PDO::FETCH_ASSOC);

            // Eliminar archivo físico si existe
            if ($archivo && file_exists('./uploads/' . $archivo['archivo_pdf'])) {
                unlink('./uploads/' . $archivo['archivo_pdf']);
            }

            // Eliminar registro de la base de datos
            $consulta = "DELETE FROM almacen WHERE id=:id";
            $resultado = $conexion->prepare($consulta);
            $resultado->bindParam(':id', $id);
            if ($resultado->execute()) {
                echo json_encode(['status' => 'success', 'message' => 'Registro eliminado correctamente.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error al eliminar el registro.']);
            }
            break;

        default:
            echo json_encode(['status' => 'error', 'message' => 'Opción no válida.']);
            break;
    }
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Error: ' . $e->getMessage()]);
}
echo json_encode($response, JSON_UNESCAPED_UNICODE);
$conexion = null;
?>
