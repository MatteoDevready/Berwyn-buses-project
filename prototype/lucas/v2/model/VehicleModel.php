<?php

class VehicleModel {
    public $id;
    public $model;
    public $maxNoOfPassengers;
    public $hourlyRate;

    function __get($name) {
        return $this->$name;
      }
    
      function __set($name,$value) {
        $this->$name = $value;
      }   
 }

?>