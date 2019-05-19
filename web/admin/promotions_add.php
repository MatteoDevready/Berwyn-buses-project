<?php

    require_once("../imports.php");
    
    // Restrict page to users in the administrator role
    restrictPageToAdministrators();
    
    // Initialise promotion error message for the view
    $addPromotionErrorMessage = "";

    // If this is a post back request attempting to add a promotion
    if (isPostBackWithField("addPromotionAttempt")) {

        // Create a new promotion object
        $promotion = new Promotion();

        // Set the promotion details
        $promotion->vehicleModelId = intval(getPostFieldValue("vehicleModelId", true));
        $promotion->title = getPostFieldValue("title", true);
        $promotion->info = getPostFieldValue("info", true);
        $promotion->dailyRate = intval(getPostFieldValue("dailyRate", true));
        $promotion->expiringDate = getDateInMySQLFormat(getPostFieldValue("expiringDate", true));

        // Add the promotion to the db
        BookingDatabase::getInstance()->addPromotion($promotion);

        // Return to the promotions list
        header("Location: promotions.php");
        die();
    }

    // Continue loading page

    // Get a list of vehicle models from the db
    $vehicleModels = BookingDatabase::getInstance()->getAllVehicleModels();

    require_once("includes/admin_header.php");
    
    require_once("view/promotions_add_view.php");

    require_once("includes/admin_footer.php");

?>