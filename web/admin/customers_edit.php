<?php

    require_once("../imports.php");

    // Restrict page to users in the administrator role
    restrictPageToAdministrators();
    
    // If this is a post back request attempting to edit a customer
    if (isPostBackWithField("editCustomerAttempt")) {
        
        // Get the customer to edit
        $editCustomer = BookingDatabase::getInstance()->getCustomerById(getPostFieldValue("editCustomerId", true));

        // Create a new customer object
        $customer = new Customer();

        // Set the customer details
        $customer->id = $editCustomer->id;
        $customer->firstName = getPostFieldValue("firstName", true);
        $customer->lastName = getPostFieldValue("lastName", true);
        $customer->emailAddress = getPostFieldValue("emailAddress", true);

        // If new password, use that, otherwise, use old password
        $inputPassword = getPostFieldValue("password", true);
        $customer->password = $inputPassword == "" ? $editCustomer->password : md5($inputPassword);

        $customer->companyName = getPostFieldValue("companyName", true);
        $customer->phoneNo = getPostFieldValue("phoneNo", true);
        $customer->isAdministrator = getPostFieldValue("isAdministrator", false, "No") == "Yes";
        
        // Update the customer in the db
        BookingDatabase::getInstance()->updateCustomer($customer);    

        // Return to the customers list
        header("Location: customers.php");
        die();                            
    } 
    
    // If the customer id is not set, return to the customers list
    if(!isset($_GET["id"])) {
        header("Location: customers.php");
        die(); 
    }

    // Get the customer id to edit
    $requestedCustomerId = intval($_GET["id"]);

    // Get the customer to edit from the db
    $editCustomer = BookingDatabase::getInstance()->getCustomerById($requestedCustomerId);
    
    // If not customer to edit, return to the customers list
    if($editCustomer == null) {
        header("Location: customers.php");
        die();        
    }    

    require_once("includes/admin_header.php");
    
    require_once("view/customers_edit_view.php");

    require_once("includes/admin_footer.php");

?>