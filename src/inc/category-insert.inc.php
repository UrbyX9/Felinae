<?php
    if(!empty($_POST['Submit']) || isset($_POST['Submit'])) {
        $category = xss_cleaner($_POST['category']);

        if($_POST['parent_category'] === '') {
            $parent_id = null;
            echo "Null asigned";
        } else {
            $parent_id = $_POST['parent_category'];
            echo $parent_id;
        }
        $slug = slugify($category);

        echo $category . " ".  $parent_id;

        $query = "INSERT INTO category(category, slug, parent_id) VALUES(?,?,?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$category, $slug, $parent_id]);

        header("Location: ./index.php?page=category-add");
        exit;

    } else {
        header("Location: ./index.php?page=category-add&status=err");
        exit;
    }

?>