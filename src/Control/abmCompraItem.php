<?php 

class abmCompraItem{
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

    public function buscar($param){
        $where = " true ";
        if ($param != null) {
            if (isset($param['idcompraitem'])) {
                $where .= " and idcompraitem =" . $param['idcompraitem'];
            }
            if (isset($param['idcompra'])) {
                $where .= " and idcompra =" . $param['idcompra'];
            }
            if (isset($param['idproducto'])) {
                $where .= " and idproducto =" . $param['idproducto'];
            }
            if (isset($param['citcantidad'])) {
                $where .= " and citcantidad =" . $param['citcantidad'];
            }
            if (isset($param['citprecio'])) {
                $where .= " and citprecio =" . $param['citprecio'];
            }
        }
        $objCompraItem = new CompraItem();
        $arreglo = $objCompraItem->listar($where);
        return $arreglo;
    }

    private function cargarObjeto($param)
    {
        $objCompraItem = null;
        if (array_key_exists('idcompra', $param) && array_key_exists('idproducto', $param) && array_key_exists('idcompraitem', $param)) {

            $objCompraItem = new CompraItem();
            $objCompraItem->setear($param);
        }
        return $objCompraItem;
    }

    private function cargarObjetoConClave($param)
    {
        $objCompraItem = null;

        if (isset($param['idcompraitem'])) {
            $objCompraItem = new CompraItem();
            $objCompraItem->setear($param);
        }
        return $objCompraItem;
    }

    private function seteadosCamposClaves($param)
    {
        $resp = false;
        if (isset($param['idcompraitem'])) {
            $resp = true;
        }
        return $resp;
    }

    public function alta($param)
    {
        $resp = false;

        $elObjtCompraItem = $this->cargarObjeto($param);
        if ($elObjtCompraItem != null and $elObjtCompraItem->insertar()) {
            $resp = true;
        }
        return $resp;
    }

    public function baja($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $elObjtCompraItem = $this->cargarObjetoConClave($param);
            if ($elObjtCompraItem != null and $elObjtCompraItem->eliminar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    public function modificacion($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $elObjtCompraItem = $this->cargarObjeto($param);
            if ($elObjtCompraItem != null and $elObjtCompraItem->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    
}
?>