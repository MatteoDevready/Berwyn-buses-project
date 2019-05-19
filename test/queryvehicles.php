<?php

    require_once("../../web/imports.php");

    $vehicleModels = BookingDatabase::getInstance()
        ->getVehicleModelQuery("2019-01-01", "2019-06-02", 10, 1, 1, 100, 110);

    var_dump($vehicleModels);
?>