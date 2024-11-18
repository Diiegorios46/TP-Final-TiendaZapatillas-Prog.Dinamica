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
        $arreglo = Compra::listar($where);

        return $arreglo;
    }

    // public function obtenerDatos($param){
    //         $where = " true ";
    //         if ($param <> NULL) {
    //             if (isset($param['idrol']))
    //                 $where .= " and idrol ='" . $param['idrol'] . "'";
    //             if (isset($param['idusuario']))
    //                 $where .= " and idusuario =" . $param['idusuario'] . "";
    //         }

    //         $obj = new UsuarioRol();
    //         $arreglo = $obj->listar($where);
    //         $result = [];
            
    //         if (!empty($arreglo)) {
    //             foreach ($arreglo as $rol) {
    //                 $result[] = ["idrol" => $rol->getIdRol(),
    //                              "idusuario" => $rol->getIdUsuario()];
    //             }
    //         }
    //         return $result;
    //     }    


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
}