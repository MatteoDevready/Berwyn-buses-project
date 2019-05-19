<?php

    require_once("../imports.php");

    // Restrict page to users in the administrator role
    restrictPageToAdministrators();

    // If this is a post back request attempting to edit a promotion
    if (isPostBackWithField("editPromotionAttempt")) {
      
        // Get the promotion id to edit
        $editPromotionId = getPostFieldValue("editPromotionId", true);

        // Get the promotion to edit from the db
        $editPromotion = BookingDatabase::getInstance()->getPromotionById($editPromotionId);

        // Create a new promotion object
        $promotion = new Promotion();

        // Set the promotion details
        $promotion->id = $editPromotion->id;
        $promotion->title = getPostFieldValue("title", true);
        $promotion->info = getPostFieldValue("info", true);
        $promotion->vehicleModelId = intval(getPostFieldValue("vehicleModelId", true));
        $promotion->dailyRate = intval(getPostFieldValue("dailyRate", true));
        $promotion->expiringDate = getDateInMySQLFormat(getPostFieldValue("expiringDate", true));
        
        // Update the promotion in the db
        BookingDatabase::getInstance()->updatePromotion($promotion);    

        // Return to the promotions list
        header("Location: promotions.php");
        die();                            
    } 
    
    // If the promotion id has not been set, return to the promotions list
    if(!isset($_GET["id"])) {
        header("Location: promotions.php");
        die(); 
    }

    // Get the promotion id to edit
    $requestedPromotionId = intval($_GET["id"]);

    // Get the promotion to edit from the db
    $editPromotion = BookingDatabase::getInstance()->getPromotionById($requestedPromotionId);
    
    // If no promotion to edit, return to the promotions list
    if($editPromotion == null) {
        header("Location: promotions.php");
        die();        
    }    

    // Get a list of vehicle models from the db for the view
    $vehicleModels = BookingDatabase::getInstance()->getAllVehicleModels();

    require_once("includes/admin_header.php");
    
    require_once("view/promotions_edit_view.php");

    require_once("includes/admin_footer.php");

?>