<?php
    require_once("imports.php");

    // Restricted page. Ensure the customer is signed in, otherwise prompt them to do so.
    restrictPageToSignedInUsers("signin.php?from=index.php&url=bookings.php");

    // Initialise booking item message for the view
    $bookingItemMessage = "";

    // If this is an attempt to delete a booking item from the db...
    if (isPostBackWithField("deleteBookingItemAttempt")) {
        //...get the booking item id
        $id = intval(getRequestFieldValue("deleteBookingItemId", true, "0"));
        // Delete the booking item from the db (this method will clear the booking item schedule as well)
        BookingDatabase::getInstance()->deleteBookingItemById($id);
        // Surface success message to the view
        $bookingItemMessage = "Booking No $id has been cancelled.";
    }

    // Continue to load page

    // We are good to go, get the booking items from the db
    $bookingItemDetails = BookingDatabase::getInstance()->getBookingItemDetails($authUser);
    
    require_once("includes/header.php");

    require_once("view/bookings_view.php");

    require_once("includes/footer.php");

?>