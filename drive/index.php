<?php 
// Ruta del directorio donde están los archivos
$dir_hosts  = '../backup/backup-bd/'; 

// Arreglo con todos los nombres de los archivos
$files = array_diff(scandir($dir_hosts), array('.', '..')); 
// Luego recorres el arreglo y le haces un simple explode a cada elemento

// inorar ext
$ignore = "html";
$ignore2 = "gz";
$ignore3 = "sql";

$i = 0;
$var = array();
    
$web = array('web1','web2','web3');
$key = array('1GWFuxj-ZpFiax0yXw_08by2men890_NR','1Mj-1H43m1UnB435LMrf6l928_u3OBa10','19YxCkO0Aq1LBJAZsAW5v3-jgxCf6r9VK');
$vz = array();
foreach($web as $webs){
    $ii = 0;
    $r = array();
    foreach($files as $file){
        // Divides en dos el nombre de tu archivo utilizando el . 
        $data          = explode(".", $file);
        // Nombre del archivo
        $fileName      = $data[0];
        // Extensión del archivo 
        $fileExtension = $data[1];

        if($ignore != $fileExtension && $ignore2 != $fileExtension && $ignore3 != $fileExtension){
            $nameBDdir = $dir_hosts.$file;       
            $p = $webs.'.'.$fileExtension;
            if($p == $file){
               $r[$ii] = $file; 
               $vz['zip'] = $r;
               $vz['key'] = $key[$i];
               $vz['dir'] = $nameBDdir; 
            }
            $ii++;
        }
    } 
    $i++;  
    foreach ($vz["zip"] as $value) {
        $nameBDdir = $vz["dir"];
        $keys = $vz["key"];
        $nameBD = $value;
        // NOTA: si la credencial falla la credencial ir a https://console.cloud.google.com/apis/credentials?project=cmsdemo-286914
        // paso 1 Cuentas de servicio
        // paso 2 Claves de API
        // paso 3 ID de clientes OAuth 2.0
        // crear carpeta en google drive
        // compartir carpeta con el correo de Cuentas de servicio cms-878@cmsdemo-286914.iam.gserviceaccount.com
        include("upload-drive-google.php");

        eliminar BD despues de subir a drive
        if($upload){
            unlink($nameBDdir);
        }else{
            echo "error deleting file";
        }  
    }
}

