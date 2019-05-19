<?php
    session_start();

    function ensureAuthentication() {

        if (!isPostBackWithField("signinAttempt")) {
            return;
        }       

        $emailAddress = getPostFieldValue("emailAddress", true);
        $password = getPostFieldValue("password", true);

        loginUser($emailAddress, $password);
    }

    function loginUser($emailAddress, $password) {

        $_SESSION["authUser"] = new User();

        $users = BookingDatabase::getInstance()->getUsers($emailAddress, md5($password));

        if($users == null || sizeof($users) == 0) {
            header("Location: signin.php?failed=1");
            die();
        }

        $user = $users[0];

        $user->isSignedIn = true;

        $_SESSION["authUser"] = $user;
    }

    function getFailedAuthenticationMessage() {

        $failedCode = isset($_GET["failed"]) ? intval($_GET["failed"]) : 0;

        switch($failedCode) {
            case 1:
                return "Email Address or Password incorrect.";
            default:
                return "";
        }
    }

    function signOutAuthenticatedUser($url = "index.php") {
        session_destroy();
        header("Location: $url");
        die();
    }
    
    ensureAuthentication();
    $authUser = isset($_SESSION["authUser"]) ? $_SESSION["authUser"] : new User();   

    BookingDatabase::getInstance()->addLog($authUser, $_SERVER["PHP_SELF"]);

    function restrictPageToAdministrators($redirectToPage = "") {
        global $authUser;
        if($authUser->isAdministrator) {
            return;
        }
        if($redirectToPage == "") {
            echo "Admin Access denied";
            die();
        }
        header("Location: $redirectToPage");
        die();
    }

    function restrictPageToSignedInUsers($redirectToPage = "index.php") {
        global $authUser;
        if($authUser->isSignedIn) {
            return;
        }
        if($redirectToPage == "") {
            echo "Access denied";
            die();
        }
        header("Location: $redirectToPage");
        die();
    }
?>