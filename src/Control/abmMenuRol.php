<?php
class abmmenurol
{

    public function buscar($param)
    {
        $where = " true ";

        if ($param != null) {
            if (isset($param['idmenu'])) {
                $where .= " and idmenu ='" . $param['idmenu'] . "'";
            }

            if (isset($param['idrol'])) {
                $where .= " and idrol ='" . $param['idrol'] . "'";
            }
        }

        $arreglo = menurol::listar($where);

        return $arreglo;
    }

    public function modificacion($param)
    {
        $resp = false;
        $objMenuRol = new menurol();
        $abmRol = new abmrol();
        $listaRol = $abmRol->buscar(['idrol' => $param['idrol']]);
        $abmMenu = new abmmenu();
        $listaMenu = $abmMenu->buscar(['idmenu' => $param['idmenu']]);
        $objMenuRol->setear($listaMenu[0], $listaRol[0]);
        if ($objMenuRol->modificar()) {
            $resp = true;
        }
        return $resp;
    }

    public function baja($param)
    {
        $resp = false;
        $objMenuRol = new menurol();
        $abmMenu = new abmmenu();
        $listaMenu = $abmMenu->buscar(['idmenu' => $param['idmenu']]);
        $abmRol = new abmrol();
        $objRol = $abmRol->buscar(['idrol' => $param['idrol']]);
        $objMenuRol->setear($listaMenu[0], $objRol[0]);

        if ($objMenuRol->eliminar()) {
            $resp = true;
        }

        return $resp;
    }

    public function alta($param)
    {
        $resp = false;
        $objMenuRol = new menurol();
        $abmMenu = new abmmenu();
        $listaMenu = $abmMenu->buscar(['idmenu' => $param['idmenu']]);
        $abmRol = new abmrol();
        $objRol = $abmRol->buscar(['idrol' => $param['idrol']]);
        $objMenuRol->setear($listaMenu[0], $objRol[0]);

        if ($objMenuRol->insertar()) {
            $resp = true;
        }
        return $resp;
    }
}