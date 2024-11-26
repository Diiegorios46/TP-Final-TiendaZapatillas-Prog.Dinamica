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
        $param['idcompraitem'] = null;
        if (array_key_exists('idcompra', $param) && array_key_exists('idproducto', $param) && array_key_exists('idcompraitem', $param) && array_key_exists('cicantidad', $param)) {
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
        $paramp['idcompraitem'] = null;
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

    public function obtenerDatos($param){
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
        }

        $objCompraItem = new CompraItem();
        $arreglo = $objCompraItem->listar($where);

        $result = [];
        
        foreach ($arreglo as $compraItem) {
            $result[] = [
            'idcompraitem' => $compraItem->getIdcompraitem(),
            'idcompra' => $compraItem->getIdcompra(),
            'idproducto' => $compraItem->getIdproducto(),
            'cicantidad' => $compraItem->getCicantidad(),
            ];
        }
        $arreglo = $result;

        return $arreglo;
    }


    public function generarHistorico($idCompra){
        $abmCompra = new abmCompra();
        $abmUsuario = new abmUsuario();
        $abmProducto = new abmProducto();
        $abmCompraItem = new abmCompraItem();
        $abmCompraEstado = new abmCompraEstado();
        $abmCompraEstadoTipo = new abmCompraEstadoTipo();

        $historico = [];

        $historico['idusuario'] = $abmCompra->obtenerDatos(['idcompra' => $idCompra])[0]['idusuario'];
        $historico['idcompra'] = $idCompra;
        

        return $historico;
    }
}
?>