<?php

    if(empty($_GET['search']) && !isset($_GET['search'])) {
        header("Location: ./#");
    }

       $num_of_product_per_page = 36;
       // URL this will appear as index.php?page=products&p=1, index.php?page=products&p=2 ...
       $current_page = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;
       // select products by latest
       $stmt = $pdo->prepare('SELECT * FROM product ORDER BY publishedAt DESC LIMIT ?,?');
       // bindValue allows us to use integer in SQL, need it for LIMIT
       $stmt->bindValue(1, ($current_page - 1) * $num_of_product_per_page, PDO::PARAM_INT);
       $stmt->bindValue(2, $num_of_product_per_page, PDO::PARAM_INT);
       $stmt->execute();
       // fetch and return products as ARRAY
       $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
   
       // total amount of products
       $total_products = $pdo->query('SELECT * FROM product')->rowCount();

?>

<?=template_header("Search")?>

<?=products_form($products)?>

