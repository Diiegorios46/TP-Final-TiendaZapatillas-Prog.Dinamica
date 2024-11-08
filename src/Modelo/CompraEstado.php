<?php

class compraestado extends BaseDatos
{
    private $idcompraestado;
    private $objCompra;
    private $objComEstTipo;
    private $cefechaini;
    private $cefechafin;

    public function __construct()
    {
        $this->idcompraestado = "";
        $this->objCompra = new compra();
        $this->objComEstTipo = new compraestadotipo();
        $this->cefechaini = "";
        $this->cefechafin = "";
        $this->mensajeoperacion = "";
    }

    // Getters
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


    // Setters
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
        $sql = "INSERT INTO compraestado (idcompra, idcompraestadotipo, cefechaini, cefechafin) VALUES ({$this->getObjCompra()->getIdcompra()},{$this->getObjCompraEstadoTipo()->getIdcompraestadotipo()},'{$this->getCefechaini()}','{$this->getCefechafin()}');";

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
        $sql = "UPDATE compraestado SET idcompra={$this->getObjCompra()->getIdcompra()}, idcompraestadotipo={$this->getObjCompraEstadoTipo()->getIdcompraestadotipo()}, cefechaini='{$this->getCefechaini()}', cefechafin='{$this->getCefechafin()}' WHERE idcompraestado={$this->getIdcompraestado()}";

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
                return true;
            } else {
                $this->setMensajeOperacion("CompraEstado->eliminar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("CompraEstado->eliminar: " . $base->getError());
        }
        return $resp;
    }

    public static function listar($parametro = "")
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
                        // print_r($objCompra);
                    }
                    $objCompraEstadoTipo = null;
                    if ($row['idcompraestadotipo'] != null) {
                        $objCompraEstadoTipo = new compraestadotipo();
                        $objCompraEstadoTipo->setIdcompraestadotipo($row['idcompraestadotipo']);
                        // print_r($objCompraEstadoTipo);
                        $objCompraEstadoTipo->cargar();
                        // print_r($objCompraEstadoTipo);
                    }

                    $obj->setear($row['idcompraestado'], $objCompra, $objCompraEstadoTipo, $row['cefechaini'], $row['cefechafin']);
                    // print_r($obj);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setMensajeOperacion("CompraEstado->listar: " . $base->getError());
        }
        return $arreglo;
    }
}