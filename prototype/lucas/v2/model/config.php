<?php
    define("DEBUG_MODE", true);

    if(!DEBUG_MODE) {
        define("DB_DSN", "mysql:host=kunet.kingston.ac.uk;dbname=db_k1736700");
    }
    else {
        define("DB_DSN", "mysql:host=localhost;dbname=db_k1736700");
    }
    
    define("DB_USER", "k1736700");
    define("DB_PASSWORD", "topnotch");

    if(DEBUG_MODE) {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    }

?>