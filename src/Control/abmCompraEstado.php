<?php
class abmCompraEstado
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
    private function cargarObjeto($param){
        $obj = null;
        if (array_key_exists('idcompra', $param) and array_key_exists('idcompraestado', $param) and array_key_exists('idcompraestadotipo', $param)){
            $obj = new CompraEstado();
            $obj->setear($param);
        }
        return $obj;
    }

    private function cargarObjetoConClave($param)
    {
        $obj = null;
        if (isset($param['idcompraestado'])) {
            $obj = new CompraEstado();
            $obj->setear($param);
        }
        return $obj;
    }

    private function seteadosCamposClaves($param)
    {
        $resp = false;
        if (isset($param['idcompraestado'])) {
            $resp = true;
        }

        return $resp;
    }

    public function alta($param)
    {
        $resp = false;
        $param['idcompraestado'] = null;
        $param['cefechaini'] = date('Y-m-d H:i:s');
        $elObjtArchivoE = $this->cargarObjeto($param);
        if ($elObjtArchivoE != null && $elObjtArchivoE->insertar()) {
            $resp = true;
        }
        return $resp;
    }

    public function baja($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $elObjtArchivoE = $this->cargarObjetoConClave($param);
            if ($elObjtArchivoE != null and $elObjtArchivoE->eliminar()) {
                $resp = true;
            }
        }

        return $resp;
    }

    public function modificacion($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $elObjtArchivoE = $this->cargarObjeto($param);
            
            if ($elObjtArchivoE != null and $elObjtArchivoE->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    public function buscar($param)
    {
        $where = " true ";
        if ($param != null) {
            if (isset($param['idcompraestado'])) {
                $where .= " and idcompraestado =" . $param['idcompraestado'];
            }
            if (isset($param['idcompra'])) {
                $where .= " and idcompra =" . $param['idcompra'];
            }
            if (isset($param['idcompraestadotipo'])) {
                $where .= " and idcompraestadotipo ='" . $param['idcompraestadotipo'] . "'";
            }
            if (isset($param['cefechaini'])) {
                $where .= " and cefechaini ='" . $param['cefechaini'] . "'";
            }
            if (isset($param['cefechafin'])) {
                $where .= " and cefechafin ='" . $param['cefechafin'] . "'";
            }
        }
        /// 
        $obj = new CompraEstado();
        $arreglo = $obj->listar($where);
        return $arreglo;
    }

    public function obtenerDatos($param){
        $where = 'true';
        if ($param <> NULL) {
            if (isset($param['idcompraestado']))
                $where .= " and idcompraestado = " . $param['idcompraestado'];
            if (isset($param['idcompra']))
                $where .= " and idcompra = '" . $param['idcompra'] . "'";
            if(isset($param['idcompraestadotipo']))
                $where .= " and idcompraestadotipo = '" . $param['idcompraestadotipo'] . "'";
            if(isset($param['cefechaini']))
                $where .= " and cefechaini = '" . $param['cefechaini'] . "'";
            if(isset($param['cefechafin']))
                $where .= " and cefechafin = '" . $param['cefechafin'] . "'";
        }
        $obj = new CompraEstado();
        $arreglo = $obj->listar($where);
        $result = [];
        if (!empty($arreglo)) {
            foreach ($arreglo as $compraEstado) {
                $result[] = [
                    "idcompraestado" => $compraEstado->getIdcompraestado(),
                    "idcompra" => $compraEstado->getIdcompra(),
                    "idcompraestadotipo" => $compraEstado->getIdcompraEstadoTipo(),
                    "cefechaini" => $compraEstado->getCefechaini(),
                    "cefechafin" => $compraEstado->getCefechafin(),
            ];
            }
        }
        return $result;
    
    }
}