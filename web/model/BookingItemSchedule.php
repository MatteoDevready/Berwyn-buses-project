<?php

class BookingItemSchedule {
    private $id;
    private $bookingItemId;
    private $dateBooked;

    function &__get($name) {
        return $this->$name;
      }
    
      function __set($name,$value) {
        $this->$name = $value;
      }   
 }

?>