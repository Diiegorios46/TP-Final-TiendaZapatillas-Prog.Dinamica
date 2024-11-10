<?php

include './estructura/cabecera.php';


if($_REQUEST['seccion'] == 'chome'){
    header('Location: ./home/index.php');
} else {
    header('Location: ./login/index.php');
}