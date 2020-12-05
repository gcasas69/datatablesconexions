<?php
include_once 'config/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$idart = $_POST['idart'];
if (is_array($_FILES) && count($_FILES) > 0) {
    if (($_FILES["file"]["type"] == "image/pjpeg")
    || ($_FILES["file"]["type"] == "image/jpeg")
    || ($_FILES["file"]["type"] == "image/png")
    || ($_FILES["file"]["type"] == "image/gif")) {
        $extension = explode('.', $_FILES['file']['name']);
        $archivo = $_FILES['file']['name'];
        $tamano = $_FILES['file']['size'];
        if(($tamano < 500000)){
            if(file_exists("upload/$archivo")) unlink("upload/$archivo");
            if (move_uploaded_file($_FILES["file"]["tmp_name"], "upload/".$archivo)) {
                $imagen ="upload/".$archivo;
                chmod($imagen, 0777);
                $foto = "upload/".$archivo;
                echo "upload/".$archivo;
                ///update img
                $consulta = "UPDATE art SET foto='$foto' WHERE idart='$idart' ";		
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();        
                /////////////
            } else {
                echo 0;
            }
        }
    } else {
        echo 0;
    }
} else {
    echo 0;
}