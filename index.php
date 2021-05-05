<?php
session_start();
require_once 'autoload.php';
require_once 'config/db.php';
require_once 'config/parameters.php';
require_once 'helpers/utils.php';
require_once 'views/layout/header.php';
require_once 'views/layout/sidebar.php';


if(isset($_GET['controller'])){
     $nombreControlador = $_GET['controller'].'Controller';
}elseif(!isset($_GET['controller'])){
    $nombreControlador = controller_default;
}else{
    echo "<h1>La página no existe</h1>";
    exit();
}

if(class_exists($nombreControlador)){

    $controlador = new $nombreControlador();

    if( isset($_GET['action']) && method_exists($controlador, $_GET['action'] ) ){
        $action = $_GET['action'];
        $controlador->$action();
    
    }elseif(!isset($_GET['action'])){
        $default = action_default;
        $controlador->$default();
    }else{
        echo "No existe el método";
    }
}else{
    echo "El controlador no existe";
}

require_once 'views/layout/footer.php';