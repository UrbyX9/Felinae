<?php

?>

<?=template_header("Product_insert")?>

<div class="product-form">
    <div class="row">
        <div class="card user-form">
            <div class="card-header">
                <h1 class="card-title">Vnesi produkt</h1>
            </div>
            <div class="card-body">
                <form method="post" class="content">
                    <div class="form-group">
                        <label class="col-md-4 col-form-label tect-md-right" for="title">Naslov</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="title" for="title" id="title">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 col-form-label tect-md-right" for="summary">Opis</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="summary" for="summary" id="summary" maxlength="255">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

