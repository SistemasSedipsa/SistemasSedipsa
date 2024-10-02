<?php
include_once './conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$id = isset($_POST['id']) ? $_POST['id'] : '';
$equipo = isset($_POST['equipo']) ? $_POST['equipo'] : '';
$talla = isset($_POST['talla']) ? $_POST['talla'] : '';
$entrada = isset($_POST['entrada']) ? $_POST['entrada'] : '';
$unidades = isset($_POST['unidades']) ? $_POST['unidades'] : '';
$precio = isset($_POST['precio']) ? $_POST['precio'] : '';
$salida = isset($_POST['salida']) ? $_POST['salida'] : '';
$salida_unidad = isset($_POST['salida_unidad']) ? $_POST['salida_unidad'] : '';
$personal = isset($_POST['personal']) ? $_POST['personal'] : '';
$restantes = isset($_POST['restantes']) ? $_POST['restantes'] : '';
$proveedor = isset($_POST['proveedor']) ? $_POST['proveedor'] : '';
$opcion = isset($_POST['opcion']) ? $_POST['opcion'] : '';

$response = [];

try {
    switch ($opcion) {
        case 1: // Alta
            $restantes = $unidades - $salida_unidad;
            $consultaEquipos = "INSERT INTO equipos (equipo, talla, entrada, unidades, precio, salida, salida_unidad, personal, restantes, proveedor) VALUES (:equipo, :talla, :entrada, :unidades, :precio, :salida, :salida_unidad, :personal, :restantes, :proveedor)";
            $resultadoEquipos = $conexion->prepare($consultaEquipos);
            $resultadoEquipos->execute([
                ':equipo' => $equipo,
                ':talla' => $talla,
                ':entrada' => $entrada,
                ':unidades' => $unidades,
                ':precio' => $precio,
                ':salida' => $salida,
                ':salida_unidad' => $salida_unidad,
                ':personal' => $personal,
                ':restantes' => $restantes,
                ':proveedor' => $proveedor,
            ]);

            $consultaUltimoRegistro = "SELECT id, equipo, talla, entrada, unidades, precio, salida, salida_unidad, personal, restantes, proveedor FROM equipos ORDER BY id DESC LIMIT 1";
            $resultadoUltimoRegistro = $conexion->prepare($consultaUltimoRegistro);
            $resultadoUltimoRegistro->execute();
            $response['data'] = $resultadoUltimoRegistro->fetchAll(PDO::FETCH_ASSOC);
            $response['status'] = 'success';
            $response['message'] = 'Registro agregado exitosamente.';
            break;

        case 2: // Modificación
            // Obtener el valor actual de "unidades" y "salida_unidad" para calcular "restantes"
            $consultaActual = "SELECT unidades FROM equipos WHERE id = :id";
            $stmt = $conexion->prepare($consultaActual);
            $stmt->execute([':id' => $id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $unidadesActuales = $row['unidades'];
                $restantes = ($unidadesActuales - $salida_unidad) + $unidades - $unidadesActuales;
            } else {
                throw new Exception('Registro no encontrado.');
            }

            $consultaEquipos = "UPDATE equipos SET equipo = :equipo, talla = :talla, entrada = :entrada, unidades = :unidades, precio = :precio, salida = :salida, salida_unidad = :salida_unidad, personal = :personal, restantes = :restantes, proveedor = :proveedor WHERE id = :id";
            $resultadoEquipos = $conexion->prepare($consultaEquipos);
            $resultadoEquipos->execute([
                ':equipo' => $equipo,
                ':talla' => $talla,
                ':entrada' => $entrada,
                ':unidades' => $unidades,
                ':precio' => $precio,
                ':salida' => $salida,
                ':salida_unidad' => $salida_unidad,
                ':personal' => $personal,
                ':restantes' => $restantes,
                ':proveedor' => $proveedor,
                ':id' => $id
            ]);

            $consultaEquiposModificado = "SELECT id, equipo, talla, entrada, unidades, precio, salida, salida_unidad, personal, restantes, proveedor FROM equipos WHERE id = :id";
            $resultadoEquiposModificado = $conexion->prepare($consultaEquiposModificado);
            $resultadoEquiposModificado->execute([':id' => $id]);
            $response['data'] = $resultadoEquiposModificado->fetchAll(PDO::FETCH_ASSOC);
            $response['status'] = 'success';
            $response['message'] = 'Registro modificado exitosamente.';
            break;

        case 3: // Borrado
            if ($id) {
                $consultaEliminacion = "DELETE FROM equipos WHERE id = :id";
                $resultadoEliminacion = $conexion->prepare($consultaEliminacion);
                $resultadoEliminacion->execute([':id' => $id]);
                $response['status'] = 'success';
                $response['message'] = 'Registro eliminado exitosamente.';
            } else {
                $response['status'] = 'error';
                $response['message'] = 'ID no válido.';
            }
            break;

        default:
            $response['status'] = 'error';
            $response['message'] = 'Operación no válida.';
            break;
    }
} catch (Exception $e) {
    $response['status'] = 'error';
    $response['message'] = 'Ocurrió un error: ' . $e->getMessage();
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);
$conexion = null;
?>
