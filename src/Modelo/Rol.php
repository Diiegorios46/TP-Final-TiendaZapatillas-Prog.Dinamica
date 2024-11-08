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
        return $this->rolDescripcion;
    }
    public function setRolDescripcion($rolDescripcion){
        $this->rolDescripcion = $rolDescripcion;
    }

    public function setear($datosUsuario){
        $this->setIdRol($datosUsuario['idRol']);
        $this->setRolDescripcion($datosUsuario['rolDescripcion']);
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
        $consultaInsertar = 
        "INSERT INTO Rol(idRol, rolDescripcion) 
        VALUES ('".$this->getIdRol()."','".$this->getRolDescripcion()."')";
        
        $resp= false;
        if($base->Iniciar()){
            if($base->Ejecutar($consultaInsertar)){
                $this->setIdRol($base->devuelveIDInsercion());
                $resp=true;
            } else {
            $this->setMensajeOperacion("Producto->listar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("Producto->listar: " . $base->getError());
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
            $consultaModifica =
            "UPDATE Rol SET idRol ='".$this->getIdRol()."',
            rolDescripcion ='".$this->getRolDescripcion()."' WHERE idRol =".$this->getIdRol();
            
            if($base->Ejecutar($consultaModifica)){
                $resp=true;
            } else {
            $this->setMensajeOperacion("Producto->listar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("Producto->listar: " . $base->getError());
        }
        return $resp;
    }

    public function __toString(){
        return "IdRol: ".$this->getIdRol()."\nRolDescripcion: ".$this->getRolDescripcion();
    }

}