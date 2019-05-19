<?php

class BookingItemDetail extends BookingItem {
    private $bookingDateCreated;
    private $bookingStatus;
    private $vehicleModel;
    private $vehicleRegistrationNo;

    function &__get($name) {
        return $this->$name;
    }
  
    function __set($name,$value) {
      $this->$name = $value;
    }   
 }

?>