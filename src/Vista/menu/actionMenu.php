<?php
// include '../../../config.php';
// //header('Content-Type: application/json');

// $abmMenu = new abmMenu();
// $abmUsuarioRol = new abmUsuarioRol();

// $abmMenuRol = new abmMenuRol();
// $abmRol = new abmRol();
// $abmMenu = new abmMenu();

// if($session->activa()){
//     $idUsuario = $session->getUsuario()['idusuario'];
//     $idrol = $session->getRol();

//     $param = ["idusuario" => $idUsuario , "idrol" => $idrol];
//     $objUsuarioRol = $abmUsuarioRol->obtenerDatos($param)[0];
//     $objMenurol = $abmMenuRol->obtenerDatos(["idrol" => $objUsuarioRol['idrol']]);
//     $objMenuOpciones = $abmMenu->obtenerDatos(["idpadre" => $objMenurol[0]['idmenu']]);
//     $nombreMenus = [];

//     for($i=0;$i < count($objMenuOpciones); $i++){
        
//         $nombreMenus[] = $objMenuOpciones[$i]['menombre'];
//     }

//     echo json_encode($nombreMenus);
// }else {
//     echo json_encode("ERROR");
// }
?>
