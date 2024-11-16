<?php
include '../estructura/cabeceraSegura.php';
header('Content-Type: application/json');


/*** AJAX NO ANDA CASI QUEDO va para  -> (/menu/index.php) ---------------------------------- /
 /*---------------------------------- --------------------------------- */ 
/* ---------------------------------------------------------------------*/ 
/* -------------------------------------------------*/ 
/*------ESTOS ABM ANDUVIERON TODOS -----------*/
$objSesion = new Session();
$abmMenu = new abmMenu();
$abmUsuarioRol = new abmUsuarioRol();

$abmMenuRol = new abmMenuRol();
$abmRol = new abmRol();
$abmMenu = new abmMenu();

if($objSesion->activa()){
    $idUsuario = $objSesion->getUsuario()['idusuario'];
    $idrol = $objSesion->getRol();

    $param = ["idusuario" => $idUsuario , "idrol" => $idrol];
    $objUsuarioRol = $abmUsuarioRol->obtenerDatos($param)[0];
    $objMenurol = $abmMenuRol->obtenerDatos($objUsuarioRol['idrol']);

    $paramMenuOpciones['idpadre'] = $objMenurol[0]['idmenu'];
    $objMenuOpciones = $abmMenu->obtenerDatos($paramMenuOpciones);
    $nombreMenus = [];
    for($i=0;$i < count($objMenuOpciones); $i++){
        $nombreMenus[] = $objMenuOpciones[$i]['menombre'];
    }
    echo json_encode($nombreMenus);
}else {
    echo "ERROR";
}











?>
