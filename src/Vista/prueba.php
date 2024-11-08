<?php

//agregar el QR

include_once '../estructura/header.php';

use Whoops\Run;
use Whoops\Handler\PrettyPageHandler;
$whoops = new Run();
$whoops->pushHandler(new PrettyPageHandler());
$whoops->register();

?>
