<?php
include '../../../config.php';
$session = new Session();

$session->cerrar();

header('Location: ../login/index.php');