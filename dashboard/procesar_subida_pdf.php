<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] === UPLOAD_ERR_OK) {
        $id = $_POST['id'];
        $fileTmpPath = $_FILES['archivo']['tmp_name'];
        $fileName = $_FILES['archivo']['name'];
        $fileSize = $_FILES['archivo']['size'];
        $fileType = $_FILES['archivo']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Define allowed file extensions
        $allowedExtensions = ['pdf'];
        if (in_array($fileExtension, $allowedExtensions)) {
            // Determine the upload path
            $uploadFileDir = './pdfs_vehiculos/';
            $dest_path = $uploadFileDir . $fileName;

            // Check if the file already exists and delete it
            if (file_exists($dest_path)) {
                unlink($dest_path);
            }

            // Move the uploaded file to the destination
            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                // Update the database or perform any other action needed
                echo json_encode(['status' => 'success', 'message' => 'Archivo subido correctamente']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error al mover el archivo']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Tipo de archivo no permitido']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No se ha subido ningún archivo']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método de solicitud no válido']);
}
?>
