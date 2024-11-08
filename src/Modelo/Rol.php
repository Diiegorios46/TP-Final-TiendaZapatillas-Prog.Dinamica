<?php

class Rol extends BaseDatos{
    private $idRol;
    private $rolDescripcion;

    public function getIdRol(){
        return $this->idRol;
    }
    public function setIdRol($idRol){
        $this->idRol = $idRol;
    }
    public function getRolDescripcion(){
        return $this->idRol;
    }
    public function setRolDescripcion($rolDescripcion){
        $this->rolDescripcion = $rolDescripcion;
    }

    public function setear($datosUsuario){
        $this->setIdUsuario($datosUsuario['idRol']);
        $this->setUsNombre($datosUsuario['rolDescripcion']);
    }

    public function cargar()
    {
        $resp = false;
        $base = new BaseDatos();

        $sql = "SELECT * FROM rol WHERE idRol = '" . $this->getIdRol() . "'";

        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro();
                    $this->setear($row['idRol'], $row['rolDescripcion']);
                    $resp = true;
                }
            }
        } else {
            $this->setMensajeOperacion("Producto->listar: " . $base->getError());
        }

        return $resp;
    }

    public function alta(){
        $base=new BaseDatos();
        $consultaInsertar = "INSERT INTO Rol(idRol, rolDescripcion) VALUES ('".$this->getIdRol()."','".$this->getRolDescripcion()."')";
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
            $consultaModifica="UPDATE Rol SET idRol='".$this->getIdRol()."',rolDescripcion='".$this->setRolDescripcion()."' WHERE idRol=".$this->getIdRol();
            if($base->Ejecutar($consultaModifica)){
                $resp=true;
            } else {
                $this->setUsDeshabilitado(1);
            }
        } else {
            $this->setUsDeshabilitado(1);
        }
        return $resp;
    }

    public function __toString(){
        return "IdRol: ".$this->getIdRol()."\nRolDescripcion: ".$this->getRolDescripcion();
    }

}