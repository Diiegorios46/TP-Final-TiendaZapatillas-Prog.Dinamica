<?php 

function data_submitted() {
    $_AAux= array();
    if (!empty($_POST))
        $_AAux =$_POST;
        else
            if(!empty($_GET)) {
                $_AAux =$_GET;
            }
        if (count($_AAux)){
            foreach ($_AAux as $indice => $valor) {
                if ($valor=="")
                    $_AAux[$indice] = 'null' ;
            }
        }
        return $_AAux;
}

function verEstructura($e){
    echo "<pre>";
    print_r($e);
    echo "</pre>"; 
}

spl_autoload_register(function ($class_name){
    $directorys = [
        $_SESSION['ROOT'].'modelo/',
        $_SESSION['ROOT'].'modelo/conector/',
        $_SESSION['ROOT'].'control/',
    ];

    $i = 0;
    $LoEncontro = false;
    while($i < count($directorys) && !$LoEncontro){
        if(file_exists($directorys[$i] . $class_name . '.php')){
            require_once($directorys[$i] . $class_name . '.php');
            $LoEncontro = true;
        } else {
            $i++;
        }
    }

    return $LoEncontro;
});