<?php

    require_once("../imports.php");

    // Restrict page to users in the administrator role
    restrictPageToAdministrators();
    
    // If this is a post back attempt to edit a vehicle
    if (isPostBackWithField("editVehicleAttempt")) {
        
        // Get the vehicle id
        $editVehicleId = getPostFieldValue("editVehicleId", true);

        // Get the vehicle being edited
        $editVehicle = BookingDatabase::getInstance()->getVehicleById($editVehicleId);

        // Create a new vehicle object
        $vehicle = new Vehicle();

        // Set the vehicle details
        $vehicle->id = $editVehicle->id;
        $vehicle->registrationNo = getPostFieldValue("registrationNo", true);
        $vehicle->registrationDate = getDateInMySQLFormat(getPostFieldValue("registrationDate", true));
        $vehicle->vehicleModelId = intval(getPostFieldValue("vehicleModelId", true));
        
        // Update the vehicle in the db
        BookingDatabase::getInstance()->updateVehicle($vehicle);    

        // Return to the vehicle list 
        header("Location: vehicles.php");
        die();                            
    } 
    
    // Continue loading page

    // If no vehicle id is set in the request, return to the vehicle list
    if(!isset($_GET["id"])) {
        header("Location: vehicles.php");
        die(); 
    }

    // Get the requested vehicle id
    $requestedVehicleId = intval($_GET["id"]);

    // Get vehicle to edit from the db
    $editVehicle = BookingDatabase::getInstance()->getVehicleById($requestedVehicleId);
    
    // If no vehicle was found return the the vehicle list
    if($editVehicle == null) {
        header("Location: vehicles.php");
        die();        
    }    
    
    // Get a list of vehicle models for the view
    $vehicleModels = BookingDatabase::getInstance()->getAllVehicleModels();

    require_once("includes/admin_header.php");
    
    require_once("view/vehicles_edit_view.php");

    require_once("includes/admin_footer.php");

?>