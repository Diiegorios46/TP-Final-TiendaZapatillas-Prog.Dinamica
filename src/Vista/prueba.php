<?php
include_once './estructura/cabecera.php';

//menu ANDO alta - modificar - eliminar ✅
//Usuario ANDO alta - modificar - baja (logica) ✅
//rol alta - modificacion - eliminar 
//PRODUCTO alta - editar - eliminar

$objMenu = new abmMenu();
$objUsuario = new abmUsuario();
$objRol = new abmRol();
$objProducto = new abmProducto();
$objMenuRol = new abmMenuRol();

/*$param = ["menombre" => "barquito" ,
         "accion" => "nuevo", 
         'idmenu' => 18,
          "medescripcion" => "hola",
          'idpadre'=> null,
          'medeshabilitado'=> null
];*/

$param = [
        "idproducto" =>  1,
        "pronombre" => "adi 200000",
        "prodetalle" => "LAS MAS BUENARDAS",
        "procantstock" => 100000,
        "proprecio" => 1000.50,
        "accion" => "borrar"
];

$objProducto->abm($param);




