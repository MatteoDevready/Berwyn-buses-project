<?php
class Module {
    private $id;
    private $name;
    private $venue;
    private $students =[];

    function __ get($name){
        return $this->$name;
    }

    function __set($name,$value) {
        $this->$name = $value;
    }

    function addStudents($student){
        $this->students[] = $student;
    }
}

?>