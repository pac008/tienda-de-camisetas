<?php

function controllersAutoload($classname){
    include 'controllers/'.$classname.'.php';
}

spl_autoload_register('controllersAutoload');