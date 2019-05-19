<?php

class Booking {
    private $id;
    private $customerId;
    private $dateCreated;
    private $bookingStatusId;

    function &__get($name) {
        return $this->$name;
      }
    
      function __set($name,$value) {
        $this->$name = $value;
      }   
 }

?>