<?php

class MenuRol extends BaseDatos
{
    private $idmenu;
    private $idrol;
    private $mensajeOperacion;

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

    public function setMensajeOperacion($mensajeOperacion)
    {
        $this->mensajeOperacion = $mensajeOperacion;
    }

    public function setear($idrol, $idmenu){
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

        $sql = "INSERT INTO menurol (idmenu, idrol) VALUES ('" . $this->getIdmenu() . "', '" . $this->getIdrol() . "')";

        if ($base->Iniciar()) {
            if ($base = $base->Ejecutar($sql)) {
                $this->setIdmenu($base);
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
        $sql = "UPDATE menurol SET idrol= " . $this->getIdrol() . " where idmenu =" . $this->getIdmenu() ."";
        
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
        $sql = "DELETE FROM menurol WHERE idmenu='" . $this->getIdmenu() . "'";

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

    public function listar($parametro = "")
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
                    $obj = new Menurol();
                    $obj->setear($row['idmenu'], $row['idrol']);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setMensajeOperacion("menurol->listar: " . $base->getError());
        }
        
        return $arreglo;
    }

}