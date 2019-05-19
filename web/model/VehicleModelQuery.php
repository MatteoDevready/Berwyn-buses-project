<?php

class VehicleModelQuery {
    private $dateFrom;
    private $dateTo;
    private $passengerNo;
    private $vehicleStandardId;
    private $licenceCategoryId;
    private $minDailyRate;
    private $maxDailyRate;

    function &__get($name) {
        return $this->$name;
    }
    
    function __set($name,$value) {
        $this->$name = $value;
    }   
 }

?>