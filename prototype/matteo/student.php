<?php
class Student{
    private $id;
    private $givenName;
    private $familyName;

    function __get($name) {
        return $this->$name;
    }
    function __set($name,$value) {
    $this->$name = $value;
    }
    function getFullName() {
        return "$this->familyname, $this->givenName,";
    }
}
?>