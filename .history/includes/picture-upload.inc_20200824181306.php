<?php
    session_start();

    function image_upload($product_id, $url, $caption, $i){
        
        include_once("./dbh.inc.php");
        $pdo = pdo_connect_mysql();
        $target_dir = "../uploads/";
        $relative_dir = "./uploads/";

        $change_name = date("Y-m-d-h-i-s")."-".$product_id."-".basename($url);
        $target_file = $target_dir . $change_name;
        $relative_file = $relative_dir . $change_name;
        
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["image"]["tmp_name"][$i]);
            if($check !== false) {
                //echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                //echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"][$i], $target_file)) {
                //vse je ok, zapišem še v bazo
                $query = "INSERT INTO product_image(product_id, image, caption) VALUES (?,?,?)";
                $stmt = $pdo->prepare($query);
                $stmt->execute([$product_id, $relative_file, $caption]);
            } 
        }
    }

?>