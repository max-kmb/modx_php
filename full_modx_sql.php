<?php
include 'core/config/config.inc.php';

$filename = "backup-" . date("Y-m-d") . ".sql.gz";
$mime = "application/x-gzip";

header( "Content-Type: " . $mime );
header( 'Content-Disposition: attachment; filename="' . $filename . '"' );

$cmd = "mysqldump -u $database_user --password=$database_password $dbase | gzip --best";

passthru( $cmd );
echo("Backup full_backup.tar.gz is ready");

exit(0);

?>
