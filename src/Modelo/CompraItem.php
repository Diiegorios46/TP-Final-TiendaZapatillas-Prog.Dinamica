<?php
/*`idcompraitem` bigint(20) UNSIGNED NOT NULL,
  `idproducto` bigint(20) NOT NULL,
  `idcompra` bigint(20) NOT NULL,
  `cicantidad` int(11) NOT NULL 
*/

class CompraItem extends BaseDatos
{
    private $idcompraitem;
    private $idproducto;
    private $idCompra;
    private $cicantidad;
    private $mensajeOperacion;
    
    public function getIdcompraitem()
    {
        return $this->idcompraitem;
    }

    public function getIdproducto()
    {
        return $this->idproducto;
    }

    public function getIdCompra()
    {
        return $this->idCompra;
    }

    public function getCicantidad()
    {
        return $this->cicantidad;
    }

    public function setIdcompraitem($idcompraitem)
    {
        $this->idcompraitem = $idcompraitem;
    }

    public function setIdproducto($idproducto)
    {
        $this->idproducto = $idproducto;
    }

    public function setIdCompra($idCompra)
    {
        $this->idCompra = $idCompra;
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
    
    public function setear($param){
        verEstructura($param);
        $this->setIdcompraitem($param['idcompraitem']);
        $this->setIdproducto($param['idproducto']);
        $this->setIdCompra($param['idcompra']);
        $this->setCicantidad($param['cicantidad']);
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

                    $idProducto = NULL;
                    if ($row['idproducto'] != null) {
                        $idProducto = new producto();
                        $idProducto->setIdproducto($row['idproducto']);
                        $idProducto->cargar();
                    }

                    $objCompra = NULL;
                    if ($row['idcompra'] != null) {
                        $objCompra = new compra();
                        $objCompra->setIdcompra($row['idcompra']);
                        $objCompra->cargar();
                    }

                    $this->setear($row['idcompraitem'], $idProducto, $objCompra, $row['cicantidad']);
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
        
        $sql = "INSERT INTO compraitem (idproducto, idcompra, cicantidad) VALUES ('{$this->getIdproducto()}',{$this->getIdcompra()},'{$this->getCicantidad()}');";

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
        
        $sql = "UPDATE compraitem SET idproducto='{$this->getIdproducto()}', idcompra={$this->getIdcompra()}, cicantidad={$this->getCicantidad()} WHERE idcompraitem={$this->getIdcompraitem()}";
        verEstructura($sql);
        
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

                    $idProducto = NULL;
                    if ($row['idproducto'] != null) {
                        $idProducto = new producto();
                        $idProducto->setIdproducto($row['idproducto']);
                        $idProducto->cargar();
                    }
                    $objCompra = NULL;
                    if ($row['idcompra'] != null) {
                        $objCompra = new compra();
                        $objCompra->setIdcompra($row['idcompra']);
                        $objCompra->cargar();
                    }

                    $obj->setear($row['idcompraitem'],
                                $idProducto,
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