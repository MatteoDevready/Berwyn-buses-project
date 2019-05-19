<?php
require_once("includes/header.php");
require_once("data/VehicleModelTypeManager.php");

$vehicleModelTypeManager = new VehicleModelTypeManager();

$vehicleModelTypeList = isset($_REQUEST["model"]) ? 
                            $vehicleModelTypeManager->getAllByModel($_REQUEST["model"]) : 
                            $vehicleModelTypeManager->getAll();

require_once("views/browse_view.php");
require_once("includes/footer.php");

?>


