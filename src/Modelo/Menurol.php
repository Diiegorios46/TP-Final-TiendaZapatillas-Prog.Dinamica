<?php

class MenuRol extends BaseDatos
{
    private $idmenu;
    private $idrol;

    public function getIdmenu()
    {
        return $this->idmenu;
    }

    public function setIdmenu($idmenu){
        $this->idmenu = $idmenu;
    }
    public function getIdrol(){
        return $this->idrol;
    }

    public function setIdrol($idrol){
        $this->idrol = $idrol;
    }

    public function setear($idmenu, $idrol){
        $this->setIdmenu($idmenu);
        $this->setIdrol($idrol);
    }

    public function cargar()
    {
        $resp = false;
        $base = new BaseDatos();

        $sql = "SELECT * FROM menurol WHERE idrol = '" . $this->getIdrol() . "'";

        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro();
                    $this->setear($row['idmenu'], $row['idrol']);
                    $resp = true;
                }
            }
        } else {
            $this->setMensajeOperacion("menurol->listar: " . $base->getError());
        }

        return $resp;
    }

    public function insertar()
    {
        $resp = false;
        $base = new BaseDatos();

        $sql = "INSERT INTO menurol (idmenu, proprecio, prodescuento, pronombre, prodetalle, procantventas, procantstock, prodeshabilitado) 
        VALUES ('" . $this->getIdmenu() . "'," . $this->getProprecio() . "," . $this->getProdescuento() . ",'" . $this->getPronombre() . "','" . $this->getProdetalle() . "'," . $this->getProcantventas() . "," . $this->getProcantstock() . ",'0000-00-00 00:00:00')";

        if ($base->Iniciar()) {
            if ($base = $base->Ejecutar($sql)) {
                $this->setIdmenurol($base);
                $resp = true;
            } else {
                $this->setMensajeOperacion("menurol->insertar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("menurol->insertar: " . $base->getError());
        }
        return $resp;
    }

    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE menurol SET idmenurol='" . $this->getIdmenurol() . "', proprecio=" . $this->getProprecio() . ", prodescuento=" . $this->getProdescuento() . ", pronombre='" . $this->getPronombre() . "', prodetalle='" . $this->getProdetalle() . "', procantventas=" . $this->getProcantventas() . ", procantstock=" . $this->getProcantstock() . ", prodeshabilitado = '0000-00-00 00:00:00' WHERE idmenurol='" . $this->getIdmenurol() . "'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("menurol->modificar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("menurol->modificar: " . $base->getError());
        }
        return $resp;
    }

    public function eliminar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM menurol WHERE idmenurol='" . $this->getIdmenurol() . "'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setMensajeOperacion("menurol->eliminar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("menurol->eliminar: " . $base->getError());
        }
        return $resp;
    }

    public static function listar($parametro = "")
    {
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM menurol ";
        if ($parametro != "") {
            $sql .= 'WHERE ' . $parametro;
        }
        $res = $base->Ejecutar($sql);
        if ($res > -1) {
            if ($res > 0) {
                while ($row = $base->Registro()) {
                    // print_r($row);
                    $obj = new menurol();
                    $obj->setear($row['idmenurol'], $row['proprecio'], $row['prodescuento'], $row['pronombre'], $row['prodetalle'], $row['procantventas'], $row['procantstock'], $row['prodeshabilitado']);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setMensajeOperacion("menurol->listar: " . $base->getError());
        }

        return $arreglo;
    }

    /*
    public function estado($param = "")
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE menurol SET prodeshabilitado= '" . $param . "' WHERE idmenurol='" . $this->getIdmenurol() . "'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("menurol->estado: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("menurol->estado: " . $base->getError());
        }
        return $resp;
    }
    */
    
}