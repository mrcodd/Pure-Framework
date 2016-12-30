<?php

Class Route {
    
    private static $error = true;
    
    public static function add($pattern, $callback, $method) {
        
        if(!is_string($pattern)) {
            
            echo 'Error : Pattern not string!';
            exit();
            
        }
        
        if(!is_string($callback) && !is_callable($callback)) {
            
            echo 'Error: Callback not string or not callable!';
            exit();
            
        }
        
        if($pattern != '/') {
            
            $pattern  = '/' . $pattern;
            
        }
        
        self::run($pattern, $callback, $method);
        
    }
    
    public static function error($callback) {
        if(self::$error == true) {
            
            call_user_func($callback);
            
        }
    }
    
    private static function run($pattern, $callback, $method) {
        
        if(empty($pattern) || empty($callback) || empty($method)) {
            
            echo 'Error: Pattern, callback or method empty!';
            exit();
            
        }
        
        $requestUri = empty($_SERVER['REQUEST_URI']) ? "/" : $_SERVER['REQUEST_URI'];
        
        $pattern = str_replace("(:any)", "(.*?)", $pattern);
        $pattern = str_replace("(:number)", "(\d+)", $pattern);
        $pattern = "#^$pattern$#";
        
        if(preg_match($pattern, $requestUri, $parameters) && $_SERVER['REQUEST_METHOD'] == $method) {
            
            if(is_callable($callback)) {
                
                array_shift($parameters);
                call_user_func_array($callback, $parameters);
                
            }else if(is_string($callback)) {
                
                $callback = explode('@', $callback);
                
                if(count($callback) == 1) {
                    
                    if(is_callable($callback)) {
                        
                        call_user_func($callback);
                        
                    }else {
                        
                        echo 'Error: Function not callable!';
                        exit();
                        
                    }
                    
                }else {
                    
                    if(method_exists($callback[0], $callback[1])) {
                        
                        array_shift($parameters);
                        $controller = new $callback[0]();
                        call_user_func_array(array($controller, $callback[1]), $parameters);
                        
                    }else {
                        
                        echo 'Error: Method not found!';
                        exit();
                        
                    }
                    
                }
                
            }
            
            self::$error = false;
            
        }
        
    }
    
}


?>