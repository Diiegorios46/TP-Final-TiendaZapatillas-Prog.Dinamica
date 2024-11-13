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
        // verEstructura($param);
        if (
            array_key_exists('idproducto', $param) and array_key_exists('pronombre', $param) and array_key_exists('proprecio', $param)
        ) {
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
            if (isset($param['prodescripcion']))
                $where .= " and prodescripcion = '" . $param['prodescripcion'] . "'";
            if (isset($param['prodetalle']))
                $where .= " and prodetalle = '" . $param['prodetalle'] . "'";
            if (isset($param['proprecio']))
                $where .= " and proprecio = " . $param['proprecio'];
        }
        $arreglo = producto::listar($where);
        return $arreglo;
    }

    //REVISAR ESTA ATROCIDAD
    public function listar($param = "")
    {
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM producto";

        if ($param != "") {
            $sql .= 'WHERE ' . $param;
        }

        $res = $base->Ejecutar($sql);
        if ($res > -1) {
            if ($res > 0) {

                while ($row = $base->Registro()) {
                    $obj = new producto();

                    $objProducto = NULL;
                    if ($row['idproducto'] != null) {
                        $objProducto = new producto();
                        $objProducto->setear($row['idproducto'], $row['prodescripcion'], $row['prodetalle'], $row['proprecio']);
                    }
                    $obj->setear($row['idproducto'], $row['prodescripcion'], $row['prodetalle'], $row['proprecio']);
                    
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

    public function cargar($idproducto)
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM producto WHERE idproducto = " . $idproducto;

        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                if ($row2 = $base->Registro()) {
                    $this->setear($row2['idproducto'],
                                  $row2['prodescripcion'],
                                  $row2['prodetalle'],
                                  $row2['proprecio'],
                                  $row2['prostock'],
                                  $row2['proimagen']);
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



    
}