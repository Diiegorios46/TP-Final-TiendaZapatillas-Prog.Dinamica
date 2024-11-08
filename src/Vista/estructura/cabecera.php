<?php 

require "../../../config.php";

use Whoops\Run;
use Whoops\Handler\PrettyPageHandler;
$whoops = new Run();
$whoops->pushHandler(new PrettyPageHandler());
$whoops->register();

$titulo = "Carga";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php $titulo ?> </title>
</head>
<body>
        <nav>Carga</nav>
