<?php
    $pdo = pdo_connect_mysql();

    if(isset($_POST['Submit'])){
        $username = $_SESSION['username'];
        $email = htmlspecialchars($_SESSION['email']);
        $password = $_SESSION['password'];
        $confirm_password = $_SESSION['confirm_password'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $phone = $_POST['phone_number'];
        $address = $_POST['address'];
        $postalCode = $_POST['postal_code'];
        $city = $_POST['city'];
        $country = $_POST['country'];

        if(!empty($username) && !empty($email) && !empty($password) && 
        (strlen($password)>=8) && ($password==$confirm_password)){
            
            if(!empty($fname) && !empty($lname) && !empty($address) && 
            !empty($postalCode) && !empty($city) && !empty($country)){
                echo $fname . " " . $lname . " " . $phone . " " . $address . " " . $postalCode . " " . $city . " " . $country;
            }
            else {
                header('../index.php?page=register-personal');
                exit();
            }

        }
        else {
            header('../index.php?page=register-user');
            exit();
        }

    }

    else{
        header('../index.php?page=register-user');
        exit();
    }
    
?>