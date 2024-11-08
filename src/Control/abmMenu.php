<?php
class abmMenu
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
    /**
     * permite buscar un objeto
     * @param array $param
     * @return boolean
     */
    public function buscar($param)
    {
        $where = " true ";
        if ($param != null) {
            if (isset($param['idmenu'])) {
                $where .= " and idmenu =" . $param['idmenu'];
            }
            if (isset($param['menombre'])) {
                $where .= " and menombre ='" . $param['menombre'] . "'";
            }
            if (isset($param['medescripcion'])) {
                $where .= " and medescripcion ='" . $param['medescripcion'] . "'";
            }
            if (isset($param['idpadre'])) {
                $where .= " and idpadre =" . $param['idpadre'];
            }
            if (isset($param['medeshabilitado'])) {
                $where .= " and medeshabilitado ='" . $param['medeshabilitado'] . "'";
            }
        }
        $arreglo = menu::listar($where);
        return $arreglo;
    }

    private function cargarObjeto($param)
    {
        $objMenu = null;
        if (array_key_exists('menombre', $param) 
            && array_key_exists('medescripcion', $param) 
            && array_key_exists('idpadre', $param)
            && array_key_exists('idmenu', $param)){

            $objMenu = new menu();
            $objMenu->setear(
                $param['idmenu'],
                $param['menombre'],
                $param['medescripcion'],
                $param['idpadre'],
                $param['medeshabilitado']
            );
        }
        return $objMenu;
    }

    private function seteadosCamposClaves($param)
    {
        $resp = false;
        if (isset($param['idmenu'])) {
            $resp = true;
        }
        return $resp;
    }

    private function cargarObjetoConClave($param)
    {
        $objMenu = null;

        if (isset($param['idmenu'])) {
            $objMenu = new Menu();
            $objMenu->setear($param['idmenu'], null, null, null, null);
        }
        return $objMenu;
    }

    public function modificacion($param)
    {
        $resp = false;
        $objMenu = new Menu();
        $objMenu->setear(
        $param['idmenu'],
        $param['menombre'],
        $param['medescripcion'],
        $param['idpadre'],
        $param['medeshabilitado']);

        if ($objMenu->modificar()) {
            $resp = true;
        }
        return $resp;
    }


    public function baja($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $objMenu = $this->cargarObjetoConClave($param);
            if ($objMenu != null and $objMenu->eliminar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    public function alta($param)
    {
        $resp = false;
        $objMenu = $this->cargarObjeto($param);

        if ($objMenu->insertar()) {
            $resp = true;
        }
        return $resp;
    }


    //Hace un borrado logico del menu. 
    //En caso de que ya estuviese deshabilitado, lo vuelve a habilitar.
    public function deshabilitarMenu($param)
    {
        $resp = false;
        $objMenu = $this->cargarObjetoConClave($param);
        $listadoMenus = $objMenu->listar("idmenu=" . $param['idmenu']);

        if (count($listadoMenus) > 0) {
            $estadoMenu = $listadoMenus[0]->getMedeshabilitado();
            if ($estadoMenu == '0000-00-00 00:00:00') {
                if ($objMenu->estado(date("Y-m-d H:i:s"))) {
                    $resp = true;
                }
            } else {
                if ($objMenu->estado()) {
                    $resp = true;
                }
            }
        }
        return $resp;
    }

    public function obtenerDatos($param){
        $where = 'true';
        if ($param <> NULL) {
            if (isset($param['idmenu']))
                $where .= " and idmenu = " . $param['idmenu'];
            if (isset($param['menombre']))
                $where .= " and menombre = '" . $param['menombre'] . "'";
            if(isset($param['medescripcion']))
                $where .= " and medescripcion = '" . $param['medescripcion'] . "'";
            if(isset($param['idpadre']))
                $where .= " and idpadre = " . $param['idpadre'];
            if(isset($param['medeshabilitado']))
                $where .= " and medeshabilitado = '" . $param['medeshabilitado'] . "'";
        }
        $obj = new menu();
        $arreglo = $obj->listar($where);
        $result = [];

        if (!empty($arreglo)) {
            foreach ($arreglo as $menu) {
                $result[] = ["idmenu" => $menu->getIdmenu(),
                                "menombre" => $menu->getMenombre(),
                                "medescripcion" => $menu->getMedescripcion(),
                                "idpadre" => $menu->getIdpadre(),
                                "medeshabilitado" => $menu->getMedeshabilitado()];
            }
        }
        return $result;
    
    }
}
