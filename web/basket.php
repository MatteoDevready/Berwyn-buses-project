<?php
    require_once("imports.php");

    // Get any command request
    $cmd = getRequestFieldValue("cmd", false, "");

    // If command is to remove...
    if($cmd == "remove") {
        //...get the id of the item to remove from the basket items in session
        $id = intval(getRequestFieldValue("id", true, "0"));
        if($id > 0) { // We have a basket item to remove
            // Get the basket items from session
            $basketItems = getBasketItems();
            // Find the basket item in the array
            for($i = 0; $i < sizeof($basketItems); $i++) {
                if($basketItems[$i] != null && $basketItems[$i]->id == $id) {
                    // Remove the item from the array
                    array_splice($basketItems, $i, 1);
                    break;
                }
            }
            // We don't really need to set the basket items
            // but do it for completeness
            setBasketItems($basketItems);
        }
    }

    // Continue to load page

    // We are good to go, get the basket items from session
    $basketItems = getBasketItems();

    // Fix up the overall total rate for the basket items
    $totalRate = floatval(0.00);
    foreach($basketItems as $basketItem) {
        $totalRate = $totalRate + floatval($basketItem->totalRate);
    }

    // Determine VAT and total price inc. VAT
    $totalVAT = floatval($totalRate) * floatval(0.2);
    $totalPrice = $totalRate + $totalVAT;

    require_once("includes/header.php");

    require_once("view/basket_view.php");

    require_once("includes/footer.php");

?>