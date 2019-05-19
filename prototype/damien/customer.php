<?php

class Customer
{
    private $id;
    private $givenName;
    private $familyName;
    private $contactNo;
    private $emailAddress;
}
fgrwkufgwekuf

function __get($name)
{
    return $this->$name;
}

function __set($name, $value)
{
    $this->$name = $value;
}
?>