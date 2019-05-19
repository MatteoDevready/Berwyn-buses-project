<?php

require_once("../../web/imports.php");

$bookings = BookingDatabase::getInstance()->getAllBookings();  

foreach($bookings as $booking){ 
    
    $numberOfBookingItems = rand(1, 3);
    for($b = 1; $b <= $numberOfBookingItems; $b++) {

        $dateCreated = new DateTime($booking->dateCreated);

        $bookingItem = new BookingItem();
        $bookingItem->bookingId = $booking->id;
        $bookingItem->placeFrom = "";
        $bookingItem->placeTo = "";

        $dateFrom = new DateTime($dateCreated->format("Y-m-d"));
        $dateFromInterval = rand(0,90);
        if($dateFromInterval > 0) {
            $dateFrom->add(new DateInterval("P".$dateFromInterval."D"));
        }
        

        $dateToInterval = rand(0,7);
        $dateTo = new DateTime($dateFrom->format("Y-m-d"));
        if($dateToInterval > 0) {
            $dateTo->add(new DateInterval("P".$dateToInterval."D"));
        }
        
        $bookingItem->dateFrom = $dateFrom->format("Y-m-d");
        $bookingItem->dateTo = $dateTo->format("Y-m-d");
        $bookingItem->dateCreated = $booking->dateCreated;
        $bookingItem->passengerNo = rand(4, 70);
        $bookingItem->isSelfDriving = rand(0,1);
        $bookingItem->preferredDriver = "";

        BookingDatabase::getInstance()->addBookingItem($bookingItem);
    }
}

?>