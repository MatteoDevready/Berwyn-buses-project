<?php

    require_once("../../web/imports.php");

    
    $firstNames = array("Gail", "Sue", "Tom", "Hamza", "Beth", "Astrid", "Keith", "Frederick", "Serena", "Waseem");
    $lastNames = array("Walker", "Baker", "Ryder", "Patel", "Bridges", "Ayel", "Cruickshank", "Metcalf", "Jones", "Ahmad");
    $companyName = array("Brooklands College", "Kingston Grammar School", "King Athelstan Primary School", "Surbiton High School", "St Luke''s C Of E Primary School", "Educare Small School", "Kings Oak Primary School", "The Kingston Academy", "Tiffin Girls' School", "Kingston Community School");
    $emailAddress = array("gail.walker@brooklands.ac.uk", 
        "sue.baker@kingstongrammarschool.ac.uk", 
        "tom.ryder@kingsathelsonprimaryschool.ac.uk", 
        "hamza@surbitanhighschool.ac.uk", 
        "beth.bridges@stlukesprimary.ac.uk", 
        "astrid.ayel@educare.ac.uk", 
        "keith@kingsoakprimary.ac.uk", 
        "frederick.metcalf@thekingstonacademy.ac.uk", 
        "serena.jones@triffingirlsschool.ac.uk", 
        "waseem.ahmad@kingstoncommunityschool.ac.uk");
    $phoneNo = array("01932 797 700", 
        "020 8546 5875", 
        "020 8546 8210", 
        "020 8546 5245", 
        "020 8546 0902", 
        "020 8547 0144", 
        "020 8942 5154", 
        "020 8546 5875", 
        "020 8546 0773", 
        "020 3108 0360");

    $address = array(array());
    

    for($i = 0; $i < 9; $i++) {
        $customer = new Customer();
        $customer->firstName = $firstNames[$i];
        $customer->lastName = $lastNames[$i];
        $customer->emailAddress = $emailAddress[$i];
        $customer->password = md5("topnotch");
        $customer->companyName = $companyName[$i];
        $customer->phoneNo = $phoneNo[$i];
        $customer->isAdministrator = false;
        
        BookingDatabase::getInstance()->addCustomer($customer);
    }
?>