<?php
system('tar czvf - ../ | split --bytes=20MB - ./manager/full_`date +%F`.tar.gz');
echo("Backup full_backup.tar.gz is ready");
?>
