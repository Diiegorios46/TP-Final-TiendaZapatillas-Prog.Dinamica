<?php

class UsuarioRol extends BaseDatos{
    private $idUsuario;
    private $idRol;
    private $mensajeOperacion;

    public function getIdUsuario(){
        return $this->getIdUsuario;
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

    public function cargar($datosUsuario){
        $this->setIdUsuario($datosUsuario['idUsuario']);
        $this->setIdRol($datosUsuario['idRol']);
    }

    public function setMensajeOperacion($mensajeOperacion)
    {
        $this->mensajeOperacion = $mensajeOperacion;
    }

    public function alta(){
        $base=new BaseDatos();
        $consultaInsertar="INSERT INTO rol(idUsuario, idRol) VALUES ('".$this->getIdUsuario()."','".$this->getIdRol()."')";
        $resp= false;
        if($base->Iniciar()){
            if($base->Ejecutar($consultaInsertar)){
                $this->setIdUsuario($base->devuelveIDInsercion());
                $resp=true;
            } else {
                $this->setUsDeshabilitado(1);
            }
        } else {
            $this->setUsDeshabilitado(1);
        }
        return $resp;
    }

    
    public function baja($param) {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $elObjtTabla = $this->cargarObjetoConClave($param);
            if ($elObjtTabla != null && $elObjtTabla->eliminar()) {
                $resp = true;
            }
        }

        return $resp;
    }

    public function modificacion(){
        $resp = false;
        $base=new BaseDatos();
        if($base->Iniciar()){
            $consultaInsertar="INSERT INTO usuariorol(idusuario, idrol) VALUES ('".$this->getIdUsuario()."','".$this->getIdRol()."')";
            
            if($base->Ejecutar($consultaInsertar)){
                $resp=true;
            } else {
                $this->setUsDeshabilitado(1);
            }
        } else {
            $this->setUsDeshabilitado(1);
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
                    $obj = new Usuario();
                    $obj->cargar($row);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setUsDeshabilitado(1);
        }
        
        return $arreglo;
    }



    public function __toString(){
        return "IdUsuario: ".$this->getIdUsuario()."\nidRol: ".$this->getIdRol();
    }
}