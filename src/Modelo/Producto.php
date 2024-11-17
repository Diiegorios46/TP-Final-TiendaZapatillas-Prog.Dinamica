<?php

class Producto extends BaseDatos
{
    private $idproducto;
    private $pronombre;
    private $prodetalle;
    private $procantstock;
    private $proprecio;
    private $promarca;
    private $proimagen1;
    private $proimagen2;
    private $proimagen3;
    private $proimagen4;
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
    
    public function getProPrecio()
    {
        return $this->proprecio;
    }
    public function getPromarca() {
        return $this->promarca;
    }

    public function getProimagen1()
    {
        return $this->proimagen1;
    }

    public function getProimagen2()
    {
        return $this->proimagen2;
    }

    public function getProimagen3()
    {
        return $this->proimagen3;
    }

    public function getProimagen4()
    {
        return $this->proimagen4;
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

    public function setProPrecio($proprecio)
    {
        $this->proprecio = $proprecio;
    }

    public function setProimagen1($proimagen1)
    {
        $this->proimagen1 = $proimagen1;
    }

    public function setProimagen2($proimagen2)
    {
        $this->proimagen2 = $proimagen2;
    }

    public function setProimagen3($proimagen3)
    {
        $this->proimagen3 = $proimagen3;
    }

    public function setProimagen4($proimagen4)
    {
        $this->proimagen4 = $proimagen4;
    }

    public function setMensajeOperacion($mensajeOperacion)
    {
        $this->mensajeOperacion = $mensajeOperacion;
    }

    public function setPromarca($promarca){
        $this->promarca = $promarca;
    }


    // Metodos
    public function setear($param)
    {
        $this->setIdproducto($param['idproducto']);
        $this->setPronombre($param['pronombre']);
        $this->setProPrecio($param['proprecio']);
        $this->setpromarca($param['promarca']);
        $this->setProdetalle($param['prodetalle']);
        $this->setProcantstock($param['procantstock']);
        $this->setProimagen1($param['proimagen1']);
        $this->setProimagen2(isset($param['proimagen2']) ? $param['proimagen2'] : null);
        $this->setProimagen3(isset($param['proimagen3']) ? $param['proimagen3'] : null);
        $this->setProimagen4(isset($param['proimagen4']) ? $param['proimagen4'] : null);
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
        
        $proimagen1 = ($this->getProimagen1() !==  null)  ? $this->getProimagen1() : "NULL";
        $this->setProimagen1($proimagen1);
        $proimagen2 = ($this->getProimagen2() !==  null)  ? $this->getProimagen2() :  "NULL";
        $this->setProimagen2($proimagen2);
        $proimagen3 = ($this->getProimagen3() !==  null)  ? $this->getProimagen3() : "NULL";
        $this->setProimagen3($proimagen3);
        $proimagen4 = ($this->getProimagen4() !==  null)  ? $this->getProimagen4() :  "NULL";
        $this->setProimagen4($proimagen4);

        $sql = "INSERT INTO producto (pronombre, prodetalle, procantstock, proprecio, promarca, proimagen1, proimagen2, proimagen3, proimagen4) VALUES ('".$this->getPronombre()."', '".$this->getProdetalle()."',".$this->getProcantstock().",".$this->getProPrecio().",'".$this->getProMarca()."','".$this->getProimagen1()."','".$this->getProimagen2()."','".$this->getProimagen3()."','".$this->getProimagen4()."')";
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
        
        $proimagen2 = ($this->getProimagen2() !==  null)  ? $this->getProimagen2() : "NULL";
        $this->setProimagen2($proimagen2);
        $proimagen3 = ($this->getProimagen3() !==  null)  ? $this->getProimagen3() : "NULL";
        $this->setProimagen3($proimagen3);
        $proimagen4 = ($this->getProimagen4() !==  null)  ? $this->getProimagen4() : "NULL";
        $this->setProimagen4($proimagen4);

        $sql = "UPDATE producto SET pronombre = '" . $this->getPronombre() . "', prodetalle = '" . $this->getProdetalle() . "', proprecio = " . $this->getProPrecio() . ", procantstock = " . $this->getProcantstock() . ", promarca = '" . $this->getPromarca() . "', proimagen1 = '" . $this->getProimagen1() . "', proimagen2 = '" . $this->getProimagen2() . "', proimagen3 = '" . $this->getProimagen3() . "', proimagen4 = '" . $this->getProimagen4() . "' WHERE idproducto = " . $this->getIdproducto() . ";";
        // $sql = "UPDATE producto SET pronombre = '6', prodetalle = '6', proprecio = 6, procantstock = 6, promarca = 'nike', proimagen1 = 'UklGRvB4AABXRUJQVlA4IOR4AADQCQKdASogAyADPm02l0ikI' WHERE idproducto = 16;";
        
        if($base->Iniciar()) {
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

    public function listar($parametro = "")
    {
        $arreglo = [];
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
                    $obj->setear($row);
                    $arreglo[] = $obj;
                }
            }
        } else {
            $this->setMensajeOperacion("Producto->listar: " . $base->getError());
        }
        return $arreglo;
    }

}