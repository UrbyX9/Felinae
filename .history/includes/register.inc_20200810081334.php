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
                echo "<br> Izpis: ";
                $query = "SELECT * FROM city WHERE country_id = ? AND lower(city) LIKE lower(?) AND postalCode = ?";
                $stmt = $pdo->prepare($query);
                $stmt->execute([$country, $city, $postalCode]);
                $count = $stmt->rowCount();
                if($count < 1){
                    $query = "INSERT INTO city(city, postalCode, country_id) VALUES(?,?,?)";
                    $pdo->prepare($query)->execute([$city, $postalCode, $country]);
                }
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo "====".$result[id]."==========";
                foreach ($result as $cities) {
                    echo $cities['id']. ' ' .$cities['city']. ' ' .$cities['postalCode'] . ' '.$cities['country_id']; 
                } 

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