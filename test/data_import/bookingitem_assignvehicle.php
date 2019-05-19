<?php

require_once("../../web/imports.php");

$bookingItems = BookingDatabase::getInstance()->getAllBookingItems();  

foreach($bookingItems as $bookingItem){ 
    if($bookingItem->vehicleId == null) {
        $possibleVehicleModels = BookingDatabase::getInstance()->getVehicleModelsByPassengerNo($bookingItem->passengerNo);
        foreach($possibleVehicleModels as $possibleVehicleModel){
            $possibleVehicles = BookingDatabase::getInstance()->getAvailableVehicles($possibleVehicleModel->id, $bookingItem->dateFrom, $bookingItem->dateTo);
           
            if($possibleVehicles != null && sizeof($possibleVehicles) > 0) {
                $possibleVehicle = $possibleVehicles[0];
                $bookingItem->vehicleId = $possibleVehicle->id;
                BookingDatabase::getInstance()->updateBookingItem($bookingItem);
                echo $possibleVehicle->registrationNo."<br/>";
                break;
            }
        }
    }
}

$bookingItems = BookingDatabase::getInstance()->getAllBookingItems();  

foreach($bookingItems as $bookingItem){ 
    if($bookingItem->vehicleId == "") {
        $bookingItem->passengerNo = rand(4, 70);
        BookingDatabase::getInstance()->updateBookingItem($bookingItem);
        echo "Fixed up ".$bookingItem->id."<br/>";
    }
}
?>