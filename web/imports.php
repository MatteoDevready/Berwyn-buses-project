<?php
    // For each php file in the model folder
    foreach(glob(dirname(__FILE__)."/model/*.php") as $filename){
        // Require it once
        require_once($filename);
    }
?>