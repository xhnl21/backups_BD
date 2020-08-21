<?php 
// Ruta del directorio donde están los archivos
$dir_hosts  = '../backup/backup-bd/'; 

// Arreglo con todos los nombres de los archivos
$files = array_diff(scandir($dir_hosts), array('.', '..')); 
// Luego recorres el arreglo y le haces un simple explode a cada elemento

// inorar ext
$ignore = "html";

foreach($files as $file){
    // Divides en dos el nombre de tu archivo utilizando el . 

    $data          = explode(".", $file);
    // Nombre del archivo
    $fileName      = $data[0];
    // Extensión del archivo 
    $fileExtension = $data[1];

    if($ignore != $fileExtension){
        
        $nameBDdir = $dir_hosts.$file;
        $nameBD = $file;

        include("upload-drive-google.php");

        // eliminar BD despues de subir a drive
        if($upload){
            unlink($nameBDdir);
        }else{
            echo "error deleting file";
        }
    }
} 


