<?php

class BasketAddForm {
    private $placeFrom;
    private $placeTo;
    private $dateFrom;
    private $dateTo;
    private $passengerNo;
    private $isSelfDriving;
    private $preferredDriver;

    function &__get($name) {
        return $this->$name;
    }
  
    function __set($name,$value) {
      $this->$name = $value;
    }   
 }

?>