<?php

class abmCompra
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
        if (array_key_exists('idusuario', $param) && array_key_exists('idcompra', $param)) {
            $obj = new Compra();
            $obj->setear($param);
        }
        return $obj;
    }

    private function cargarObjetoConClave($param)
    {
        $obj = null;
        if (isset($param['idcompra'])) {
            $obj = new Compra();
            $obj->setear($param);
        }
        return $obj;
    }

    private function seteadosCamposClaves($param)
    {
        $resp = false;
        if (isset($param['idcompra']))
            $resp = true;
        return $resp;
    }

    public function alta($param)
    {
        $resp = false;
        $param['idcompra'] = null;
        $param['cefechaini'] = null;
        $param['idcompraestadotipo'] = 1;
        $param['cefechafin'] = null;
        
        $elObjtArchivoE = $this->cargarObjeto($param);
        if ($elObjtArchivoE != null and $elObjtArchivoE->insertar()) {
            $param['idcompra'] = $elObjtArchivoE->getIdcompra();
            $param['accion'] = 'nuevo';
            $objCompraEstado = new abmCompraEstado();
            $objCompraEstado->abm($param);
            $objCompraItem = new abmCompraItem();
            $objCompraItem->abm($param);
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
        if ($param <> NULL) {
            if (isset($param['idcompra']))
                $where .= " and idcompra =" . $param['idcompra'];
            if (isset($param['cofecha']))
                $where .= " and cofecha =" . $param['cofecha'];
            if (isset($param['idusuario']))
                $where .= " and idusuario ='" . $param['idusuario'] . "'";
        }
        $obj = new Compra();
        $arreglo = $obj->listar($where);

        return $arreglo;
    }

    public function obtenerDatos($param) {
        $where = " true ";
        if ($param <> NULL) {
            if (isset($param['idcompra']))
                $where .= " and idcompra =" . $param['idcompra'];
            if (isset($param['idusuario']))
                $where .= " and idusuario ='" . $param['idusuario'] . "'";
            if (isset($param['cofecha']))
                $where .= " and cofecha ='" . $param['cofecha'] . "'";
        }

        $obj = new Compra();
        $arreglo = $obj->listar($where);
        $result = [];

        if (!empty($arreglo)) {
            foreach ($arreglo as $compra) {
                $result[] = [
                    "idcompra" => $compra->getIdcompra(),
                    "idusuario" => $compra->getIdusuario(),
                    "cofecha" => $compra->getCofecha()
                ];
            }
        }
        return $result;
    }

    public function iniciarCompra($datos){
        $abmCompraEstado = new abmCompraEstado();
        $abmCompraItem = new abmCompraItem();
        $abmCompra = new abmCompra();
        $session = new Session();
        $result = false;

        $productos = $datos['productos'];   

        foreach($productos as $producto){
            $datos['accion'] = 'nuevo';
            $datos['idusuario'] = $session->getUsuario()['idusuario'];
            $datos['cofecha'] = date('Y-m-d H:i:s');
            $datos['idproducto'] = $producto['idproducto'];
            $datos['cicantidad'] = $producto['cantidad'];
            if($abmCompra->abm($datos)){
                $result = true;
            }
        }
    }


    public function enviarCorreo($datos){
        
        
    }
}