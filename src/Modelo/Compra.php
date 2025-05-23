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
        $this->idusuario = "";
        $this->mensajeoperacion = "";
    }
    
    // Getters
    public function getIdcompra()
    {
        return $this->idcompra;
    }
    
    public function getIdusuario()
    {
        return $this->idusuario;
    }
    public function getCofecha()
    {
        return $this->cofecha;
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

    public function setMensajeOperacion($setMensajeOperacion){
        return $setMensajeOperacion = $setMensajeOperacion;
    }

    public function setear($param)
    {
        $this->setIdcompra($param['idcompra']);
        $this->setCofecha($param['cofecha']);
        $this->setIdusuario($param['idusuario']);

    }

    public function cargar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM compra WHERE idcompra = " . $this->getIdcompra();

        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro();

                    $objUsuario = NULL;
                    if ($row['idusuario'] != null) {
                        $objUsuario = new Usuario();
                        $objUsuario->setIdusuario($row['idusuario']);
                        $objUsuario->cargar();
                    }

                    $this->setear($row);
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
        $sql = "INSERT INTO compra (cofecha, idusuario) VALUES ('{$this->getCofecha()}',{$this->getIdusuario()});";
        echo "\n\nSQL: " . $sql."\n\n";
        if ($base->Iniciar()) {
            if ($elid = $base->Ejecutar($sql)) {
                echo "se ejecuto una consulta en compra";
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
        $id = $this->getIdcompra() ? $this->getIdcompra() : 'NULL';
        
        $sql = "UPDATE compra SET cofecha='{$this->getCofecha()}', idusuario='{$this->getIdusuario()}' WHERE idcompra='{$this->getIdcompra()}'";
        
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
                $resp = true;
            } else {
                $this->setMensajeOperacion("Compra->eliminar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("Compra->eliminar: " . $base->getError());
        }
        return $resp;
    }

    public function listar($parametro = "")
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
                    $obj->setear($row);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setMensajeOperacion("Compra->listar: " . $base->getError());
        }

        return $arreglo;
    }
}