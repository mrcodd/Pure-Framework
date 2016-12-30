<?php

class Database extends PDO{

    protected $host     = 'localhost';
    protected $username = 'root';
    protected $password = '';
    protected $database = 'modb';

    function __construct() {
        
        $dsn = "mysql:host={$this->host};dbname={$this->database}; charset=utf8";
        parent::__construct($dsn, $this->username, $this->password);
        
    }

}

?>