<?php 
function buscar_website($dir){
	$ignore = array('.', '..', '.git');
    $list = array();
    $cont=0;
    if(substr($dir, -1)!='/') { $dir .= '/';}
    if($abrir_raiz = opendir($dir)){
    	while (false !== ($recorrer_raiz = readdir($abrir_raiz))){
    		if(in_array($recorrer_raiz, $ignore)) continue;
    		if(is_dir($dir.$recorrer_raiz) ) // valido q sea una ruta existente
    		{
    			$list[$cont] = $dir.$recorrer_raiz;
    		}
            $cont++;
    	}
        closedir($abrir_raiz); 
        return $list;      
    }else{ return false; }
}


$dir_hosts='../hosts';
$nombre_fichero='/cn/config.php';
include "Backup_Database.php";
if($website = buscar_website($dir_hosts)){
    foreach ($website as $dir_web) {
            $leng =  strlen($dir_hosts);
            $nweb = substr($dir_web, ($leng+1));
            $ruta = $dir_web.$nombre_fichero;
            if (file_exists($ruta)) {
                // echo "El fichero $ruta existe<br>";
                include($ruta);
                error_reporting(0);
                if (!($cnx=mysqli_connect("$servidor","$usuario","$contrasenia"))) {continue;}
                else {
                    include "export.php";                
                }             
            } else {
                echo "El fichero1 $ruta.$nombre_fichero no existe<br>";
            }
    }

}
else{
    echo 'no hay resultados';
}