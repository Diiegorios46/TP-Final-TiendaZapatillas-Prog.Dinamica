<?php 
 class Session {

    // ********* Usar en caso especifico ********* //
    //getUsuario().Devuelve el getUsuario logeado.
    public function getUsuario(){
        $usuario = null;
        if($this->validar()){
            $obj = new abmUsuario();
            $param['idusuario'] = $_SESSION['idusuario'];
            $resultado = $obj->obtenerDatos($param)[0];
            
            if(count($resultado) > 0){
                
                $usuario = $resultado;
            }
        }
        return $usuario;
    }
    
        
    // Actualiza las variables de sesion con los valores ingresados.
    public function iniciar($mail ,$psw){
        $boolean = false;
        $obj = new abmUsuario();
        $arrayDatos['usmail'] = $mail;
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

    public function setearUnDato($dato){
        $_SESSION[$dato['nombreDato']] = $dato['dato'];
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

    public function getRol(){
        $rol = null;
        if($this->validar()){
            $obj = new abmUsuarioRol();
            $param['idusuario'] = $_SESSION['idusuario'];
            $resultado = $obj->obtenerDatos($param);

            if(count($resultado) > 0){
                $usuario = $resultado[0];
                $rol = $usuario['idrol'];
            }
        }
        
        return $rol;
    }
   

    //activa(). Devuelve true o false si la sesion esta activa o no. 
    public function activa(){
        return session_status() == PHP_SESSION_ACTIVE;
    }

    //cerrar(). Cierra la sesion actual.
    public function cerrar(){
        session_write_close();
    }

    public function destruir(){
        session_destroy();
    }

    public function activar(){
        session_start();
    }

}

?>