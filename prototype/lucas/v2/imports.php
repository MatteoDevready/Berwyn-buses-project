<?php
    foreach(glob(dirname(__FILE__)."/model/*.php") as $filename){
        require_once($filename);
    }
?>