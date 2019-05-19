<?php

    // Wrapper functions for the basket item array object stored in session

    function getBasketSize() {
        if(!isset($_SESSION["Basket"])){
            $_SESSION["Basket"] = array();
        }
        return sizeof($_SESSION["Basket"]);
    }

    function addToBasket($basketItem) {
        if(!isset($_SESSION["Basket"])){
            $_SESSION["Basket"] = array();
        }

        $_SESSION["Basket"][] = $basketItem;        
    }

    function setBasketItems($basketItems) {
        $_SESSION["Basket"] = $basketItems;
    }

    function getBasketItems() {
        if(!isset($_SESSION["Basket"])){
            $_SESSION["Basket"] = array();
        }

        return $_SESSION["Basket"];
    }

    function clearBasket() {
        $_SESSION["Basket"] = array();
    }

    // Determine whether two date ranges coincide
    
    function isInDateRange($dateFrom1, $dateTo1, $dateFrom2, $dateTo2) {

        $from1 = new DateTime($dateFrom1);
        $to1 = new DateTime($dateTo1);           
        $booked1 = $from1;
        
        do
        {
            $from2 = new DateTime($dateFrom2);
            $to2 = new DateTime($dateTo2);           
            $booked2 = $from2;            
            do
            {
                if($booked1 == $booked2) {
                    return true;
                }
                $booked2->add(new DateInterval("P1D"));
            } while($booked2 <= $to2);
            $booked1->add(new DateInterval("P1D"));
        } while($booked1 <= $to1);        
        return false;
    }    

    // Shorthand means of getting POST data values

    function getPostFieldValue($fieldName, $required, $defaultValue = "") {
        if(isset($_POST[$fieldName]))
        {
            return htmlentities($_POST[$fieldName]);
        }
        if($required) {
            throw new AppException("Field $fieldName required.");
        }
        return $defaultValue;
    }

    // Shorthand means of getting REQUEST data values

    function getRequestFieldValue($fieldName, $required, $defaultValue = "") {
        if(isset($_REQUEST[$fieldName]))
        {
            return htmlentities($_REQUEST[$fieldName]);
        }
        if($required) {
            throw new AppException("Field $fieldName required.");
        }
        return $defaultValue;
    }

    function getDateInMySQLFormat($date) {
        // https://stackoverflow.com/questions/6267614/convert-uk-date-to-mysql-date
        return $date == "" ? "" : DateTime::createFromFormat('d/m/Y', $date)->format('Y-m-d');
    }

    function getDateInUKFormat($date) {
        // https://stackoverflow.com/questions/6267614/convert-uk-date-to-mysql-date
        return $date == "" ? "" : DateTime::createFromFormat('Y-m-d', $date)->format('d/m/Y');
    }    
    
    function isPostBackWithField($fieldName) {
            return $_SERVER["REQUEST_METHOD"] == "POST" && 
                isset($_POST[$fieldName]);
    }

    // From Stackoverflow, returns a JSON formatted string
    function json_response($data = null, $code = 200, $useCache = false, $message = "")
    {
        // clear the old headers
        header_remove();
        // set the actual code
        http_response_code($code);
        // set the header to make sure cache is forced
        if($useCache) {
            header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
        }
        
        // treat this as json
        header('Content-Type: application/json');
        $status = array(
            200 => '200 OK',
            400 => '400 Bad Request',
            422 => 'Unprocessable Entity',
            500 => '500 Internal Server Error'
            );
        // ok, validation error, or failure
        header('Status: '.$status[$code]);
        // return the encoded json
        return json_encode(array(
            'status' => $code,
            'message' => $message,
            'data' => $data
            ));
    }    
?>