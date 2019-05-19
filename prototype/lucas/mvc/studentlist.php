<?php
    require_once("imports.php");
    
    $results = getAllStudents();

    require_once("view/studentlist_view.php");

?>