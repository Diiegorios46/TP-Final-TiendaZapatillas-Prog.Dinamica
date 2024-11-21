<?php

class abmUsuario{

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
      
    public function cargarObjeto($param){
        $obj = null;
        if(array_key_exists('idusuario',$param) 
           and array_key_exists('usnombre',$param) 
           and array_key_exists('uspass',$param)
           and array_key_exists('usmail',$param)){
            $obj = new Usuario();
            $obj->setear($param);
        }

        return $obj;
    }

    private function cargarObjetosConClave($param){
        $obj = null;
        if(isset($param['idusuario'])){
            $obj = new Usuario();
            $obj->setear($param);
        }
        return $obj;
    }

    private function seteadosCamposClaves($param){
        $resp = false;
        if(isset($param['idusuario'])){
            $resp = true;
        }
        return $resp;
    }

    public function alta($param) {
        $resp = false;
        $abmUsuario = new abmUsuario();
        $abmUsuarioRol = new abmUsuarioRol();
        
        $param['idusuario'] = null;
        $param['usdeshabilitado'] = null;
        $param['idrol'] = 3;
        
        $elObjtTabla = $this->cargarObjeto($param);
        if ($elObjtTabla != null && $elObjtTabla->insertar()) {
            $param['idusuario'] = $elObjtTabla->getIdusuario();
            if (!$abmUsuarioRol->alta($param)) {
                $this->abm($param);
                $param['accion'] = 'borrar';
            } else {
                $resp = true;
            }
            
        }
        
        return $resp;
    }

    public function baja($param) {
        $resp = false;
        $param['usdeshabilitado'] = date('Y-m-d') . " " . date('H:i:s');

        $elObjtTabla = $this->cargarObjetosConClave($param);
        if ($elObjtTabla != null && $elObjtTabla->eliminar($param)) {
            $resp = true;
        }
        
        return $resp;
    }

    /**
     * Permite modificar un objeto
     * @param array $param
     * @return boolean
     */
    public function modificacion($param) {
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $elObjtTabla = $this->cargarObjeto($param);
            if ($elObjtTabla != null && $elObjtTabla->modificar()){
                $resp = true;
            }
        }
        return $resp;
    }


    public function buscar($param) {
        $where = " true ";
        if ($param <> NULL) {
            if (isset($param['idusuario']))
                $where .= " and idusuario =" . $param['idusuario'];
            if (isset($param['usnombre']))
                $where .= " and usnombre ='" . $param['usnombre'] . "'";
            if (isset($param['uspass']))
                $where .= " and uspass ='" . $param['uspass'] . "'";
            if (isset($param['usmail']))
                $where .= " and usmail ='" . $param['usmail'] . "'";
            if (isset($param['usdeshabilitado']))
                $where .= " and usdeshabilitado ='" . $param['usdeshabilitado'] . "'";
        }
        $obj = new Usuario();
        $arreglo = $obj->listar($where);
        return $arreglo;
    }

    public function obtenerDatos($param){
        $where = " true ";
        if ($param <> NULL) {
            if (isset($param['idusuario']))
                $where .= " and idusuario = " . $param['idusuario'];
            if (isset($param['usnombre']))
                $where .= " and usnombre = '" . $param['usnombre'] . "'";
            if (isset($param['uspass']))
                $where .= " and uspass = '" . $param['uspass'] . "'";
            if (isset($param['usmail']))
                $where .= " and usmail = '" . $param['usmail'] . "'";
            if (isset($param['usdeshabilitado']))
                $where .= " and usdeshabilitado = '" . $param['usdeshabilitado'] . "'";
        }
        $obj = new Usuario();
        
        $arreglo = $obj->listar($where);
        $result = [];
        
        if (!empty($arreglo)) {
            foreach ($arreglo as $usuario) {
                $result[] = [
                'idusuario' => $usuario->getIdusuario(),
                'usnombre' => $usuario->getUsNombre(),
                'uspass' => $usuario->getUsPass(),
                'usmail' => $usuario->getUsMail(),
                'usdeshabilitado' => $usuario->getUsDeshabilitado()
                ];
            }
        }
        return $result;
    }

    
}