<?php

class BasketItem {
    private $id;
    private $vehicleId;
    private $vehicleModelId;
    private $vehicleModel;
    private $placeFrom;
    private $placeTo;
    private $dateFrom;
    private $dateTo;
    private $passengerNo;
    private $isSelfDriving;
    private $standard;
    private $category;
    private $dailyRate;
    private $totalRate;
    private $preferredDriver;

    function &__get($name) {
        return $this->$name;
    }
  
    function __set($name,$value) {
      $this->$name = $value;
    }   
 }

?>