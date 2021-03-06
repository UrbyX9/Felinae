<?php 
    // number of displayed products per page
    $num_of_product_per_page = 12;
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

    #$starts_from = ($current_page-1)*$num_of_product_per_page;

    $total_pages = ceil($total_products/$num_of_product_per_page);
?>

<?=template_header('Products')?>
<?=template_products($products)?>
<?=pagination($current_page, $total_pages, $page)?>

<?=template_footer()?>