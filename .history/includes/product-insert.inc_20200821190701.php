<?php

    $pdo = pdo_connect_mysql();
    if(isset($_POST['Submit'])){
        $title = $_POST['title'];
        $summary = $_POST['summary'];
        $description = $_POST['description'];
        $weight = $_POST['weight'];
        $length = $_POST['length'];
        $width = $_POST['width'];
        $depth = $_POST['depth'];
        $sku = $_POST['sku'];

        if(empty($_POST['quantity']) && !isset($_POST['quantity'])){
            $quantity = $sku;
        }
        else {
            $quantity = $_POST['quantity'];
        }

    }

?>