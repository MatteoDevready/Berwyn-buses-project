<?php

class BookingItem {
    private $id;
    private $bookingId;
    private $placeFrom;
    private $placeTo;
    private $dateFrom;
    private $dateTo;
    private $dateCreated;
    private $passengerNo;
    private $isSelfDriving;
    private $preferredDriver;
    private $vehicleId;
    private $dailyRate;
    private $totalRate;

    function &__get($name) {
        return $this->$name;
    }
  
    function __set($name,$value) {
      $this->$name = $value;
    }   
 }

?>