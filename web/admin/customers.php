<?php

    require_once("../imports.php");

    // Restrict page to users in the administrator role
    restrictPageToAdministrators();
    
    // Initialise delete customer message for the view
    $onCustomerDeletedMessage = "";

    // If this is a post back request attempting to delete a customer
    if (isPostBackWithField("deleteCustomerAttempt")) {

        // Get the customer id to delete
        $deleteCustomerId = getPostFieldValue("deleteCustomerId", true);

        // Check: if this customer is the current user, do NOT delete the customer
        if($authUser->id == $deleteCustomerId) {
            $onCustomerDeletedMessage = "Just don't delete the current Customer!";
        }
        else {
            // Otherwise
            try{
                // Delete the customer from the db
                BookingDatabase::getInstance()->deleteCustomer($deleteCustomerId);

                // Surface a delete message for the view
                $onCustomerDeletedMessage = "Customer successfully deleted";
            }
            catch(PDOException $pex) {
                // Handle any PDO exception by surfacing it to the view
                $onCustomerDeletedMessage = $pex->getMessage();
            }

        }
    }

    // Continue loading the page

    // Get a list of customers from the db
    $customers = BookingDatabase::getInstance()->getAllCustomers();

    require_once("includes/admin_header.php");
       
    require_once("view/customers_view.php");

    require_once("includes/admin_footer.php");

?>