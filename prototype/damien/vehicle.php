<?php

class Customer
{
    private $vehicleId;
    private $make;
    private $dateOfReg;
    private $regNo;
    private $coulour;
    private $vehicleStatus;
    private $bookingStatus;
    private $seatNo;
    private $
    
}

function __get($name)
{
    return $this->$name;
}

function __set($name, $value)
{
    $this->$name = $value;
}
?>