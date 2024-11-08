<?php
/*`idcompraitem` bigint(20) UNSIGNED NOT NULL,
  `idproducto` bigint(20) NOT NULL,
  `idcompra` bigint(20) NOT NULL,
  `cicantidad` int(11) NOT NULL 
*/

class CompraItem extends BaseDatos
{
    private $idcompraitem;
    private $objProducto;
    private $objCompra;
    private $cicantidad;
    private $mensajeOperacion;
    
    public function getIdcompraitem()
    {
        return $this->idcompraitem;
    }

    public function getObjProducto()
    {
        return $this->objProducto;
    }

    public function getObjCompra()
    {
        return $this->objCompra;
    }

    public function getCicantidad()
    {
        return $this->cicantidad;
    }

    public function setIdcompraitem($idcompraitem)
    {
        $this->idcompraitem = $idcompraitem;
    }

    public function setObjProducto($objProducto)
    {
        $this->objProducto = $objProducto;
    }

    public function setObjCompra($objCompra)
    {
        $this->objCompra = $objCompra;
    }

    public function setCicantidad($cicantidad)
    {
        $this->cicantidad = $cicantidad;
    }
    public function setMensajeOperacion($mensajeoperacion)
    {
        $this->mensajeoperacion = $mensajeoperacion;
    }


    public function setMedeshabilitado($medeshabilitado)
    {
        $this->medeshabilitado = $medeshabilitado;
    }
    
    public function setear($idcompraitem, $objProducto, $objCompra, $cicantidad){
        $this->setIdcompraitem($idcompraitem);
        $this->setObjProducto($objProducto);
        $this->setObjCompra($objCompra);
        $this->setCicantidad($cicantidad);
    }

    public function cargar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM compraitem WHERE idcompraitem = " . $this->getIdcompraitem();
        
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro();

                    $objProducto = NULL;
                    if ($row['objProducto'] != null) {
                        $objProducto = new producto();
                        $objProducto->setIdproducto($row['idproducto']);
                        $objProducto->cargar();
                    }
                    $objCompra = NULL;
                    if ($row['objCompra'] != null) {
                        $objCompra = new compra();
                        $objCompra->setIdcompra($row['idcompra']);
                        $objCompra->cargar();
                    }

                    $this->setear($row['idcompraitem'], $objProducto, $objCompra, $row['cicantidad']);
                    $resp = true;
                }
            }
        } else {
            $this->setMensajeOperacion("CompraItem->listar: " . $base->getError());
        }
        return $resp;
    }

    public function insertar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "INSERT INTO compraitem (idproducto, idcompra, cicantidad) 
        VALUES ('{$this->getObjProducto()->getIdproducto()}',
               {$this->getObjCompra()->getIdcompra()},
               '{$this->getCicantidad()}');";
        
        if ($base->Iniciar()) {
            if ($base = $base->Ejecutar($sql)) {
                $this->setIdcompraitem($base);
                $resp = true;
            } else {
                $this->setMensajeOperacion("CompraItem->insertar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("CompraItem->insertar: " . $base->getError());
        }
        return $resp;
    }

    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE compraitem SET idcompraitem={$this->getIdcompraitem()}, idproducto='{$this->getObjProducto()->getIdproducto()}', idcompra={$this->getObjCompra()->getIdcompra()}, cicantidad={$this->getCicantidad()} WHERE idcompraitem={$this->getIdcompraitem()}";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("CompraItem->modificar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("CompraItem->modificar: " . $base->getError());
        }
        return $resp;
    }

    public function eliminar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM compraitem WHERE idcompraitem=" . $this->getIdcompraitem();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setMensajeOperacion("CompraItem->eliminar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("CompraItem->eliminar: " . $base->getError());
        }
        return $resp;
    }

    public function listar($parametro = "")
    {
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM compraitem";

        if ($parametro != "") {
            $sql .= 'WHERE ' . $parametro;
        }

        $res = $base->Ejecutar($sql);
        if ($res > -1) {
            if ($res > 0) {

                while ($row = $base->Registro()) {
                    $obj = new CompraItem();

                    $objProducto = NULL;
                    if ($row['idproducto'] != null) {
                        $objProducto = new producto();
                        $objProducto->setIdproducto($row['idproducto']);
                        $objProducto->cargar();
                    }
                    $objCompra = NULL;
                    if ($row['idcompra'] != null) {
                        $objCompra = new compra();
                        $objCompra->setIdcompra($row['idcompra']);
                        $objCompra->cargar();
                    }

                    $obj->setear($row['idcompraitem'],
                                $objProducto,
                                $objCompra,
                                $row['cicantidad']);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setMensajeOperacion("CompraItem->listar: " . $base->getError());
        }

        return $arreglo;
    }

    /*
    public function contar($parametro = "")
    {
        $arreglo = array();
        $base = new BaseDatos();
        $res = $base->Ejecutar($parametro);
        if ($res > -1) {
            if ($res > 0) {

                while ($row = $base->Registro()) {
                    if ($row['cantidad'] != null) {
                        $cantidad = $row['cantidad'];
                    }
                    array_push($arreglo, $cantidad);
                }
            }
        } else {
            $this->setMensajeOperacion("CompraItem->listar: " . $base->getError());
        }

        return $arreglo;
    }
    */

}