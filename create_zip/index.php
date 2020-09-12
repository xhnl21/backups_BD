<?php 
// Ruta del directorio donde están los archivos
$dir_hosts  = '../backup/backup-bd/'; 

// Arreglo con todos los nombres de los archivos
$files = array_diff(scandir($dir_hosts), array('.', '..')); 
// Luego recorres el arreglo y le haces un simple explode a cada elemento

// inorar ext
$ignore = "html";

// Añadimos un directorio
$dir = $dir_hosts;

$zip = new ZipArchive();

$web = array('web1','web2','web3');
foreach($web as $webs){
    // Creamos y abrimos un archivo zip temporal
    $zip->open($dir.$webs.'.zip',ZipArchive::CREATE);
    $var = array();
    $vz = array();
    $i = 0;
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
            // echo $nameBD;
            $var[$i] = $nameBDdir;           
            $p = strpos($nameBD, $webs);  
            if($p){
               $vz[$i] = $nameBD; 
            }
            $i++;
        }
    }
    foreach ($vz as $value) {
        // echo $value.'<br>';
        $zip->addFile($nameBDdir,$value); 
    }
    $zip->close();
}