<?php

class abmcompra
{
    private function cargarObjeto($param)
    {
        $obj = null;
        if (array_key_exists('idusuario', $param) && array_key_exists('idcompra', $param)) {

            //creo objeto estadotipos
            $objUsuario = new usuario();
            $objUsuario->setIdUsuario($param['idusuario']);
            $objUsuario->cargar();

            //agregarle los otros objetos
            $obj = new compra();
            $obj->setear($param['idcompra'], NULL, $objUsuario);
        }
        return $obj;
    }

    private function cargarObjetoConClave($param)
    {
        $obj = null;
        if (isset($param['idcompra'])) {
            $obj = new compra();
            $obj->setear($param['idcompra'], null, null);
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
        $elObjtArchivoE = $this->cargarObjeto($param);
        if ($elObjtArchivoE != null and $elObjtArchivoE->insertar()) {
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
        $arreglo = compra::listar($where);
        return $arreglo;
    }
}