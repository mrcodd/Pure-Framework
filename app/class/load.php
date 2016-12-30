<?php

class Load {
    
    public static function view($file, $data = array()) {
        
        extract($data);
        
        if(file_exists("app/view/{$file}.php")) {
            
            require_once "app/view/{$file}.php";
            
        }
        
    }
    
    public static function model($file) {
        
        if(file_exists("app/model/{$file}.php")) {
            
            require_once "app/model/{$file}.php";
            
        }
        
    }
    
}

?>