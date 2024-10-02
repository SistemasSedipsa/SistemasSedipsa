<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS   
$num_int = (isset($_POST['num_int'])) ? $_POST['num_int'] : '';
$descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : '';
$serie = (isset($_POST['serie'])) ? $_POST['serie'] : '';
$modelo = (isset($_POST['modelo'])) ? $_POST['modelo'] : '';
$marca = (isset($_POST['marca'])) ? $_POST['marca'] : '';
$calibracion = (isset($_POST['calibracion'])) ? $_POST['calibracion'] : '';
$verificacion = (isset($_POST['verificacion'])) ? $_POST['verificacion'] : '';
$ultima = (isset($_POST['ultima'])) ? $_POST['ultima'] : '';
$proxima = (isset($_POST['proxima'])) ? $_POST['proxima'] : '';
$status_c = (isset($_POST['status_c'])) ? $_POST['status_c'] : '';
$ubicacion = (isset($_POST['ubicacion'])) ? $_POST['ubicacion'] : '';
$prueba = (isset($_POST['prueba'])) ? $_POST['prueba'] : '';
$condiciones = (isset($_POST['condiciones'])) ? $_POST['condiciones'] : '';
$observaciones = (isset($_POST['observaciones'])) ? $_POST['observaciones'] : '';
$accesorios = isset($_POST['accesorios']) ? $_POST['accesorios'] : '';
$archivo_pdf = (isset($_POST['archivo_pdf'])) ? $_POST['archivo_pdf'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

$response = [];

switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO equipo_radiacion (num_int, descripcion, serie, modelo, marca, calibracion, verificacion, ultima, proxima, status_c, ubicacion, prueba, condiciones, observaciones, accesorios, archivo_pdf) VALUES('$num_int', '$descripcion', '$serie', '$modelo', '$marca', '$calibracion', '$verificacion', '$ultima', '$proxima', '$status_c', '$ubicacion', '$prueba', '$condiciones', '$observaciones', '$accesorios', '$archivo_pdf')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT id, num_int, descripcion, serie, modelo, marca, calibracion, verificacion, ultima, proxima, status_c, ubicacion, prueba, condiciones, observaciones, accesorios, archivo_pdf FROM equipo_radiacion ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $response = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;

    case 2: //modificación
        $consulta = "UPDATE equipo_radiacion SET num_int='$num_int', descripcion='$descripcion', serie='$serie', modelo='$modelo', marca='$marca', calibracion='$calibracion', verificacion='$verificacion', ultima='$ultima', proxima='$proxima', status_c='$status_c', ubicacion='$ubicacion', prueba='$prueba', condiciones='$condiciones', observaciones='$observaciones', accesorios='$accesorios', archivo_pdf='$archivo_pdf' WHERE id='$id'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT id, num_int, descripcion, serie, modelo, marca, calibracion, verificacion, ultima, proxima, status_c, ubicacion, prueba, condiciones, observaciones, accesorios, archivo_pdf FROM equipo_radiacion WHERE id='$id'";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $response = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        

    case 3: //baja
        $consulta = "DELETE FROM equipo_radiacion WHERE id='$id'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $response = ['success' => true]; // Indicar éxito en la eliminación
        break;        
}

print json_encode($response, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
?>
