<?php

    require_once("../imports.php");
    
    // Restrict page to users in the administrator role
    restrictPageToAdministrators();

    // If this is a post back request attempting to add a vehicle
    if (isPostBackWithField("addVehicleAttempt")) {

        // Create a new vehicle object
        $vehicle = new Vehicle();

        // Set the vehicle details
        $vehicle->vehicleModelId = getPostFieldValue("vehicleModelId", true);
        $vehicle->registrationNo = getPostFieldValue("registrationNo", true);
        $vehicle->registrationDate = getDateInMySQLFormat(getPostFieldValue("registrationDate", true));

        // Add vehicle to the db
        BookingDatabase::getInstance()->addVehicle($vehicle);

        // Return to the vehicle list
        header("Location: vehicles.php");
        die();
    }
    
    // Get a list of vehicle models for the view
    $vehicleModels = BookingDatabase::getInstance()->getAllVehicleModels();

    require_once("includes/admin_header.php");
    
    require_once("view/vehicles_add_view.php");

    require_once("includes/admin_footer.php");

?>