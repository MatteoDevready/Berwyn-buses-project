<?php

    require_once("../imports.php");

    // Restrict page to users in the administrator role
    restrictPageToAdministrators();

    // Initialise vehicle deleted message for the view
    $onVehicleDeletedMessage = "";

    // If this is a post back request attempting to delete a vehicle
    if (isPostBackWithField("deleteVehicleAttempt")) {

        // Get the vehicle id to delete
        $deleteVehicleId = getPostFieldValue("deleteVehicleId", true);

        // Delete the vehicle from the db
        BookingDatabase::getInstance()->deleteVehicle($deleteVehicleId);

        // Surface success message to the view
        $onVehicleDeletedMessage = "Vehicle successfully deleted";
    }
    
    // Continue to load the page

    // Get list of vehicles
    $vehicles = BookingDatabase::getInstance()->getAllVehicles();
    
    require_once("includes/admin_header.php");
       
    require_once("view/vehicles_view.php");

    require_once("includes/admin_footer.php");

?>