<?php
/* sql backup */
include 'core/config/config.inc.php';
$filename = "backup-" . date("Y-m-d") . ".sql.gz";
$mime = "application/x-gzip";
header( "Content-Type: " . $mime );
header( 'Content-Disposition: attachment; filename="' . $filename . '"' );
$cmd = "mysqldump -u $database_user --password=$database_password $dbase | gzip --best";   
passthru( $cmd );
echo("Backup $filename is ready");

/* files backup */
$file = "full_". date("Y-m-d") . ".tar.gz";
/* unlim file`s size for upload from hosting*/
system("tar -czf $file ./");
/* OR
if exist limit (f.e. =20 mb) file`s size then doing multifiles archive 
system('tar czvf - ../ | split --bytes=20MB - ./manager/full_`date +%F`.tar.gz');
*/
if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    echo("Backup $file is ready");
    exit(0);
}
?>
