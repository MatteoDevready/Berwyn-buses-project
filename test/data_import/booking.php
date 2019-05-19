<?php

    require_once("../../web/imports.php");

    
    $customers = BookingDatabase::getInstance()->getAllCustomers();  

    foreach($customers as $customer){ 
        $numberOfBookings = rand(1, 10);
        for($i = 1; $i <= $numberOfBookings; $i++) {
            $booking = new Booking();
            $booking->customerId = $customer->id;
            $dateCreated = new DateTime("2019-".rand(1,6)."-".rand(1,28));
            $booking->dateCreated = $dateCreated->format("Y-m-d");
            $booking->bookingStatusId = rand(1,3);
            BookingDatabase::getInstance()->addBooking($booking);
        }

    }
?>