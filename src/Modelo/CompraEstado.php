<?php

class CompraEstado extends BaseDatos
{
    private $idcompraestado;
    private $idcompra;
    private $idcomesttipo;
    private $cefechaini;
    private $cefechafin;
    private $mensajeoperacion;

    public function getIdcompraestado()
    {
        return $this->idcompraestado;
    }

    public function getIdcompra()
    {
        return $this->idcompra;
    }

    public function getIdcompraEstadoTipo()
    {
        return $this->idcomesttipo;
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

    public function setIdcompra($idcompra)
    {
        $this->idcompra = $idcompra;
    }

    public function setIdcompraestadotipo($idcomesttipo)
    {
        $this->idcomesttipo = $idcomesttipo;
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


    public function setear($param)
    {
        $this->setIdcompraestado($param["idcompraestado"]);
        $this->setIdcompra($param["idcompra"]);
        $this->setIdcompraestadotipo($param["idcompraestadotipo"]);
        $this->setCefechaini($param["cefechaini"]);
        $this->setCefechafin($param["cefechafin"]);
    }

    public function insertar()
    {
        $resp = false;
        $base = new BaseDatos();

        $sql =  "INSERT INTO compraestado (idcompra, idcompraestadotipo, cefechaini, cefechafin)  VALUES   ({$this->getIdcompra()},{$this->getIdcompraestadotipo()},'{$this->getCefechaini()}','{$this->getCefechafin()}');";
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
        $idCompra = $this->getIdcompra() ? $this->getIdcompra() : 'NULL';
        $idCompraEstadoTipo = $this->getIdcompraEstadoTipo() ? $this->getIdcompraestadotipo() : 'NULL';
        
        $sql = "UPDATE compraestado SET idcompra={$idCompra},  idcompraestadotipo={$idCompraEstadoTipo}, cefechaini='{$this->getCefechaini()}', cefechafin='{$this->getCefechafin()}' WHERE idcompraestado = {$this->getIdcompraestado()}";

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


        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
        } else {
            $this->setMensajeOperacion("CompraEstado->listar: " . $base->getError());
            return $arreglo;
        }

        if ($res > -1) {
            if ($res > 0) {
                while ($row = $base->Registro()) {
                    $obj = new CompraEstado();
                    $obj->setear($row);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setMensajeOperacion("CompraEstado->listar: " . $base->getError());
        }
        return $arreglo;
    }
}