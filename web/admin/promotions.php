<?php

    require_once("../imports.php");

    // Restrict page to users in the administrator role
    restrictPageToAdministrators();
    
    // Initialise the delete promotion message for the view
    $onPromotionDeletedMessage = "";

    // If this is a post back request attempting to delete a promotion
    if (isPostBackWithField("deletePromotionAttempt")) {

        // Get the promotion id to delete
        $deletePromotionId = getPostFieldValue("deletePromotionId", true);

        // Delete the promotion from the db
        BookingDatabase::getInstance()->deletePromotion($deletePromotionId);

        // Surface a success message to the view
        $onPromotionDeletedMessage = "Promotion successfully deleted";
    }

    // Continue loading page

    // Get a list of promotions from the db
    $promotions = BookingDatabase::getInstance()->getAllPromotions();

    require_once("includes/admin_header.php");   
  
    require_once("view/promotions_view.php");

    require_once("includes/admin_footer.php");

?>