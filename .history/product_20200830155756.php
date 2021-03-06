<?php 
    // check to make sure the id parameter is specified in the URL
    if (isset($_GET['id'])){
        // prepare statement and execute, prevents SQL injection
        $stmt = $pdo->prepare('SELECT * FROM product WHERE id = ?');
        $stmt->execute([$_GET['id']]);
        // fetch from database, return as an array
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        // check if product exist (array not empty)
        $retail_price = retail_price($_GET['id']);
        $images = get_image($_GET['id']);
        if (!$product){
            // Simple error ro display id the id doen't exist/ is empty

            die('Izdelek ne obstaja!');
        }

    } else {
        // simple error if ID wasn't specified
        die('ID izdelka ni bil definiran');
    }

?>

<?=template_header('Product')?>

<div class="row"> 
    <div class="col-12 col-sm-5 col-md-6 col-lg-5 col-xl-4 product-picture">
        <ol class="carousel-indicators">
            <?php for($i = 0; $i < count($images); $i++): ?>
            <li data-target="#carouselIndicators" data-slide-to="<?=$i?>"></li>
            <?php endfor; ?>
        </ol>
        <div id="carouselIndicators" class="carousel slide" data-ride="carousel">

            

            <div class="carousel-inner">
                <?php foreach($images as $key => $image): 
                    if($key === array_key_first($images)):?>
                    <div class="carousel-item active">
                    <?php else: ?>
                    <div class="carousel-item">
                    <?php endif; ?>
                        <img class="d-block w-100" src="<?=$image['image']?>" alt="<?=$image['caption']?>">
                    </div>
                <?php endforeach; ?>
            </div>

            
        </div>
        <a class="carousel-control-prev carousel-control" href="#carouselIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next carousel-control" href="#carouselIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="col-12 col-sm-7 col-md-6 col-lg-7 col-xl-8 product-info">
        <h1><?=$product['title']?></h1><br/>
        <div class="product-price">
            <?php if($product['startsAt'] <= date('Y-m-d H:i:s') && date('Y-m-d H:i:s') <= $product['endsAt']): ?>
                
            <ul>
                <li class="sales-date"><?=date('j.n', strtotime($product['startsAt']))?> - <?=date('j.n', strtotime($product['endsAt']))?></li>
                <li></li>

                <li class="price"><span class="old-price"><?=$product['price']?>&euro;</span>
                    <span class="discount">-<?=$product['discount']?>%</span>
                </li>
                <li class="retail-price price"><?=$retail_price?>&euro;</li>
            </ul>
            <?php else: ?>
               <span class="price"><?=$retail_price?>&euro;</span>
            <?php endif; ?>
        </div>
        <!-- Form for adding product to cart -->
        <div class="card-btn">
            <form action="./index.php?page=cart" method="post">
            <?php if($product['quantity'] == 0): ?>
                <span class="quantity-limit text-danger">Zmanjkalo zalog!</span>
            <?php else: ?>
                <span class="quantity-limit "><?=$product['quantity']?>/<?=$product['sku']?></span>
            <?php endif; ?>
                <input type="number" name="quantity" value="0" min="1" max="<?=$product['quantity']?>" placeholder="Količina" required>
                <input type="hidden" name="idProduct" value="<?=$product['id']?>">
                <input type="submit" class="insert-cart" value="Dodaj v košarico" <?php if($product['quantity'] == 0){?> disabled <?php }?>>
            </form>
        </div>

        <!-- Description of product -->
        <div class="container">
            <div class="summary">
                <h2 class="segmant-name">Povzetek</h2>
                <hr class="devider">
                <?=$product['summary']?>
                <p>                
                    <ul class="measurements">
                        <?php if(!empty($product['weight'])): ?><li>Teža: <?=$product['weight']?>kg</li><?php endif; ?>
                        <?php if(!empty($product['length'])): ?><li>Dolžina: <?=$product['length']?>cm</li><?php endif; ?>
                        <?php if(!empty($product['width'])): ?><li>Širina: <?=$product['width']?>cm</li><?php endif; ?>
                        <?php if(!empty($product['depth'])): ?><li>Višina: <?=$product['depth']?>cm</li><?php endif; ?>
                    </ul>
                </p>

            </div>
        </div><br>

        <div class="container">
            <h2 class="segmant-name">Opis</h2>
            <hr class="devider">
            <div class="description whitespace">
               <?=$product['content']?>
            </div>
        </div>  
    </div>

</div>

<h1>Komentarji</h1>
<hr class="page-division"/>
<div class="row">
    <div class="card text-center">
        <div class="col-12">
            <h3 class="card-title">Komentiraj</h3>
        </div>
        <div class="card-body">
            <form action="./index.php?page=includes/review-insert.inc" method="post">
                <input type="hidden" name="product_id" value="<?=$_GET['id']?>">
                <select name="rating" class="form-control">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                <br/>
                <textarea class="form-control" name="comment" cols="18" row="4" id="comment" placeholder="Komentar..." required></textarea>
            </form>
        </div>
    </div>
</div>


<?=template_footer()?>