<?php

class ContactUs {
    private $id = 0;
    private $emailAddress = "";
    private $message = "";   

    function &__get($name) {
        return $this->$name;
    }
    
    function __set($name,$value) {
      $this->$name = $value;
    }   
 }

?>