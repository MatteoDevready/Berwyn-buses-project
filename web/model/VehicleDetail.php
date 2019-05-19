<?php

class VehicleDetail extends Vehicle implements JsonSerializable {
    private $id;
    private $model;
    private $minNoOfPassengers;
    private $maxNoOfPassengers;
    private $dailyRate;

    function &__get($name) {
        return $this->$name;
      }
    
      function __set($name,$value) {
        $this->$name = $value;
      } 
      
      public function jsonSerialize()
      //json Serialize must return an associative array of all the 
      //class attributes, so that we were able  to json_encode instance of the class.
      {
        return get_object_vars($this);//thanks to the parameter $this all attribute of this
        //class can be used as a json object.
      }
 }

?>