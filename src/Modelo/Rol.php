<?php

class Rol extends BaseDatos{
    private $idRol;
    private $roDescripcion;
    private $mensajeOperacion;
    
    public function getIdRol(){
        return $this->idRol;
    }
    public function setIdRol($idRol){
        $this->idRol = $idRol;
    }
    public function getRolDescripcion(){
        return $this->roDescripcion;
    }
    public function setRoDescripcion($roDescripcion){
        $this->roDescripcion = $roDescripcion;
    }
    public function setMensajeOperacion($mensajeOperacion)
    {
        $this->mensajeOperacion = $mensajeOperacion;
    }

    public function setear($datosUsuario){
        $this->setIdRol($datosUsuario['idrol']);
        $this->setRoDescripcion($datosUsuario['rodescripcion']);
    }

   

    public function cargar()
    {
        $resp = false;
        $base = new BaseDatos();

        $sql = "SELECT * FROM rol WHERE idrol = '" . $this->getIdRol() . "'";

        if ($base->Iniciar()) {
            echo '1';
            $res = $base->Ejecutar($sql);
            echo '2';
            if ($res > -1) {
                echo '3';
                if ($res > 0) {
                    echo '4';
                    $row = $base->Registro();
                    echo '5';
                    $this->setear($row);
                    $resp = true;
                }
            }
        } else {
            $this->setMensajeOperacion("Producto->listar: " . $base->getError());
        }

        return $resp;
    }

    public function insertar()
    {
    $resp = false;
    $base = new BaseDatos();

    $sql = "INSERT INTO rol (rodescripcion) VALUES ('" . $this->getRolDescripcion() . "')";

    if ($base->Iniciar()) {
    if ($elId = $base->devuelveIDInsercion($sql)) {
        $this->setIdRol($elId);
        $resp = true;
    } else {
        $this->setMensajeOperacion("Rol->insertar: " . $base->getError());
    }
    } else {
    $this->setMensajeOperacion("Rol->insertar: " . $base->getError());
    }

    return $resp;
    }

    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();

        $sql = "UPDATE rol SET rodescripcion = '" . $this->getRolDescripcion() . "' WHERE idrol = " . $this->getIdRol();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("Rol->modificar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("Rol->modificar: " . $base->getError());
        }

        return $resp;
    }

    public function eliminar()
    {
        $resp = false;
        $base = new BaseDatos();

        $sql = "DELETE FROM rol WHERE idrol = " . $this->getIdRol();

        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("Rol->eliminar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("Rol->eliminar: " . $base->getError());
        }

        return $resp;
    }

    public function listar($parametro)
    {
        $arreglo = null;
        $base = new BaseDatos();

        $sql = "SELECT * FROM rol ";

        if ($parametro != "") {
            $sql .= 'WHERE ' . $parametro;
        }

        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $arreglo = array();
                while ($row2 = $base->Registro()) {
                    $obj = new Rol();
                    $obj->setear($row2);
                    array_push($arreglo, $obj);
                }
            } else {
                $this->setMensajeOperacion("Rol->listar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("Rol->listar: " . $base->getError());
        }
        return $arreglo;
    }


    public function __toString(){
        return "IdRol: ".$this->getIdRol()."\nRoDescripcion: ".$this->getRolDescripcion();
    }

}