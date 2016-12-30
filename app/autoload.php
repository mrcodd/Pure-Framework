<?php

spl_autoload_register(function($class){

    $path = realpath('.');
    
    if(file_exists("{$path}/app/class/{$class}.php")) {
        require_once "{$path}/app/class/{$class}.php";
    }
    
    if(file_exists("{$path}/app/controller/{$class}.php")) {
        require_once "{$path}/app/controller/{$class}.php";
    }
    
    if(file_exists("{$path}/app/model/{$class}.php")) {
        require_once "{$path}/app/model/{$class}.php";
    }
    
    if(file_exists("{$path}/app/config/{$class}.php")) {
        require_once "{$path}/app/config/{$class}.php";
    }
    
});

