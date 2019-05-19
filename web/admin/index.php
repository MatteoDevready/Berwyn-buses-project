<?php

    require_once("../imports.php");

    // Restrict page to users in the administrator role
    restrictPageToAdministrators();
    
    // Get number of customers in the db for the view
    $numberOfCustomers = BookingDatabase::getInstance()->getNumberOfCustomers();

    // Get number of promotions in the db for the view
    $numberOfPromotions = BookingDatabase::getInstance()->getNumberOfPromotions();

    // Get number of vehicles in the db for the view
    $numberOfVehicles = BookingDatabase::getInstance()->getNumberOfVehicles();

    require_once("includes/admin_header.php");

    require_once("view/index_view.php");

    require_once("includes/admin_footer.php");

?>