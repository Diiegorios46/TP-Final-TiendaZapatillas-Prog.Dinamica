<?php

class Producto extends BaseDatos
{
    private $idproducto;
    private $pronombre;
    private $procantstock;
    private $prodetalle;
    private $proprecio;
    private $mensajeOperacion;

    // Getters
    public function getIdproducto()
    {
        return $this->idproducto;
    }
    public function getPronombre()
    {
        return $this->pronombre;
    }

    public function getProdetalle()
    {
        return $this->prodetalle;
    }
    public function getProcantstock()
    {
        return $this->procantstock;
    }
    //SETTERS
    public function setIdproducto($idproducto)
    {
        $this->idproducto = $idproducto;
    }
    public function setPronombre($pronombre)
    {
        $this->pronombre = $pronombre;
    }
    public function setProdetalle($prodetalle)
    {
        $this->prodetalle = $prodetalle;
    }
    public function setProcantstock($procantstock)
    {
        $this->procantstock = $procantstock;
    }

    public function getProPrecio()
    {
        return $this->proprecio;
    }

    public function setProPrecio($proprecio)
    {
        $this->proprecio = $proprecio;
    }

    public function setMensajeOperacion($mensajeOperacion)
    {
        $this->mensajeOperacion = $mensajeOperacion;
    }


    // Metodos
    public function setear($idproducto, $proprecio , $pronombre, $prodetalle,  $procantstock)
    {
        $this->setIdproducto($idproducto);
        $this->setProPrecio($proprecio);
        $this->setPronombre($pronombre);
        $this->setProdetalle($prodetalle);
        $this->setProcantstock($procantstock);
    }

    public function cargar()
    {
        $resp = false;
        $base = new BaseDatos();

        $sql = "SELECT * FROM producto WHERE idproducto = '" . $this->getIdproducto() . "'";

        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro();
                    $this->setear(
                        $row['idproducto'],
                        $row['proprecio'], 
                        $row['pronombre'], 
                        $row['prodetalle'],  
                        $row['procantstock']);
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

        $sql = "INSERT INTO producto (pronombre, prodetalle , procantstock, proprecio) VALUES ('".$this->getPronombre()."','".$this->getProdetalle()."',".$this->getProcantstock() . ",".$this->getProPrecio().")";

        if ($base->Iniciar()) {
            if ($base = $base->Ejecutar($sql)) {
                $this->setIdproducto($base);
                $resp = true;
            } else {
                $this->setMensajeOperacion("Producto->insertar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("Producto->insertar: " . $base->getError());
        }
        return $resp;
    }

    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE producto SET 
        idproducto = " . $this->getIdproducto() . ", pronombre = '" . $this->getPronombre() . "', prodetalle = '" . $this->getProdetalle() . "', proprecio = " . $this->getProPrecio() . ", procantstock = " . $this->getProcantstock() . " WHERE idproducto = " . $this->getIdproducto() . ";";
        
        verEstructura($sql);
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("Producto->modificar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("Producto->modificar: " . $base->getError());
        }
        return $resp;
    }

    public function eliminar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM producto WHERE idproducto='" . $this->getIdproducto() . "'";
        
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setMensajeOperacion("Producto->eliminar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("Producto->eliminar: " . $base->getError());
        }
        return $resp;
    }

    //ESTA RARO ESTO
    public function listar($parametro = "")
    {
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM producto ";
        
        if ($parametro != "") {
            $sql .= 'WHERE ' . $parametro;
        }
        
        $res = $base->Ejecutar($sql);
        if ($res > -1) {
            if ($res > 0) {
                while ($row = $base->Registro()) {
                    $obj = new Producto();
                    $obj->setear(
                        $row['idproducto'], 
                        $row['proprecio'], 
                        $row['prodescuento'], 
                        $row['pronombre'], 
                        $row['prodetalle'], 
                        $row['procantventas'], 
                        $row['procantstock'], 
                        $row['prodeshabilitado']
                    );
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setMensajeOperacion("Producto->listar: " . $base->getError());
        }

        return $arreglo;
    }

    /*
    public function estado($param = "")
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE producto SET prodeshabilitado= '" . $param . "' WHERE idproducto='" . $this->getIdproducto() . "'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("Producto->estado: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("Producto->estado: " . $base->getError());
        }
        return $resp;
    }
    */

}