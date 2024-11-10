<?php 
 class Session {
 
    public function __construct() {
        //se va a romper el root si pones eso 
        //session_start();
    }

    
    // ********* Usar en caso especifico ********* //
    //getUsuario().Devuelve el getUsuario logeado.
    public function getUsuario(){
        $usuario = null;
        if($this->validar()){
            $obj = new abmUsuario();
            $param['idUsuario'] = $_SESSION['idUsuario'];
            $resultado = $obj->buscar($param);

            if(count($resultado) > 0){
                $usuario = $resultado[0];
            }
        }
        return $usuario;
    }

    // getRol(). Devuelve el rol del rol  logeado.
    public function getRol(){
        $list_rol = null;
        if($this->validar()){
            $obj = new abmUsuario();
             $param['idUsuario'] = $_SESSION['idUsuario'];
             $resultado = $obj->darRoles($param);
             
            if(count($resultado) > 0){
                $list_rol = $resultado;
            }
        }
        return $list_rol;
    }
        
    // Actualiza las variables de sesion con los valores ingresados.
    public function iniciar($nombreidUsuario ,$psw){
        $boolean = false;
        $obj = new abmUsuario();
        $arrayDatos['usnombre'] = $nombreidUsuario;
        $arrayDatos['uspass'] = $psw;
        $arrayDatos['usdeshabilitado'] ='0000-00-00 00:00:00';

        $resultado = $obj->buscar($arrayDatos);
        //no va a andar si la base de datos no tiene nada
        if(!empty($resultado) && count($resultado) > 0){
            $usuario = $resultado[0];
            $_SESSION['idusuario'] = $usuario->getIdUsuario();
            $boolean = true;
        } else {
            $this->cerrar();
        }

        return $boolean;
    }
    
    
    // validar(). Valida si la sesion actual tiene idUsuario y password  validos. Devuelve true o false.
    // @param no hay
    //return boolean
    public function validar(){
        $resp = false;
        if($this->activa() && isset($_SESSION['idusuario']))
            $resp=true;
        return $resp;
    }

   

    //activa(). Devuelve true o false si la sesion esta activa o no. 
    public function activa(){
        return session_status() == PHP_SESSION_ACTIVE;
    }

    //cerrar(). Cierra la sesion actual.
    public function cerrar(){
        session_destroy();
    }

}

?>