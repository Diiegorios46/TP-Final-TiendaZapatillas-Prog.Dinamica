<?php
header('Content-Type: text/html;charset=utf-8');
header ("Cache-Control: no-cache,must-revalidate");

session_start();

/////////////////////////////
// CONFIGURACION APP//
/////////////////////////////
//usa la información del servidor para determinar automáticamente el directorio del proyecto
$PROYECTO = basename(__DIR__);;

//variable que almacena el directorio del proyecto
$ROOT = $_SERVER['DOCUMENT_ROOT']."/$PROYECTO/";

include_once($ROOT.'src/Utils/utils.php');
// include_once($ROOT.'vendor/autoload.php');
include_once($ROOT.'src/Control/Session.php');

// Variable que define la pagina de autenticacion del proyecto
$INICIO = "Location:http://".$_SERVER['HTTP_HOST']."/$PROYECTO/vista/login/login.php";

// variable que define la pagina principal del proyecto (menu principal)
$PRINCIPAL = "Location:http://".$_SERVER['HTTP_HOST']."/$PROYECTO/principal.php";
$session = new Session();
$session->setearUnDato( ['nombreDato'=>'ROOT','dato'=>$ROOT]);
?>