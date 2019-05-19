<?php
    require_once("imports.php");

    // Get any requested return url
    $url = getRequestFieldValue("url", false);

    // Get any requested cancel url
    $urlFrom = getRequestFieldValue("from", false);

    // Initialise the sign up message for the view
    $signUpMessage = "";
    
    // If this is a post back request to register a new customer
    if (isPostBackWithField("registerCustomerAttempt")) {

        // Create a new customer object
        $customer = new Customer();
        $customer->firstName = getPostFieldValue("firstName", true);
        $customer->lastName = getPostFieldValue("lastName", true);
        $customer->emailAddress = getPostFieldValue("emailAddress", true);
        $clearPassword = getPostFieldValue("password", true);
        $customer->password = md5($clearPassword); // Hash the password
        $customer->companyName = getPostFieldValue("companyName", true);
        $customer->phoneNo = getPostFieldValue("phoneNo", true);
        $customer->isAdministrator = false;

        // Catch any of our own app exceptions
        try
        {
            // Try to add the new customer to the db
            BookingDatabase::getInstance()->addCustomer($customer);

            // Call model/userAuthentication.php function to login the customer
            loginUser($customer->emailAddress, $clearPassword);

            // Redirect the customer to the return url 
            // otherwise redirect them to the home page
            if($url == "") {
                header("Location: index.php");
            }
            else {
                header("Location: $url");
            }
            die();            
        }
        catch(AppException $ae) {
            // Surface our app exception e.g. customer with email address already exists
            // to our view
            $signUpMessage = $ae->getMessage();
        }            
    }

    require_once("includes/header.php");

    require_once("view/signup_view.php");

    require_once("includes/footer.php");

?>