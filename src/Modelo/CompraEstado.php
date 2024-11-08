<?php

class Compraestado extends BaseDatos
{
    private $idcompraestado;
    private $objCompra;
    private $objComEstTipo;
    private $cefechaini;
    private $cefechafin;
    private $mensajeoperacion;

    public function __construct()
    {
        $this->idcompraestado = "";
        $this->objCompra = new compra();
        $this->objComEstTipo = new compraestadotipo();
        $this->cefechaini = "";
        $this->cefechafin = "";
        $this->mensajeoperacion = "";
    }

    public function getIdcompraestado()
    {
        return $this->idcompraestado;
    }

    public function getObjCompra()
    {
        return $this->objCompra;
    }

    public function getObjCompraEstadoTipo()
    {
        return $this->objComEstTipo;
    }

    public function getCefechaini()
    {
        return $this->cefechaini;
    }

    public function getCefechafin()
    {
        return $this->cefechafin;
    }

    public function getMensajeOperacion()
    {
        return $this->mensajeoperacion;
    }

    public function setIdcompraestado($idcompraestado)
    {
        $this->idcompraestado = $idcompraestado;
    }

    public function setObjCompra($objCompra)
    {
        $this->objCompra = $objCompra;
    }

    public function setObjCompraEstadoTipo($objComEstTipo)
    {
        $this->objComEstTipo = $objComEstTipo;
    }

    public function setCefechaini($cefechaini)
    {
        $this->cefechaini = $cefechaini;
    }

    public function setCefechafin($cefechafin)
    {
        $this->cefechafin = $cefechafin;
    }

    public function setMensajeOperacion($mensajeoperacion)
    {
        $this->mensajeoperacion = $mensajeoperacion;
    }


    public function setear($idcompraestado, $objCompra, $objCompraEstadoTipo, $cefechaini, $cefechafin)
    {
        $this->setIdcompraestado($idcompraestado);
        $this->setObjCompra($objCompra);
        $this->setObjCompraEstadoTipo($objCompraEstadoTipo);
        $this->setCefechaini($cefechaini);
        $this->setCefechafin($cefechafin);

    }

    public function cargar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM compraestado WHERE idcompraestado = " . $this->getIdcompraestado();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro();

                    $objCompra = null;
                    if ($row['idcompra'] != null) {
                        $objCompra = new compra();
                        $objCompra->setIdcompra($row['idcompra']);
                        $objCompra->cargar();
                    }
                    $objCompraEstadoTipo = null;
                    if ($row['idcompraestadotipo'] != null) {
                        $objCompraEstadoTipo = new compraestadotipo();
                        $objCompraEstadoTipo->setIdcompraestadotipo($row['idcompraestadotipo']);
                        $objCompraEstadoTipo->cargar();
                    }

                    $this->setear($row['idcompraestado'], $objCompra, $objCompraEstadoTipo, $row['cefechaini'], $row['cefechafin']);
                    $resp = true;
                }
            }
        } else {
            $this->setMensajeOperacion("CompraEstado->listar: " . $base->getError());
        }
        return $resp;
    }

    public function insertar()
    {
        $resp = false;
        $base = new BaseDatos();
        $idCompra = $this->getObjCompra() ? $this->getObjCompra()->getIdcompra() : 'NULL';

        $idCompraEstadoTipo = $this->getObjCompraEstadoTipo() ? $this->getObjCompraEstadoTipo()->getIdcompraestadotipo() : 'NULL';
        $sql = 
        "INSERT INTO compraestado (idcompra, idcompraestadotipo, cefechaini, cefechafin) 
         VALUES 
         ({$idCompra},{$idCompraEstadoTipo},'{$this->getCefechaini()}','{$this->getCefechafin()}');";

        if ($base->Iniciar()) {
            if ($base = $base->Ejecutar($sql)) {
                $this->setIdcompraestado($base);
                $resp = true;
            } else {
                $this->setMensajeOperacion("CompraEstado->insertar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("CompraEstado->insertar: " . $base->getError());
        }
        return $resp;
    }

    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        $idCompra = $this->getObjCompra() ? $this->getObjCompra()->getIdcompra() : 'NULL';
        $idCompraEstadoTipo = $this->getObjCompraEstadoTipo() ? $this->getObjCompraEstadoTipo()->getIdcompraestadotipo() : 'NULL';
        
        $sql = "UPDATE compraestado SET idcompra={$idCompra}, 
        idcompraestadotipo={$idCompraEstadoTipo},
        cefechaini='{$this->getCefechaini()}',
        cefechafin='{$this->getCefechafin()}' WHERE idcompraestado = {$this->getIdcompraestado()}";

        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("CompraEstado->modificar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("CompraEstado->modificar: " . $base->getError());
        }
        return $resp;
    }

    public function eliminar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM compraestado WHERE idcompraestado=" . $this->getIdcompraestado();

        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("CompraEstado->eliminar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("CompraEstado->eliminar: " . $base->getError());
        }
        return $resp;
    }

    public function listar($parametro = "")
    {
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM compraestado ";
        
        if ($parametro != "") {
            $sql .= 'WHERE ' . $parametro;
        }

        $res = $base->Ejecutar($sql);
        if ($res > -1) {
            if ($res > 0) {
                while ($row = $base->Registro()) {
                    $obj = new compraestado();
                    $objCompra = null;
                    if ($row['idcompra'] != null) {
                        $objCompra = new compra();
                        $objCompra->setIdcompra($row['idcompra']);
                        $objCompra->cargar();
                    }
                    $objCompraEstadoTipo = null;
                    if ($row['idcompraestadotipo'] != null) {
                        $objCompraEstadoTipo = new compraestadotipo();
                        $objCompraEstadoTipo->setIdcompraestadotipo($row['idcompraestadotipo']);
                        $objCompraEstadoTipo->cargar();
                    }

                    $obj->setear($row['idcompraestado'], 
                                 $objCompra, 
                                 $objCompraEstadoTipo, 
                                 $row['cefechaini'], 
                                 $row['cefechafin']);

                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setMensajeOperacion("CompraEstado->listar: " . $base->getError());
        }
        return $arreglo;
    }
}