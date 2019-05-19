<?php
require_once("imports.php");

// Get any requested return url
$url = getRequestFieldValue("url", false);

// Get any requested cancel url
$urlFrom = getRequestFieldValue("from", false);

// If this is a post back request to sign in...
if (isPostBackWithField("signinAttempt")) {
    //...the ensureAuthentication function in model/userAuthentication.php
    // will have tried to sign the customer in
    if($authUser->isSignedIn) { // If customer successfully signed in
        // Redirect the customer to where they came from
        // otherwise redirect them to the home page
        if($url == "") {
            header("Location: index.php");
        }
        else {
            header("Location: $url");
        }
        die();
    }
}    

// Continue loading page

// If there is a failed sign in e.g. the customer used the wrong password
// get the message and surface it to the view
$failedAuthenticationMessage = getFailedAuthenticationMessage();

require_once("includes/header.php");

require_once("view/signin_view.php");

require_once("includes/footer.php");

?>