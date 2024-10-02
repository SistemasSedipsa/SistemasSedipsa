<?php

include './bd/conexion.php';

if($_POST['archivo_pdf']){
    if(file_exists($_FILES['archivo_pdf']['tmp_name'])){
        echo'Se ha subido el archivo';
}else{
    echo'Error no se ha podido subir';
}
}