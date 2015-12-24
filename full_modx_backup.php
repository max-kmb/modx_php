<?php
$date = date("Y-m-d");
$zipname = "full_$date.zip";

// Get real path for our folder
$rootPath = realpath('./');

// Initialize archive object
$zip = new ZipArchive();
$zip->open($zipname, ZipArchive::CREATE | ZipArchive::OVERWRITE);

// Create recursive directory iterator
/** @var SplFileInfo[] $files */
$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($rootPath),
    RecursiveIteratorIterator::LEAVES_ONLY
);

foreach ($files as $name => $file)
{
    // Skip directories (they would be added automatically)
    if (!$file->isDir())
    {
        // Get real and relative path for current file
        $filePath = $file->getRealPath();
        $relativePath = substr($filePath, strlen($rootPath) + 1);

        // Add current file to archive
        $zip->addFile($filePath, $relativePath);
    }
}

// Zip archive will be created only after closing object
$zip->close();
    header('Content-Type: application/zip');
    header("Content-Disposition: attachment; filename=$zipname");
    header('Content-Length: ' . filesize($zipname));
    header("Location: $zipname");
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
