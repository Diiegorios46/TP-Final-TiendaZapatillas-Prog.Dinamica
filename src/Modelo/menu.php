<?php

class Menu extends BaseDatos
{
    private $idmenu;
    private $menombre;
    private $medescripcion;
    private $idpadre;
    private $medeshabilitado;
    private $mensajeOperacion;
    
    public function getIdmenu()
    {
        return $this->idmenu;
    }

    public function getMenombre()
    {
        return $this->menombre;
    }

    public function getMedescripcion()
    {
        return $this->medescripcion;
    }

    public function getIdpadre()
    {
        return $this->idpadre;
    }

    public function getMedeshabilitado()
    {
        return $this->medeshabilitado;
    }

    public function setIdmenu($idmenu)
    {
        $this->idmenu = $idmenu;
    }

    public function setMenombre($menombre)
    {
        $this->menombre = $menombre;
    }

    public function setMedescripcion($medescripcion)
    {
        $this->medescripcion = $medescripcion;
    }

    public function setIdpadre($idpadre)
    {
        $this->idpadre = $idpadre;
    }

    public function setMedeshabilitado($medeshabilitado)
    {
        $this->medeshabilitado = $medeshabilitado;
    }
    public function setMensajeOperacion($mensajeoperacion)
    {
        $this->mensajeoperacion = $mensajeoperacion;
    }


    public function setear($idmenu, $menombre, $medescripcion, $idpadre, $medeshabilitado)
    {
        $this->setIdmenu($idmenu);
        $this->setMenombre($menombre);
        $this->setMedescripcion($medescripcion);
        $this->setIdpadre($idpadre);
        $this->setMedeshabilitado($medeshabilitado);
    }

    public function cargar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM menu WHERE idmenu=" . $this->getIdmenu();

        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro();
                    $this->setear(
                        $row['idmenu'],
                        $row['menombre'],
                        $row['medescripcion'],
                        $row['idpadre'],
                        $row['medeshabilitado']);

                    $resp = true;
                }
            }

        } else {
            $this->setMensajeOperacion("Menu->cargar: " . $base->getError());
        }

        return $resp;
    }

    public function insertar()
{
    $resp = false;
    $base = new BaseDatos();
    
    $idpadre = $this->getIdpadre() ? "'" . $this->getIdpadre() . "'" : "NULL";
    
    $sql = "INSERT INTO menu (idmenu, menombre, medescripcion, idpadre, medeshabilitado) VALUES  (" . $this->getIdmenu() . ", '" . $this->getMenombre() . "', '" . $this->getMedescripcion() . "', " . $idpadre . ", '0000-00-00 00:00:00')";

    verEstructura($sql);
    
    if ($base->Iniciar()) {
        if ($elid = $base->Ejecutar($sql)) {
            $this->setIdmenu($elid);
            $resp = true;
        } else {
            $this->setMensajeOperacion("Menu->insertar: " . $base->getError());
        }
    } else {
        $this->setMensajeOperacion("Menu->insertar: " . $base->getError());
    }

    return $resp;
}


public function obtenerMenu($rol){
    if ($rol == 1){
        $menu = 1;
    }  
    else if($rol == 2){
        
    }
    else if($rol == 3){
        $menu = 3;
    }
    
    return $menu;
}

    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        $idpadre = $this->getIdpadre() ? "'" . $this->getIdpadre() . "'" : "NULL";
        
        $sql = "UPDATE menu SET menombre= '" . $this->getMenombre() . "', medescripcion= '" . $this->getMedescripcion() . "', idpadre= " . $idpadre . ", medeshabilitado= '" . $this->getMedeshabilitado() . "' WHERE idmenu=" . $this->getIdmenu();
        
                verEstructura($sql);
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("Menu->modificar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("Menu->modificar: " . $base->getError());
        }
        return $resp;
    }

  
     /* public function estado($param = "")
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE menu SET medeshabilitado='" . $param . "' WHERE idmenu=" . $this->getIdmenu();
        
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("Menu->estado: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Menu->estado: " . $base->getError());
        }
        return $resp;
    } */
  

    public function eliminar()
    {
        $resp = false;
        $base = new BaseDatos();
        $idpadre = $this->getIdpadre() ? "'" . $this->getIdpadre() . "'" : "NULL";

        $sql = "DELETE FROM menu WHERE idmenu=" . $this->getIdmenu();
        verEstructura($sql);
        
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("Menu->eliminar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("Menu->eliminar: " . $base->getError());
        }
        return $resp;
    }

    public function listar($parametro = "")
    {
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM menu ";

        if ($parametro != "") {
            $sql .= 'WHERE ' . $parametro;
        }

        $res = $base->Ejecutar($sql);

        if ($res > -1) {
            if ($res > 0) {
                while ($row = $base->Registro()) {
                    $obj = new menu();
                    
                    $obj->setear($row['idmenu'],
                                $row['menombre'],
                                $row['medescripcion'],
                                $row['idpadre'],
                                $row['medeshabilitado']);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setMensajeOperacion("Menu->listar: " . $base->getError());
        }
        return $arreglo;
    }


}