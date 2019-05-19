<?php

    require_once("../imports.php");
    
    // Restrict page to users in the administrator role
    restrictPageToAdministrators();
    
    // Initialise the customer error message for the view
    $addCustomerErrorMessage = "";

    // If this is a post back request attempting to add a new customer
    if (isPostBackWithField("addCustomerAttempt")) {

        // Create a new customer object
        $customer = new Customer();

        // Set the customer details
        $customer->firstName = getPostFieldValue("firstName", true);
        $customer->lastName = getPostFieldValue("lastName", true);
        $customer->emailAddress = getPostFieldValue("emailAddress", true);
        // Hash the password
        $customer->password = md5(getPostFieldValue("password", true));
        $customer->companyName = getPostFieldValue("companyName", true);
        $customer->phoneNo = getPostFieldValue("phoneNo", true);
        $customer->isAdministrator = getPostFieldValue("isAdministrator", false, "No") == "Yes";

        try
        {
            // Add the new customer to the db
            BookingDatabase::getInstance()->addCustomer($customer);

            // Return to the customers list
            header("Location: customers.php");
            die();
        }
        catch(AppException $aex) {
            // Handle our App exceptions by surfacing a message to the view
            $addCustomerErrorMessage = $aex->getMessage();
        }            
    }

    require_once("includes/admin_header.php");
    
    require_once("view/customers_add_view.php");

    require_once("includes/admin_footer.php");

?>