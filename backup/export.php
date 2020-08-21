<?php
if( !isset($servidor) || !isset($bd) || !isset($usuario) || !isset($contrasenia) ) { 
    echo'<br>falla en variables<br>';
    echo'= '.$servidor.'<br>';
    echo'= '.$bd.'<br>';
    echo'= '.$usuario.'<br>';
    echo'= '.$contrasenia.'<br>';
}
else
{
    $DB_USER = $usuario;
    $DB_PASSWORD = $contrasenia;
    $DB_NAME= $bd;
    $DB_HOST= $servidor;
    $WEB_NAME = $nweb;
    /**
     * The Backup_Database class
     */
    
    /**
     * Instantiate Backup_Database and perform backup
     */
    // Report all errors
    error_reporting(E_ALL);
    // Set script max execution time
    set_time_limit(900); // 15 minutes
    if (php_sapi_name() != "cli") {
        echo '<div style="font-family: monospace;">';
    }
    $backupDatabase = new Backup_Database($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME, CHARSET, $WEB_NAME);
    $result = $backupDatabase->backupTables(TABLES, BACKUP_DIR) ? 'OK' : 'KO';
    $backupDatabase->obfPrint('Backup result: ' . $result, 1);
    // Use $output variable for further processing, for example to send it by email
    $output = $backupDatabase->getOutput();
    if (php_sapi_name() != "cli") {
        echo '</div>';
    } 
}