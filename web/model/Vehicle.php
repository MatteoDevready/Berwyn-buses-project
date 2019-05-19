<?php

class Vehicle {
    private $id;
    private $registrationNo;
    private $registrationDate;
    private $vehicleModelId;
    private $model;

    function &__get($name) {
        return $this->$name;
      }
    
      function __set($name,$value) {
        $this->$name = $value;
      }   
 }

?>