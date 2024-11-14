<?php
include '../../../config.php';
$session = new Session();

$session->destruir();

header('Location: ../login/index.php');