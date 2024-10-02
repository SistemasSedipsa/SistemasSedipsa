<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS   
$fuentes = (isset($_POST['fuentes'])) ? $_POST['fuentes'] : '';
$modelo = (isset($_POST['modelo'])) ? $_POST['modelo'] : '';
$marca = (isset($_POST['marca'])) ? $_POST['marca'] : '';
$serie = (isset($_POST['serie'])) ? $_POST['serie'] : '';
$contenedor = (isset($_POST['contenedor'])) ? $_POST['contenedor'] : '';
$decantamiento = (isset($_POST['decantamiento'])) ? $_POST['decantamiento'] : '';
$documentos_fuente = (isset($_POST['documentos_fuente'])) ? $_POST['documentos_fuente'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

$data = array(); // Inicializar el array de datos

switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO fuentes (fuentes, modelo, marca, serie, contenedor, decantamiento, documentos_fuente) VALUES(:fuentes, :modelo, :marca, :serie, :contenedor, :decantamiento, :documentos_fuente)";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(array(
            ':fuentes' => $fuentes,
            ':modelo' => $modelo,
            ':marca' => $marca,
            ':serie' => $serie,
            ':contenedor' => $contenedor,
            ':decantamiento' => $decantamiento,
            ':documentos_fuente' => $documentos_fuente
        ));

        $consulta = "SELECT id, fuentes, modelo, marca, serie, contenedor, decantamiento, documentos_fuente FROM fuentes ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;

    case 2: //modificación
        $consulta = "UPDATE fuentes SET fuentes=:fuentes, modelo=:modelo, marca=:marca, serie=:serie, contenedor=:contenedor, decantamiento=:decantamiento, documentos_fuente=:documentos_fuente WHERE id=:id";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(array(
            ':fuentes' => $fuentes,
            ':modelo' => $modelo,
            ':marca' => $marca,
            ':serie' => $serie,
            ':contenedor' => $contenedor,
            ':decantamiento' => $decantamiento,
            ':documentos_fuente' => $documentos_fuente,
            ':id' => $id
        ));

        $consulta = "SELECT id, fuentes, modelo, marca, serie, contenedor, decantamiento, documentos_fuente FROM fuentes WHERE id=:id";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(array(':id' => $id));
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        

    case 3: //baja
        $consulta = "DELETE FROM fuentes WHERE id=:id";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(array(':id' => $id));

        // Verificar si se eliminó algún registro
        if ($resultado->rowCount() > 0) {
            $data = array('success' => true);
        } else {
            $data = array('success' => false);
        }
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
?>
