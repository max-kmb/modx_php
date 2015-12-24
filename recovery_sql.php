<?php
/* sql recovery*/
include 'core/config/config.inc.php';
$filename = "/var/www/html/modx33/backup-" . date("Y-m-d") . ".sql.gz";
$cmd = "gunzip < $filename | mysql -u $database_user --password=$database_password $dbase";   
system( $cmd );
echo("Recovery $filename is ready");
?>