<?php 

function data_submitted()
{
    $datos = [];
    if (!empty($_POST))
        $datos = $_POST;
    elseif (!empty($_GET)) {
        $datos = $_GET;
    }

    if (!empty($_FILES)) {
        $datos = array_merge($datos, $_FILES);
    }

    if (count($datos)) {
        foreach ($datos as $indice => $valor) {
            if ($valor == "")
                $datos[$indice] = 'null';
        }
    }
    return $datos;
}

function verEstructura($e){
    echo "<pre>";
    print_r($e);
    echo "</pre>"; 
}

spl_autoload_register(function ($class_name){
    $directorys = [
        $_SESSION['ROOT'].'src/Modelo/',
        $_SESSION['ROOT'].'src/Modelo/conector/',
        $_SESSION['ROOT'].'src/Control/',
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