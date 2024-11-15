<?php

class UsuarioRol extends BaseDatos{
    private $idUsuario;
    private $idRol;
    private $mensajeOperacion;

    public function getIdUsuario(){
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario){
        $this->idUsuario = $idUsuario;
    }

    public function getIdRol(){
        return $this->idRol;
    }

    public function setIdRol($idRol){
        $this->idRol = $idRol;
    }

    
    public function setMensajeOperacion($mensajeOperacion)
    {
        $this->mensajeOperacion = $mensajeOperacion;
    }
    
    public function setear($datosUsuario){
        $this->setIdUsuario($datosUsuario['idusuario']);
        $this->setIdRol($datosUsuario['idrol']);
    }
    
    public function insertar(){
        $resp = false;
        $base = new BaseDatos();
        $sql = "INSERT INTO usuariorol (idusuario, idrol) VALUES (".$this->getIdUsuario().", ".$this->getIdRol().")";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
                $_SESSION['idusuario'] = $this->getIdUsuario();
            } else {
                $this->setMensajeOperacion("UsuarioRol->insertar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("UsuarioRol->insertar: " . $base->getError());
        }
        return $resp;
    }

    public function modificar(){
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE usuariorol SET idrol = ".$this->getIdRol()." WHERE idusuario = ".$this->getIdUsuario();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("UsuarioRol->modificar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("UsuarioRol->modificar: " . $base->getError());
        }
        return $resp;
    }

    public function eliminar(){
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM usuariorol WHERE idusuario = ".$this->getIdUsuario()." AND idrol = ".$this->getIdRol();


        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("UsuarioRol->eliminar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("UsuarioRol->eliminar: " . $base->getError());
        }
        return $resp;
    }

    public function listar($param=''){
        $arreglo = null;
        $base = new BaseDatos();
        $sql=" SELECT * FROM usuariorol ";

        if ($param != "") {
            $sql .= ' WHERE '.$param;
        }

        $res = $base->Ejecutar($sql);

        if($res>-1){
            if($res>0){
                $arreglo = array();
                while($row = $base->Registro()){
                    $obj = new UsuarioRol();
                    $obj->setear($row);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setUsDeshabilitado(1);
        }
        
        return $arreglo;
    }



    public function __toString(){
        return "idusuario: ".$this->getIdUsuario()."\idrol: ".$this->getIdRol();
    }
}