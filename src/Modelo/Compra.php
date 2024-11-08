<?php

class Compra extends BaseDatos
{
    private $idcompra;
    private $cofecha;
    private $idusuario;

    public function __construct()
    {
        $this->idcompra = "";
        $this->cofecha = "";
        $this->idusuario = new Usuario();
        $this->mensajeoperacion = "";
    }
    
    // Getters
    public function getIdcompra()
    {
        return $this->idcompra;
    }
    
    public function getCofecha()
    {
        return $this->cofecha;
    }
    
    public function getIdusuario()
    {
        return $this->idusuario;
    }

    public function setIdcompra($idcompra)
    {
        $this->idcompra = $idcompra;
    }

    public function setCofecha($cofecha)
    {
        $this->cofecha = $cofecha;
    }

    public function setIdusuario($objUsuario)
    {
        $this->idusuario = $objUsuario;
    }


    public function setear($idcompra, $cofecha, $objUsuario)
    {
        $this->setIdcompra($idcompra);
        $this->setCofecha($cofecha);
        $this->setIdusuario($objUsuario);
    }

    public function cargar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM compra WHERE idcompra = " . $this->getIdcompra();
        // echo $sql;
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro();

                    $objUsuario = NULL;
                    if ($row['idusuario'] != null) {
                        $objUsuario = new usuario();
                        $objUsuario->setIdusuario($row['idusuario']);
                        $objUsuario->cargar();
                    }

                    $this->setear($row['idcompra'], $row['cofecha'], $objUsuario);
                    $resp = true;
                }
            }
        } else {
            $this->setMensajeOperacion("Compra->listar: " . $base->getError());
        }
        return $resp;
    }

    public function insertar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "INSERT INTO compra (cofecha, idusuario) VALUES ('{$this->getCofecha()}','{$this->getIdusuario()->getIdusuario()}');";
        // echo $sql;
        if ($base->Iniciar()) {
            if ($elid = $base->Ejecutar($sql)) {
                $this->setIdcompra($elid);
                $resp = true;
            } else {
                $this->setMensajeOperacion("Compra->insertar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("Compra->insertar: " . $base->getError());
        }
        return $resp;
    }

    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE compra SET idcompra='{$this->getIdcompra()}', cofecha='{$this->getCofecha()}', idusuario='{$this->getIdusuario()->getIdusuario()}' WHERE idcompra='{$this->getIdcompra()}'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("Compra->modificar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("Compra->modificar: " . $base->getError());
        }
        return $resp;
    }

    public function eliminar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM compra WHERE idcompra=" . $this->getIdcompra();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setMensajeOperacion("Compra->eliminar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("Compra->eliminar: " . $base->getError());
        }
        return $resp;
    }

    public static function listar($parametro = "")
    {
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM compra ";
        if ($parametro != "") {
            $sql .= 'WHERE ' . $parametro;
        }
        $res = $base->Ejecutar($sql);
        if ($res > -1) {
            if ($res > 0) {

                while ($row = $base->Registro()) {
                    $obj = new Compra();

                    $objUsuario = NULL;
                    if ($row['idusuario'] != null) {
                        $objUsuario = new usuario();
                        $objUsuario->setIdusuario($row['idusuario']);
                        $objUsuario->cargar();
                    }

                    $obj->setear($row['idcompra'], $row['cofecha'], $objUsuario);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setMensajeOperacion("Compra->listar: " . $base->getError());
        }

        return $arreglo;
    }
}