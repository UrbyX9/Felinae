<?php
    include './src/inc/dbh.inc.php';

    include_once('./src/inc/search-functions.php');
    include_once('./src/inc/picture-upload.inc.php');
    require('./src/inc/xss_cleaner.inc.php');
    
    require_once('./products-form.php');
    require_once('./send-mail.php');
    include_once('./pagination.php');

    /*function template_products($products) {
        require_once('./products-form.php');
    }*/

    function template_header($title) {
        include_once('./header.php');
    }

    function template_footer() {
        include_once './footer.php';
    }
    

    function user_login_status() {
        if(isset($_SESSION['loggedin']) && !empty($_SESSION['loggedin']) 
                && isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
            return true;
        }
        return false;
    }

    function is_admin() {
        if(isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
            return true;
        }
    }

    function countries() {
        $pdo = pdo_connect_mysql();
        $stmt = $pdo->prepare("SELECT * FROM country");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function slugify($string) {
        return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string), '-'));
    }

    function get_image($product_id) {
        $pdo = pdo_connect_mysql();
        $stmt = $pdo->prepare("SELECT * FROM product_image WHERE product_id = ?");
        $stmt->execute([$product_id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function retail_price($product_id) {
        $pdo = pdo_connect_mysql();
        $stmt = $pdo->prepare("SELECT * FROM product WHERE ID = ?");
        $stmt->execute([$product_id]);
        $product = $stmt->fetch();

        if($product['startsAt'] <= date('Y-m-d H:i:s') && date('Y-m-d H:i:s') <= $product['endsAt']){
            $retail_price = round($product['price']-($product['price']*($product['discount']/100)), 2);
        }
        else{
            $retail_price = $product['price'];
        }

        return $retail_price;

    }

    function get_review_by_procuct($product_id) {
        $pdo = pdo_connect_mysql();
        $query = "SELECT * FROM review WHERE product_id = ? ORDER BY id DESC";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$product_id]);
        $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $reviews;
    }

    function get_username($account_id) {
        $pdo = pdo_connect_mysql();
        $query = "SELECT username FROM account WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$account_id]);
        $user = $stmt->fetch();
        return $user;
    }

    function items_in_cart() {
        $items = $_SESSION['cart'];
        $num_of_items = 0;
        foreach($items as $item) {
            $num_of_items += $item[1];
        }
        return $num_of_items;
    }


    function average_rating($product_id) {
        $pdo = pdo_connect_mysql();
        $query  = "SELECT rating FROM review WHERE product_id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$product_id]);
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $i=0;
        $sum = 0;
        $average = 0;
        foreach($items as $item) {
            if($item['rating'] > 0){
                
                $i++;
                $sum += $item['rating'];
            }        
        }
        if($i!=0) $average = $sum / $i;
        return $average;
    }

 
    function all_products(){
        $pdo = pdo_connect_mysql();
        $query = "SELECT * FROM product WHERE title LIKE '%?%'";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['test']);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }   
        
    function new_products(){
        $pdo = pdo_connect_mysql();
        $query ="SELECT * FROM product ORDER BY publishedAt DESC LIMIT 6";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function best_rated(){
        $pdo = pdo_connect_mysql();
        $query ="SELECT avg(rating), product_id FROM review GROUP BY product_id ORDER BY avg(rating) DESC LIMIT 6";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function get_product($id){
        $pdo = pdo_connect_mysql();
        $query ="SELECT * FROM product WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function on_sale(){
        $pdo = pdo_connect_mysql();
        $query ="SELECT * FROM product WHERE ? BETWEEN startsAt AND endsAt;";
        $stmt = $pdo->prepare($query);
        $stmt->execute([date('Y-m-d H:i:s')]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }   

?>