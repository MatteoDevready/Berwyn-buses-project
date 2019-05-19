<?php
require_once("imports.php");

// Initialise a contact us message for the view
$contactUsMessage = "";

// If this request is a post back to submit a contact message
if (isPostBackWithField("contactAttempt")) {
    // Create a new ContactUs object
    $contactUs = new ContactUs();
    // Set the email address and message
    $contactUs->emailAddress = getPostFieldValue("emailAddress", false, $authUser->emailAddress);//if the user is not log in then the field value will be used
    //otherwise if the user is already log in this field will be the authUser email address.
    $contactUs->message = getPostFieldValue("message", true);
    // Add the contact message to the db
    BookingDatabase::getInstance()->addContactUs($contactUs);
    // Surface a success message to the view
    $contactUsMessage = "Thank you for contacting us. Your query will be processed as soon as possible.";   
}
require_once("includes/header.php");

require_once("view/contact_view.php");

require_once("includes/footer.php");

?>