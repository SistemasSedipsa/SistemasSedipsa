<?php
include_once './conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$id = isset($_POST['id']) ? $_POST['id'] : '';
$consumible = isset($_POST['consumible']) ? $_POST['consumible'] : '';
$metodo = isset($_POST['metodo']) ? $_POST['metodo'] : '';
$marca = isset($_POST['marca']) ? $_POST['marca'] : '';
$cliente = isset($_POST['cliente']) ? $_POST['cliente'] : '';
$entrada = isset($_POST['entrada']) ? $_POST['entrada'] : '';
$lote = isset($_POST['lote']) ? $_POST['lote'] : '';
$modelo = isset($_POST['modelo']) ? $_POST['modelo'] : '';
$unidades = isset($_POST['unidades']) ? $_POST['unidades'] : '';
$accesorios = isset($_POST['accesorios']) ? $_POST['accesorios'] : '';
$ns = isset($_POST['ns']) ? $_POST['ns'] : '';
$inventario = isset($_POST['inventario']) ? $_POST['inventario'] : '';
$precio = isset($_POST['precio']) ? $_POST['precio'] : '';
$caducidad = isset($_POST['caducidad']) ? $_POST['caducidad'] : '';
$fecha = isset($_POST['fecha']) ? $_POST['fecha'] : '';
$salida = isset($_POST['salida']) ? $_POST['salida'] : '';
$personal = isset($_POST['personal']) ? $_POST['personal'] : '';
$status_con = isset($_POST['status_con']) ? $_POST['status_con'] : '';
$condiciones = isset($_POST['condiciones']) ? $_POST['condiciones'] : '';
$ubicacion = isset($_POST['ubicacion']) ? $_POST['ubicacion'] : '';
$proveedor = isset($_POST['proveedor']) ? $_POST['proveedor'] : '';
$opcion = isset($_POST['opcion']) ? $_POST['opcion'] : '';

$response = [];

try {
    switch($opcion) {
        case 1: // Alta
            $consultaConsumibles = "INSERT INTO consumibles(consumible, metodo, marca, cliente, entrada, lote, modelo, unidades, accesorios, ns, inventario, precio, caducidad, fecha, salida, personal, restantes, status_con, condiciones, ubicacion, proveedor) VALUES (:consumible, :metodo, :marca, :cliente, :entrada, :lote, :modelo, :unidades, :accesorios, :ns, :inventario, :precio, :caducidad, :fecha, :salida, :personal, :restantes, :status_con, :condiciones, :ubicacion, :proveedor)";
            $resultadoConsumibles = $conexion->prepare($consultaConsumibles);
            $resultadoConsumibles->execute([
                ':consumible' => $consumible,
                ':metodo' => $metodo,
                ':marca' => $marca,
                ':cliente' => $cliente,
                ':entrada' => $entrada,
                ':lote' => $lote,
                ':modelo' => $modelo,
                ':unidades' => $unidades,
                ':accesorios' => $accesorios,
                ':ns' => $ns,
                ':inventario' => $inventario,
                ':precio' => $precio,
                ':caducidad' => $caducidad,
                ':fecha' => $fecha,
                ':salida' => $salida,
                ':personal' => $personal,
                ':restantes' => $unidades - $salida,
                ':status_con' => $status_con,
                ':condiciones' => $condiciones,
                ':ubicacion' => $ubicacion,
                ':proveedor' => $proveedor,
            ]);
            
            $consultaUltimoRegistro = "SELECT id, consumible, metodo, marca, cliente, entrada, lote, modelo, unidades, accesorios, ns, inventario, precio, caducidad, fecha, salida, personal, restantes, status_con, condiciones, ubicacion, proveedor FROM consumibles ORDER BY id DESC LIMIT 1";
            $resultadoUltimoRegistro = $conexion->prepare($consultaUltimoRegistro);
            $resultadoUltimoRegistro->execute();
            $response['data'] = $resultadoUltimoRegistro->fetchAll(PDO::FETCH_ASSOC);
            $response['status'] = 'success';
            $response['message'] = 'Registro agregado exitosamente.';
            break;
        
        case 2: // Modificación
            // Obtener el valor actual de "unidades" para calcular "restantes"
            $consultaActual = "SELECT unidades FROM consumibles WHERE id = :id";
            $stmt = $conexion->prepare($consultaActual);
            $stmt->execute([':id' => $id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $unidadesActuales = $row['unidades'];
                $restantes = ($unidadesActuales - $salida) + $unidades - $unidadesActuales; // Ajustar el cálculo
            } else {
                throw new Exception('Registro no encontrado.');
            }
            
            $consultaConsumibles = "UPDATE consumibles SET consumible=:consumible, metodo=:metodo, marca=:marca, cliente=:cliente, entrada=:entrada, lote=:lote, modelo=:modelo, unidades=:unidades, accesorios=:accesorios, ns=:ns, inventario=:inventario, precio=:precio, caducidad=:caducidad, fecha=:fecha, salida=:salida, personal=:personal, restantes=:restantes, status_con=:status_con, condiciones=:condiciones, ubicacion=:ubicacion, proveedor=:proveedor WHERE id = :id";
            $resultadoConsumibles = $conexion->prepare($consultaConsumibles);
            $resultadoConsumibles->execute([
                ':consumible' => $consumible,
                ':metodo' => $metodo,
                ':marca' => $marca,
                ':cliente' => $cliente,
                ':entrada' => $entrada,
                ':lote' => $lote,
                ':modelo' => $modelo,
                ':unidades' => $unidades,
                ':accesorios' => $accesorios,
                ':ns' => $ns,
                ':inventario' => $inventario,
                ':precio' => $precio,
                ':caducidad' => $caducidad,
                ':fecha' => $fecha,
                ':salida' => $salida,
                ':personal' => $personal,
                ':restantes' => $restantes,
                ':status_con' => $status_con,
                ':condiciones' => $condiciones,
                ':ubicacion' => $ubicacion,
                ':proveedor' => $proveedor,
                ':id' => $id
            ]);
            
            $consultaConsumiblesModificado = "SELECT id, consumible, metodo, marca, cliente, entrada, lote, modelo, unidades, accesorios, ns, inventario, precio, caducidad, fecha, salida, personal, restantes, status_con, condiciones, ubicacion, proveedor FROM consumibles WHERE id = :id";
            $resultadoConsumiblesModificado = $conexion->prepare($consultaConsumiblesModificado);
            $resultadoConsumiblesModificado->execute([':id' => $id]);
            $response['data'] = $resultadoConsumiblesModificado->fetchAll(PDO::FETCH_ASSOC);
            $response['status'] = 'success';
            $response['message'] = 'Registro modificado exitosamente.';
            break;

        case 3: // Borrado
            if ($id) {
                $consultaEliminacion = "DELETE FROM consumibles WHERE id = :id";
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