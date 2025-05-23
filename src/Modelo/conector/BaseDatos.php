<?php
class BaseDatos extends PDO {
  
    private $engine;
    private $host;
    private $database;
    private $user;
    private $pass;
  	private $debug;
  	private $conec;
  	private $indice;
  	private $resultado;
  	private $cantFilasResultado;
    
    public function __construct(){
        $this->engine = 'mysql';
        $this->host = 'localhost';
        $this->database = 'bdcarritocompras';
        $this->user = 'root';
        $this->pass = '';
        $this->debug = false;
        $this->error ="";
        $this->sql ="";
        $this->indice =0;
        
        $dns = $this->engine.':dbname='.$this->database.";host=".$this->host;
        try {
           parent::__construct( $dns, $this->user, $this->pass,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
           $this->conec=true;
           
        }catch (PDOException $e) {
           
            $this->sql = $e->getMessage();
            $this->conec=false;
        }
       
    }
    /**
     * Inicia la coneccion con el Servidor y la  Base Datos Mysql.
     * Retorna true si la coneccion con el servidor se pudo establecer y false en caso contrario
     *
     * @return boolean
     */
    public function Iniciar(){
        return $this->getConec();
        
    }
    
  
    public function getCantFilasResultado(){
        return $this->cantFilasResultado;
    }
    
    
    
    
    public function setCantFilasResultado($valor){
        $this->cantFilasResultado = $valor;
    }
    
    
    
    
    public function getConec(){
        return $this->conec;
    }
    
    
    
    
    public function setDebug($debug){
        $this->debug = $debug;
    }
    
    public function getDebug(){
        return $this->debug;
    }
  
    /**
     * Funcion que setea la variable instancia error
     */
    public function setError($e){
      
        $this->error = $e;
        
        
    }
        
    /**
     * Funcion que retorna una cadena con descripcion del ultimo error seteado
     * @return 
     */
    public function getError(){
        $resp = "";
        if ($this->error!=null){
            $resp = $this->error[2];
        }
        return $resp;
        
    }
    
    /**
     * Funcion que setea la variable instancia sql
     */
    public function setSQL($e){
        $this->sql = $e;
        
    }
    
    /**
     * Funcion que retorna una cadena con el ultimo sql seteado
     * @return
     */
    public function getSQL(){
        return $this->sql;
        
    }
    
    public function Ejecutar($sql){
        $this->setError(null);
       // echo "Hola ".$sql;
        $this->setSQL($sql);
        if ( stristr($sql,"insert") ){ // se desea NSERT ? 
                $resp =  $this->EjecutarInsert($sql);
        }
        // se desea UPDATE o DELETE ? 
        if ( stristr($sql,"update")OR stristr($sql,"delete")){
                $resp =  $this->EjecutarDeleteUpdate($sql);
        }
        
        // se desea ejecutar un select
        if ( stristr($sql,"select")){
            $resp =  $this->EjecutarSelect($sql);
        }
        
        if($this->getError()!=null){
            $resp =false;
        }
        return $resp;
   }
   
   /**
    *Si se inserta en una tabla que tiene una columna autoincrement se retorna el id con el que se inserto el registro
    *caso contrario se retorna -1
    */
   
   private function EjecutarInsert($sql){
       $resultado=parent::query($sql);
       if(!$resultado){
           $this->analizarDebug();
           $id=0;
       }else{
         $id =  $this->lastInsertId(); 
         if ($id==0){
             $id=-1;
         }
           
       }
       return $id;
   }
   
   /**
    * Devuelve la cantidad de filas afectadas por la ejecucion SQL. Si el valor es <0 no se pudo realizar la opercion
    * @return integer 
    * 
    */
   private function EjecutarDeleteUpdate($sql){
       $cantFilas =-1;
       $resultado=parent::query($sql);
       if(!$resultado){
           $this->analizarDebug();
       }else{
           $cantFilas =  $resultado->rowCount();
           $this->setCantFilasResultado($cantFilas);
           
           
       }
       return $cantFilas+1;
       
   }
   
   /**
    * Retorna cada uno de los registros de una consulta select
    * @return integer
    *
    */
   
   private function EjecutarSelect($sql){
       $cant = -1;
       $resultado = parent::query($sql);

       if(!$resultado){
           $this->analizarDebug();
       }else {
         
          $arregloResult = $resultado->fetchAll();
          $cant = count($arregloResult);
          $this->setIndice(0);
          $this->setResultado($arregloResult);
       }
       return $cant;
       
   }

   public function devuelveIDInsercion($sql){
       $resultado=parent::query($sql);
       if(!$resultado){
           $this->analizarDebug();
           $id=0;
       }else{
         $id =  $this->lastInsertId(); 
         if ($id==0){
             $id=-1;
         }
           
       }
       return $id;
   }
   
   /**
    * Devuelve un registro retornado por la ejecucion de una consulta
    * el puntero se despleza al siguiente registro de la consulta
    *
    * @return array
    */ 
   public function Registro() {
       $filaActual = false;
       $indiceActual = $this->getIndice();
       if ($indiceActual>=0) {
           $filas = $this->getResultado();
           if($indiceActual< count($filas)){
               $filaActual =  $filas[$indiceActual];
          
                $indiceActual++;
                $this->setIndice($indiceActual);
           }else {
               $this->setIndice(-1);
           }
          
       } 
    
       return $filaActual;
   }
   
   /**
    * Esta funcion si esta seteado la variable instancia $this->debug visualiza el debug
    */
   private function analizarDebug(){
       $e = $this->errorInfo();
       $this->setError($e);
       if($this->getDebug()){
           echo "<pre>";
           print_r($e);
           echo "</pre>";
           echo "<pre>";
           $this->getSQL();
           echo "</pre>";
           
       }
       
       
   }
   
   private function setIndice ($valor){
       $this->indice = $valor;
   }
   
   private function getIndice (){
       return $this->indice;
       
   }
   private function setResultado($valor){
       $this->resultado = $valor;
       
   }
   private function getResultado(){
      
      return $this->resultado;
   }
   
   
   
   

   
 
} 