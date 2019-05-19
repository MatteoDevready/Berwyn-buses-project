<?php

class VehicleModel implements JsonSerializable{
    private $id;
    private $model;
    private $minNoOfPassengers;
    private $maxNoOfPassengers;
    private $hourlyRate;
    private $licenseCategoryId;
    private $category;
    private $vehicleStandardId;
    private $standard;
    private $total;

    function &__get($name) {
        return $this->$name;
      }
    
      function __set($name,$value) {
        $this->$name = $value;
      } 
      
      public function jsonSerialize()
      {
        return get_object_vars($this);
      }
 }

?>