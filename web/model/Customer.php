<?php

class Customer {
    private $id = 0;
    private $firstName = "";
    private $lastName = "";
    private $companyName;
    private $emailAddress = "";
    private $phoneNo = "";
    private $password = "";
    private $isAdministrator = false;    

    function &__get($name) {
        return $this->$name;
    }
    
    function __set($name,$value) {
      $this->$name = $value;
    }   

    function getFullName() {
      return $this->firstName." ".$this->lastName;
    }
 }

?>