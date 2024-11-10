<?php 

class Usuario extends BaseDatos {
    private $idusuario;
    private $usnombre;
    private $uspass;
    private $usmail;
    private $usdeshabilitado;

    public function getIdusuario() {
        return $this->idusuario;
    }

    public function setIdusuario($idusuario) {
        $this->idusuario = $idusuario;
    }

    public function getUsnombre() {
        return $this->usnombre;
    }

    public function setUsnombre($usnombre) {
        $this->usnombre = $usnombre;
    }
    public function getUspass() {
        return $this->uspass;
    }

    public function setUspass($uspass) {
        $this->uspass = $uspass;
    }
    public function getUsmail() {
        return $this->usmail;
    }

    public function setUsmail($usmail) {
        $this->usmail = $usmail;
    }
    public function getUsdeshabilitado() {
        return $this->usdeshabilitado;
    }

    public function setUsdeshabilitado($usdeshabilitado) {
        $this->usdeshabilitado = $usdeshabilitado;
    }

    public function setear($param) {
        $this->setIdusuario($param['idusuario']);
        $this->setUsnombre($param['usnombre']);
        $this->setUspass($param['uspass']);
        $this->setUsmail($param['usmail']);
        $this->setUsdeshabilitado($param['usdeshabilitado']);
    }

    public function insertar(){
        $base=new BaseDatos();
        $consultaInsertar="INSERT INTO usuario(usnombre, uspass, usmail, usdeshabilitado) VALUES 
        ('".$this->getUsNombre()."','".$this->getUsPass()."','".$this->getUsMail()."','".$this->getUsDeshabilitado()."')";
        
        $resp= false;
        if($base->Iniciar()){
            if($id = $base->Ejecutar($consultaInsertar)){
                $this->setIdUsuario($id);
                $resp=true;
            } else {
                $this->setUsdeshabilitado(1);
            }
        } else {
            $this->setUsdeshabilitado(1);
        }
        return $resp;
    }
    
    public function modificar(){
        $base=new BaseDatos();
        $resp = false;
        
        if($base->Iniciar()){
            $consultaModifica =
            "UPDATE usuario SET usNombre ='".$this->getUsNombre()."',
            usPass='".$this->getUsPass()."',
            usMail='".$this->getUsMail()."',
            usDeshabilitado='".$this->getUsDeshabilitado()."' WHERE idUsuario=".$this->getIdUsuario();
            
            if($base->Ejecutar($consultaModifica)){
                $resp=true;
            } else {
                $this->setUsdeshabilitado(1);
            }
        } else {
            $this->setUsdeshabilitado(1);
        }
        return $resp;
    }
    
    public function eliminar($param) {
        $resp = false;
        $base=new BaseDatos();
        $sql="UPDATE usuario SET usDeshabilitado = '".$this->getUsDeshabilitado()."' WHERE idUsuario=".$this->getIdUsuario();

        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("usuario->borrado logico: ".$base->getError());
            }
        } else {
            $this->setMensajeOperacion("usuario->borrado logico: ".$base->getError());
        }

        return $resp;
    }


    public function listar($param=''){
        $arreglo = null;
        $base = new BaseDatos();
        $sql=" SELECT * FROM usuario ";

        if ($param != "") {
            $sql .= ' WHERE '.$param;
        }

        $res = $base->Ejecutar($sql);
        verEstructura($sql);
        if($res>-1){
            if($res>0){
                $arreglo = array();
                while($row = $base->Registro()){
                    $obj = new Usuario();
                    $obj->setear($row);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setUsdeshabilitado(1);
        }
        
        return $arreglo;
    }

   

    public function __toString(){
        return "IdUsuario: ".$this->getIdUsuario()."\nUsNombre: ".$this->getUsNombre()."\nUsPass: ".$this->getUsPass()."\nUsMail: ".$this->getUsMail()."\nUsDeshabilitado: ".$this->setUsdeshabilitado();
    }
}