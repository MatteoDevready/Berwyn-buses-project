<?php

    require_once("imports.php");

    // Get the return url
    $url = getRequestFieldValue("url", false);

    // Determine if this is a direct request from the home page for example, 
    // otherwise the request is coming from the browse page and we need to
    // prefill the form from the vehicleModelQuery object in session
    $isDirect = getRequestFieldValue("direct", false, "0") == "1";

    // Initialise a processing message
    $processingMessage = "";

    // Determine whether the add button has been clicked (the form posted)
    if (isPostBackWithField("addBookingItemAttempt")) {

        // Handle app exceptions we throw
        try
        {
            // Prepare a new basket item
            $basketItem = new BasketItem();
            $basketItem->id = getBasketSize() + 1;
            $basketItem->vehicleModelId = intval(getPostFieldValue("vehicleModelId", true));
    
            // Get the details for the selected vehicle
            $vehicleModel = BookingDatabase::getInstance()->getVehicleModel($basketItem->vehicleModelId);
            
            // Set the basket item details
            $basketItem->model = $vehicleModel->model;
            $basketItem->standard = $vehicleModel->standard;
            $basketItem->category = $vehicleModel->category;
            $basketItem->dailyRate = floatval(getPostFieldValue("dailyRate", true));
            $basketItem->placeFrom = getPostFieldValue("placeFrom", false);
            $basketItem->placeTo = getPostFieldValue("placeTo", false);
            $basketItem->dateTo = getDateInMySQLFormat(getPostFieldValue("dateTo", true));
            $basketItem->dateFrom = getDateInMySQLFormat(getPostFieldValue("dateFrom", true));

            // Get and set the number of vehicles available for the vehicle model
            $vehicleModel->total = BookingDatabase::getInstance()->getVehicleModelTotal2($vehicleModel, $basketItem->dateFrom, $basketItem->dateTo);

            // Get the basket items from session
            $basketItems = getBasketItems();
            foreach($basketItems as $existingBasketItem) { 
                // Find matching vehicle models already in the basket
                if($vehicleModel->id == $existingBasketItem->vehicleModelId) {
                    if(isInDateRange($existingBasketItem->dateFrom, $existingBasketItem->dateTo, $basketItem->dateFrom, $basketItem->dateTo)) {
                        // Decrement the number of vehicle models available, the customer has
                        // this one in their basket
                        $vehicleModel->total--;
                    }
                }
            }

            // Handle scenario where we haven't a vehicle of this model available 
            if($vehicleModel->total <= 0) {
                throw new AppException("Sorry, there are no vehicles available between these dates.");
            }

            // Set up the date to and from so we can calculate total rate
            // across the day(s) the booking is for
            $dateFrom = new DateTime($basketItem->dateFrom);
            $dateTo = new DateTime($basketItem->dateTo);           
            $dateBooked = $dateFrom;

            $basketItem->totalRate = 0.0;

            do
            {
                // Add rate to total rate for every day
                $basketItem->totalRate = $basketItem->totalRate + $basketItem->dailyRate;
                $dateBooked->add(new DateInterval("P1D"));
            } while($dateBooked <= $dateTo);

            // Set passenger no
            $basketItem->passengerNo = intval(getPostFieldValue("passengerNo", true));
    
            // Handle scenario where number of passengers is more than
            // the capacity of this vehicle model
            if($basketItem->passengerNo > $vehicleModel->maxNoOfPassengers) {
                throw new AppException("No of Passengers exceeded maximum number of passengers permitted for this vehicle.");
            }

            // Set last remaining details for this basket item
            $basketItem->isSelfDriving = getPostFieldValue("isSelfDriving", false) == "Yes";
            $basketItem->preferredDriver = getPostFieldValue("preferredDriver", false);
    
            // Add this basket item to the basket item array in session
            addToBasket($basketItem);
              
            // Item added to basket, return the customer to where they came from
            // if the url is set, otherwise encourage them to browse for more items.
            if($url == "") {
                header("Location: browse.php?revisit=1&addedToBasket=1");
            }
            else {
                header("Location: $url?addedToBasket=1");
            }
            die();   
        }
        catch(AppException $ae) {
            // Enable the view to surface our own app exception messages
            $processingMessage = $ae->getMessage();
        }
    }

    // Continue with page load, this is either a new add basket request,
    // or a post which failed (above) to add to the basket.

    // Get the request vehicle model id
    $vehiceModelId = intval(getRequestFieldValue("vehicleModelId", false, "0"));

    // Turn the customer away from this page if there is no vehicle model id (none selected)
    if($vehiceModelId == 0) {
        if($url == "") {
            header("Location: browse.php");
        }
        else {
            header("Location: $url");
        }
        die();
    }

    // We are good to go, get the vehicle model from the db
    $vehicleModel = BookingDatabase::getInstance()->getVehicleModel($vehiceModelId);

    // Get any requested promotion id
    $promotionId = intval(getRequestFieldValue("promotionId", false, "0"));

    // If there is a promotion, get it from the db
    $promotion = null;
    if($promotionId > 0) {
        $promotion = BookingDatabase::getInstance()->getPromotionById($promotionId);
        $vehicleModel->dailyRate = $promotion->dailyRate;
    }

    // If there is a vehicleModelQuery in session, get this data
    // so we can prefill the form, otherwise create an empty query object
    if(!isset($_SESSION["vehicleModelQuery"])) {
        $vehicleModelQuery = new VehicleModelQuery();
    }    
    else {
        $vehicleModelQuery = $_SESSION["vehicleModelQuery"];
    }
    
    // Create a wrapper object for the view to prefill the form
    // since we don't always have a vehicleModelQuery object
    $basketAddForm = new BasketAddForm();

    if (isPostBackWithField("addBookingItemAttempt")) { // We've fallen through add booking item, prefill the user's form values
        $basketAddForm->placeFrom = getPostFieldValue("placeFrom", false, $vehicleModelQuery->placeFrom);
        $basketAddForm->placeTo = getPostFieldValue("placeTo", false, $vehicleModelQuery->placeTo);
        $basketAddForm->dateFrom = getDateInMySQLFormat(getPostFieldValue("dateFrom", false));
        $basketAddForm->dateTo = getDateInMySQLFormat(getPostFieldValue("dateTo", false));
        $basketAddForm->passengerNo = intval(getPostFieldValue("passengerNo", false));
        $basketAddForm->preferredDriver = getPostFieldValue("preferredDriver", false);
        $basketAddForm->isSelfDriving = getPostFieldValue("isSelfDriving", false) == "Yes";
    }
    else { // Treat as a GET request
        if(!$isDirect) { // Treat as a Add Basket request from Browse.php
            $basketAddForm->dateFrom = $vehicleModelQuery->dateFrom;
            $basketAddForm->dateTo = $vehicleModelQuery->dateTo;
            $basketAddForm->passengerNo = $vehicleModelQuery->passengerNo;
            $basketAddForm->isSelfDriving = $vehicleModelQuery->licenceCategoryId > 0;
        }
        else { // Treat as a Add Basket request from Index.php
            $basketAddForm->isSelfDriving = true;
        }
    }

    require_once("includes/header.php");

    require_once("view/basket_add_view.php");

    require_once("includes/footer.php");

?>