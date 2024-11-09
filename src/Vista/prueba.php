<?php
include_once './estructura/cabecera.php';

//menu ANDO alta - modificar - eliminar ✅
//Usuario ANDO alta - modificar - baja (logica) ✅
//rol alta - modificacion - eliminar 
//PRODUCTO alta - editar - eliminar
//menurol 

$objMenu = new abmMenu();
$objUsuario = new abmUsuario();
$objRol = new abmRol();
$objProducto = new abmProducto();
$abmMenuRol = new abmMenuRol();

$param = ["accion" => "nuevo", 
          "idrol" => 2,
          "idmenu" => 17
];

$abmMenuRol->abm($param);




