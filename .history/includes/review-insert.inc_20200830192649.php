<?php

    if(isset($_POST['Submit'])) {
        print_r($_SESSION);

        $product_id = $_POST['product_id'];
        if(!user_login_status()) {
           echo "error";
            #header("Location: ./index.php?page=product&id=$product_id");
        }

        $rating = $_POST['star'];
        $comment = $_POST['comment'];
        $acount_id = $_POST['user_id'];

        echo $rating;
        echo

        $query = "INSERT INTO review(comment, rating, product_id, account_id)
            VALUES(?,?,?,?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$comment, $rating, $product_id, $account_id]);

       #header("Location: ./index.php?page=product&id=$product_id");
       #exit();

    }
?>