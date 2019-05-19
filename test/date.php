<?php

    $date = "30/01/2019";
    echo DateTime::createFromFormat('d/m/Y', $date)->format('Y-m-d');
?>