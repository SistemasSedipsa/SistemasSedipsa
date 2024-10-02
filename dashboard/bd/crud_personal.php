<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS   
$personal = (isset($_POST['personal'])) ? $_POST['personal'] : '';
$dosimetros = (isset($_POST['dosimetros'])) ? $_POST['dosimetros'] : '';
$cnsns = (isset($_POST['cnsns'])) ? $_POST['cnsns'] : '';
$documentos_poe = (isset($_POST['documentos_poe'])) ? $_POST['documentos_poe'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

$data = [];
$response = ['success' => false, 'message' => ''];

try {
    switch($opcion){
        case 1: //alta
            $consulta = "INSERT INTO personal_poe (personal, dosimetros, cnsns, documentos_poe) VALUES(:personal, :dosimetros, :cnsns, :documentos_poe)";			
            $resultado = $conexion->prepare($consulta);
            $resultado->execute([
                ':personal' => $personal,
                ':dosimetros' => $dosimetros,
                ':cnsns' => $cnsns,
                ':documentos_poe' => $documentos_poe
            ]);

            $consulta = "SELECT id, personal, dosimetros, cnsns, documentos_poe FROM personal_poe ORDER BY id DESC LIMIT 1";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
            $response['success'] = true;
            $response['data'] = $data;
            break;

        case 2: //modificación
            $consulta = "UPDATE personal_poe SET personal=:personal, dosimetros=:dosimetros, cnsns=:cnsns, documentos_poe=:documentos_poe WHERE id=:id";		
            $resultado = $conexion->prepare($consulta);
            $resultado->execute([
                ':personal' => $personal,
                ':dosimetros' => $dosimetros,
                ':cnsns' => $cnsns,
                ':documentos_poe' => $documentos_poe,
                ':id' => $id
            ]);
            
            $consulta = "SELECT id, personal, dosimetros, cnsns, documentos_poe FROM personal_poe WHERE id=:id";       
            $resultado = $conexion->prepare($consulta);
            $resultado->execute([':id' => $id]);
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
            $response['success'] = true;
            $response['data'] = $data;
            break;        

        case 3: //baja
            $consulta = "DELETE FROM personal_poe WHERE id=:id";		
            $resultado = $conexion->prepare($consulta);
            $resultado->execute([':id' => $id]); 
            $response['success'] = true;
            $response['message'] = 'Registro eliminado exitosamente.';
            break;        
    }
} catch (PDOException $e) {
    $response['message'] = 'Error: ' . $e->getMessage();
}

print json_encode($response, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
?>
