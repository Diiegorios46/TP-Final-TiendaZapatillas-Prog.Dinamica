<?php
class abmProducto
{
    public function abm($datos) {
        $resp = false;

        if ($datos['accion'] == 'editar') {
            if ($this->modificacion($datos)) {
                $resp = true;
            }
        }

        if ($datos['accion'] == 'borrar') {
            if ($this->baja($datos)) {
                $resp = true;
            }           
        }

        if ($datos['accion'] == 'nuevo') {
            if ($this->alta($datos)) {
                $resp = true;
            }
        }

        return $resp;
    }

    private function cargarObjeto($param)
    {
        $obj = null;
        if (array_key_exists('idproducto', $param) and array_key_exists('pronombre', $param) and array_key_exists('proprecio', $param)) {
            $obj = new Producto();
            $obj->setear($param);
            return $obj;
        }
    }

    private function cargarObjetoConClave($param)
    {
        $obj = null;

        if (isset($param['idproducto'])) {
            $obj = new Producto();
            $obj->setear($param);
        }
        return $obj;
    }

    private function seteadosCamposClaves($param)
    {
        $resp = false;
        if (isset($param['idproducto']))
            $resp = true;
        return $resp;
    }

    public function alta($param)
    {
        $resp = false;
        $elObjtProducto = $this->cargarObjeto($param);
        if ($elObjtProducto != null and $elObjtProducto->insertar()) {
            $resp = true;
        }
        return $resp;
    }

    public function baja($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $elObjtProducto = $this->cargarObjetoConClave($param);
            if ($elObjtProducto != null and $elObjtProducto->eliminar()) {
                $resp = true;
            }
        }

        return $resp;
    }

    public function modificacion($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $elObjtProducto = $this->cargarObjeto($param);
            if ($elObjtProducto != null and $elObjtProducto->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    public function buscar($param)
    {
        $where = " true ";
        if ($param != null) {
            if (isset($param['idproducto']))
                $where .= " and idproducto = " . $param['idproducto'];
            if (isset($param['prodetalle']))
                $where .= " and prodetalle = '" . $param['prodetalle'] . "'";
            if (isset($param['proprecio']))
                $where .= " and proprecio = " . $param['proprecio'];
            if (isset($param['promarca']))
                $where .= " and promarca = '" . $param['promarca'] . "'";

        }
        $obj = new Producto();
        $arreglo = $obj->listar($where);
        return $arreglo;
    }

    public function listar($param = "")
    {
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM producto";

        if ($param != "") {
            $sql .= ' WHERE ' . $param;
        }

        $res = $base->Ejecutar($sql);
        if ($res > -1) {
            if ($res > 0) {

                while ($row = $base->Registro()) {
                    $obj = new Producto();
                    $obj->setear($row);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setMensajeOperacion("producto->listar: " . $base->getError());
        }

        return $arreglo;
    }

    public function cargarDatos($param)
    {
        $resp = false;
        if (isset($param['idproducto'])) {
            $this->setidproducto($param['idproducto']);
            $this->cargar();
            $resp = true;
        }
        return $resp;
    }

    public function cargar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM producto WHERE idproducto = " . $this->getidproducto();

        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                if ($row2 = $base->Registro()) {
                    $this->setear($row2);
                    $resp = true;
                }
            } else {
                $this->setMensajeOperacion("producto->cargar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("producto->cargar: " . $base->getError());
        }
        return $resp;
    }

     public function obtenerDatos($param){
        $where = " true ";
        if ($param <> NULL) {
            if (isset($param['idproducto']))
                $where .= " and idproducto = " . $param['idproducto'];
            if (isset($param['prodetalle']))
                $where .= " and prodetalle = '" . $param['prodetalle'] . "'";
            if (isset($param['proprecio']))
                $where .= " and proprecio = " . $param['proprecio'];
        } 
        $obj = new Producto();
        
        $arreglo = $obj->listar($where);
        $result = [];
        
        if (!empty($arreglo)) {
            foreach ($arreglo as $producto) {
                $result[] = [
                    'idproducto' => $producto->getIdproducto(),
                    'pronombre' => $producto->getPronombre(),
                    'prodetalle' => $producto->getProdetalle(),
                    'procantstock' => $producto->getProcantstock(),
                    'promarca' => $producto->getPromarca(),
                    'proprecio' => $producto->getProprecio(),
                    'proimagen1' =>  $producto->getProimagen1()
                ];
            }
        }
        return $result;
    }

    public function obtenerDatosSeguros($param){
        $where = " true ";
        if ($param <> NULL) {
            if (isset($param['prodetalle']))
                $where .= " and prodetalle = '" . $param['prodetalle'] . "'";
            if (isset($param['proprecio']))
                $where .= " and proprecio = " . $param['proprecio'];
        }

        $obj = new Producto();

        $arreglo = $obj->listar($where);
        $result = [];

        if (!empty($arreglo)) {
            foreach ($arreglo as $producto) {
                $result[] = [
                    'pronombre' => $producto->getPronombre(),
                    'prodetalle' => $producto->getProdetalle(),
                    'procantstock' => $producto->getProcantstock(),
                    'promarca' => $producto->getPromarca(),
                    'proprecio' => $producto->getProprecio(),
                    'proimagen1' =>  $producto->getProimagen1(),
                    'idproducto' => ''
                ];
            }
        }
        return $result;
    }

    
}