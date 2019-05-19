<?php

require_once("../../web/imports.php");

$bookingItems = BookingDatabase::getInstance()->getAllBookingItems();  

foreach($bookingItems as $bookingItem){ 
       
    $dateFrom = new DateTime($bookingItem->dateFrom);
    $dateTo = new DateTime($bookingItem->dateTo);

    echo $dateFrom->format("Y-m-d")." - ".$dateTo->format("Y-m-d")."<br/>";

    $currentDate = $dateFrom;
    do
    {
        $bookingItemSchedule = new BookingItemSchedule();
        $bookingItemSchedule->bookingItemId = $bookingItem->id;
        $bookingItemSchedule->dateBooked = $currentDate->format("Y-m-d");
        BookingDatabase::getInstance()->addBookingItemSchedule($bookingItemSchedule);
        echo $currentDate->format("Y-m-d")."<br/>";

        $currentDate->add(new DateInterval("P1D"));
    } while($currentDate <= $dateTo);
}

?>