<?php
    require_once("imports.php");

    // Restricted page. Ensure the customer is signed in or force them to sign in
    restrictPageToSignedInUsers("signin.php?from=index.php&url=checkout.php");
    
    // Get the basket items from session
    $basketItems = getBasketItems();

    // Initialise a checkout message for the view
    $checkOutMessage = "";

    // If there are items in the basket
    if(getBasketSize() > 0) {
        // Handle our own app exceptions
        try {
            // Have a go at checking out the basket items all in one go
            BookingDatabase::getInstance()->checkout($authUser, $basketItems);
        }
        catch(AppException $ae) {
            // Surface checkout messages to the view
            $checkOutMessage = $ae->getMessage();
        }
        
    }

    // Calculate the total rate for the order
    $totalRate = floatval(0.00);
    foreach($basketItems as $basketItem) {
        if($basketItem->vehicleId > 0) {
            $totalRate = $totalRate + floatval($basketItem->totalRate);
        }
    }

    // Calculate the total VAT and price including VAT
    $totalVAT = floatval($totalRate) * floatval(0.2);
    $totalPrice = $totalRate + $totalVAT;    

    require_once("includes/header.php");

    require_once("view/checkout_view.php");

    require_once("includes/footer.php");

    // Lastly, clear the basket
    // Note: the view relies on the basket item array, so it can only be cleared 
    // after the view has loaded
    clearBasket();
?>