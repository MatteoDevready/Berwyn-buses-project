<?php

    require_once("../../web/imports.php");

    for($i = 0; $i < 30; $i++) {

        $registrationDate = new DateTime("2019-01-31");
        $dateInterval = rand(100,1825);
        $registrationDate->sub(new DateInterval("P".$dateInterval."D"));

        $vehicle = new Vehicle();
        $vehicle->vehicleModelId = rand(1,14);
        $vehicle->registrationNo = getRegistrationNo();
        $vehicle->registrationDate = $registrationDate->format("Y-m-d");
        echo $vehicle->registrationDate."<br/>";
        BookingDatabase::getInstance()->addVehicle($vehicle);
    }


    function getRegistrationNo() {
        $letters = array("A", "B", "C", "D", "E", "F", "G", "H", "J", "K", "M", "N", "P", "R", "S", "T", "V", "W", "X", "Y", "Z");
        $firstNumbers = array(5,6);
        $secondNumbers = array(1,2,3,4,5,6);

        $firstLetter = $letters[rand(0,20)];
        $secondLetter = $letters[rand(0,20)];
        $firstNumber = $firstNumbers[rand(0,1)];
        $secondNumber = $secondNumbers[rand(0,5)];
        $thirdLetter = $letters[rand(0,20)];
        $fourthLetter = $letters[rand(0,20)];
        $fifthLetter = $letters[rand(0,20)];
        $registrationNo = $firstLetter.$secondLetter."".$firstNumber.$secondNumber." ".$thirdLetter.$fourthLetter.$fifthLetter;

        return $registrationNo;
    }
?>