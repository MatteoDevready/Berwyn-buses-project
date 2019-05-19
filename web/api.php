<?php
require_once("imports.php");

// Get the command requested
$cmd = getRequestFieldValue("cmd", false, "");

// Initialise response data
$data = null;

switch($cmd) {
    // Return list of vehicle models in the fleet
    case "getOurFleet":
        $data = BookingDatabase::getInstance()->getAllVehicleModelDetails();
        foreach($data as $vehicleModelDetail) {
            $vehicleModelDetail->dailyRate = number_format($vehicleModelDetail->dailyRate, 2);
        }
        break;
    // Return booking report data to feed the chart on the admin home page
    case "getBookingReport": 
        $data = BookingDatabase::getInstance()->getBookingReport();
        break;
    // Return top 3 current promotions to display on the home page
    case "getCurrentPromotions":
        $data = BookingDatabase:: getInstance()->getCurrentPromotions();
        foreach($data as $promotion) {
            $promotion->expiringDate = getDateInUKFormat($promotion->expiringDate);
        }
        break;
    // Return top 3 most recently added vehicles (as models) to display on the home page
    case "getCurrentVehicles":
        $data = BookingDatabase:: getInstance()->getCurrentVehicles();
        break;
    // Unrecognised command, throw an app exception to the programmer
    default:
        throw new AppException("Invalid cmd querystring parameter");
}


?>

<?= json_response($data, 200, false, "Success") ?>