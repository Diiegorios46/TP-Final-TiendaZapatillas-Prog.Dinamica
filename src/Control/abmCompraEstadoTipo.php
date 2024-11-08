<?php
class abmcompraestadotipo
{
    private function cargarObjeto($param)
    {
        $obj = null;
        if (
            array_key_exists('idcompraestadotipo', $param) and array_key_exists('cetdescripcion', $param)
            and array_key_exists('cetdetalle', $param)
        ) {
            $obj = new compraestadotipo();
            $obj->setear($param['idcompraestadotipo'], $param['cetdescripcion'], $param['cetdetalle']);
        }
        return $obj;
    }

    private function cargarObjetoConClave($param)
    {
        $obj = null;

        if (isset($param['idcompraestadotipo'])) {
            $obj = new compraestadotipo();
            $obj->setear($param['idcompraestadotipo'], null, null);
        }
        return $obj;
    }

    private function seteadosCamposClaves($param)
    {
        $resp = false;
        if (isset($param['idcompraestadotipo']))
            $resp = true;
        return $resp;
    }

    public function alta($param)
    {
        $resp = false;

        $elObjtCompraEstadoTipo = $this->cargarObjeto($param);

        if ($elObjtCompraEstadoTipo != null and $elObjtCompraEstadoTipo->insertar()) {
            $resp = true;
        }
        return $resp;
    }

    public function baja($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $elObjtCompraEstadoTipo = $this->cargarObjetoConClave($param);
            if ($elObjtCompraEstadoTipo != null and $elObjtCompraEstadoTipo->eliminar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    public function modificacion($param)
    {
        //echo "Estoy en modificacion";
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $elObjtCompraEstadoTipo = $this->cargarObjeto($param);
            if ($elObjtCompraEstadoTipo != null and $elObjtCompraEstadoTipo->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    public function buscar($param)
    {
        $where = " true ";
        if ($param <> NULL) {
            if (isset($param['idcompraestadotipo']))
                $where .= " and idcompraestadotipo =" . $param['idcompraestadotipo'];
            if (isset($param['cetdescripcion']))
                $where .= " and cetdescripcion =" . $param['cetdescripcion'];
            if (isset($param['cetdetalle']))
                $where .= " and cetdetalle ='" . $param['cetdetalle'] . "'";
        }
        $arreglo = compraestadotipo::listar($where);
        return $arreglo;
    }
}