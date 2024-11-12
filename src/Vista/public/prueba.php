<?php
include_once './estructura/cabecera.php';

//menu ANDO alta - modificar - eliminar ✅
//Usuario ANDO alta - modificar - baja (logica) ✅
//rol alta - modificacion - eliminar ✅
//PRODUCTO alta - editar - eliminar ✅
//menurol alta - editar - eliminar 👍
//usuarioRol  alta - editar - eliminar ✅
// compra alta - editar - eliminar ✅
// compraItem alta - editar - eliminar ✅
// compraEstadoTipo alta - editar - eliminar ✅
// compraEstado alta - editar - eliminar ✅

$objMenu = new abmMenu();
$objUsuario = new abmUsuario();
$objRol = new abmRol();
$objProducto = new abmProducto();
$abmMenuRol = new abmMenuRol();
$abmUsuarioRol = new abmUsuarioRol();
$abmCompra = new abmCompra();
$abmCompraItem = new abmCompraItem();
$abmCompraEstadoTipo = new abmCompraEstadoTipo();
$abmCompraEstado = new abmCompraEstado();


/**`idcompraitem` bigint(20) UNSIGNED NOT NULL,
  `idproducto` bigint(20) NOT NULL,
  `idcompra` bigint(20) NOT NULL,
  `cicantidad` int(11) NOT NULL */

// $paramCompra = [
//     "idcompra" => 2,
//     "cofecha" => date("Y-m-d H:i:s"),
//     "idusuario" => 1,
//     "accion" => "borrar"
// ];

/*
$param = [
    "idcompraitem" => null,
    "idproducto" => 2,
    "idcompra" => 3,
    "cicantidad" => 16,
    "accion" => "nuevo"
];
  `idcompraestado` bigint(20) UNSIGNED NOT NULL,
  `idcompra` bigint(11) NOT NULL,
  `idcompraestadotipo` int(11) NOT NULL,
  `cefechaini` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cefechafin` timestamp NULL DEFAULT NULL
  */
  
  $param = [
    "idcompraestado" => null,
    "idcompra" => 3,
    "idcompraestadotipo" => 1,
    "cefechafin" => date("Y-m-d H:i:s") ,
    "cefechaini" => date("Y-m-d H:i:s"),
    "accion" => "nuevo"
];
  // $param = [
    //     "idcompraestado" => 1,
//     "idcompra" => 3,
//     "idcompraestadotipo" => 3,
//     "cefechafin" => date("Y-m-d H:i:s") ,
//     "cefechaini" => date("Y-m-d H:i:s"),
//     "accion" => "borrar"
// ];

$abmCompraEstado->abm($param);