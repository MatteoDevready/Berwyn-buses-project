<?php
require_once("imports.php");

// Determine whether a customer is returning to the home page after making a direct
// request to basket_add.php
$addedToBasket = intval(getRequestFieldValue("addedToBasket", false, "0")) == 1;

// If so, surface a message to the view
$addedToBasketMessage = $addedToBasket ? "Order added to your basket" : "";

// Determine whether or not vehicleModelQuery is in session...
if(isset($_SESSION["vehicleModelQuery"])) {
    //...it is, retrieve it from session
    $vehicleModelQuery = $_SESSION["vehicleModelQuery"];
}
else {    
    //...it isn't, prepare a new vehicleModelQuery and store it in session
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

require_once("includes/header.php");

require_once("view/index_view.php");

require_once("includes/footer.php");

?>