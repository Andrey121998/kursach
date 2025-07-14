<?php
// application/db.php
$GLOBALS['pdo'] = new PDO(
    'mysql:host=127.127.126.50;port=3306;dbname=Tusk_bd',
    'root',
    '',
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]
);

$GLOBALS['pdo']->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);

?>

