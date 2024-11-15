<?php
include '../estructura/cabeceraSegura.php';


$abm = new abmMenu();
echo $abm->menuUsuario($rol);

public function menuUsuario($rol){
    $menu = new Menu();
    return $menu->obtenerMenu($rol);
}


public function obtenerMenu($rol){
    $menu = new Menu();
    $where = "true";
    if ($rol != null) {
        if (isset($rol['idrol'])) {
            $where .= " and idrol =" . $rol['idrol'];
        }
        if (isset($rol['rodescripcion'])) {
            $where .= " and rodescripcion ='" . $rol['rodescripcion'] . "'";
        }
    }
    $arreglo = $menu->listar($where);
    return $arreglo;
}

?>


rol = usuario 



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <!--SI sos administrador-->
        <!--este cpdogp -->
        <!-- -->
</body>
</html>