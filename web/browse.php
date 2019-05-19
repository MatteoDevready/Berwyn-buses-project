<?php
require_once("imports.php");

// Determine whether or not the customer is revisiting this page
// e.g. returning from basket_add.php
$isRevisit = intval(getRequestFieldValue("revisit", false, "0")) == 1;

// Determine if there is an added to basket event
$addedToBasket = intval(getRequestFieldValue("addedToBasket", false, "0")) == 1;

// Surface any added to basket event to the view
$addedToBasketMessage = $addedToBasket ? "Order added to your basket" : "";

// If this is a revisit, and we have to vehicleModelQuery in session...
if($isRevisit && isset($_SESSION["vehicleModelQuery"])) {
    //...use the object in session 
    $vehicleModelQuery = $_SESSION["vehicleModelQuery"];
}
else {
    //...create a new object and store it in session
    $vehicleModelQuery = new VehicleModelQuery();
    $vehicleModelQuery->dateFrom = getDateInMySQLFormat(getRequestFieldValue("dateFrom", false, ""));
    $vehicleModelQuery->dateTo = getDateInMySQLFormat(getRequestFieldValue("dateTo", false, ""));
    $vehicleModelQuery->passengerNo = intval(getRequestFieldValue("passengerNo", false, "0"));
    $vehicleModelQuery->vehicleStandardId = intval(getRequestFieldValue("vehicleStandardId", false, "0"));
    $vehicleModelQuery->licenceCategoryId = intval(getRequestFieldValue("licenceCategoryId", false, "0"));
    $vehicleModelQuery->minDailyRate = intval(getRequestFieldValue("minDailyRate", false, "0"));
    $vehicleModelQuery->maxDailyRate = intval(getRequestFieldValue("maxDailyRate", false, "0"));
    $_SESSION["vehicleModelQuery"] = $vehicleModelQuery;
}

// Continue to load page

// We are good to go, get the vehicle models from the database
// using our vehicleModelQuery. This will either return a filtered view
// or bring all the vehicle models back
$vehicleModels = BookingDatabase::getInstance()->getVehicleModelsByQuery($vehicleModelQuery);

// Do a quick workaround to fix up available vehicles to 
// include any in the basket in addition to those in the db

// Get the number of available vehicles for each model from the db
// Note: this is an expensive operation, refactor sometime
foreach($vehicleModels as $vehicleModel) {
    $vehicleModel->total = BookingDatabase::getInstance()->getVehicleModelTotal($vehicleModelQuery, $vehicleModel);
}

// Get the basket items from session
$basketItems = getBasketItems();

// For each basket item
foreach($basketItems as $basketItem) { 
    foreach($vehicleModels as $vehicleModel) {
        // Find vehicle models which match
        if($vehicleModel->id == $basketItem->vehicleModelId) {
            if(isInDateRange($basketItem->dateFrom, $basketItem->dateTo, $vehicleModelQuery->dateFrom, $vehicleModelQuery->dateTo)) {
                // If the customer has a vehicle model in the basket, it is not in the db yet
                // so decrement to the number of this model of vehicle.
                $vehicleModel->total--;
            }   
            break;
        }
    }   
}

require_once("includes/header.php");

require_once("view/browse_view.php");

require_once("includes/footer.php");

?>