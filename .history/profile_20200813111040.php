<?php
    if(empty($_SESSION['loggedin']) && empty($_SESSION['user_id']) && !isset($_SESSION['loggedin']) && !isset($_SESSION['user_id']) && $_SESSION['loggedin'] !== true){
        header("Location: ./index.php?page=login");
        exit();
    }

    $id = (int)$_SESSION['user_id'];

    $query = "SELECT * FROM account a INNER JOIN city c ON a.city_id = c.id 
        INNER JOIN country co ON c.country_id = co.id
        WHERE a.id = ?";

    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<?=template_header("Profile")?>

<div class="my-form">
    <div class="row justify-content-center">
        <div class="col-sm-8">
            <div class="card user-form">
                <div class="card-header">
                    <h1 class="card-title">Profil</h1>
                </div>
                <div class="card-body">
                    <form method="post" class="content">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="fname">Ime</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="fname" id="fname" value="<?=$result['firstName']?>" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="lname">Priimek</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="lname" id="lname" value="<?=$result['lastName']?>" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="phone_number">Telefonska številka</label>
                            <div class="col-md-6">
                                <input type="tel" class="form-control" name="phone_number" id="phone_number" value="<?=$result['phoneNumber']?>" pattern="[0-9]{3}-[0-9]{3}-[0-9]{3}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <lable class="col-md-4 col-form-label text-md-right" for="address">Naslov</lable>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="address" id="address" value="<?=$result['address']?>" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <lable class="col-md-4 col-form-label text-md-right" for="postal_code">Poštna številka</lable>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="postal_code" id="postal_code" placeholder="1000" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <lable class="col-md-4 col-form-label text-md-right" for="city">Mesto</lable>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="city" id="city" placeholder="Ljubljana" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="country">Država</label>
                            <div class="col-md-6">
                                <select name="country" id="country" class="form-control">
                                <?php foreach (countries() as $item): ?>
                                    <option value="<?=$item['id']?>"><?=$item['country']?></option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" name="Submit" class="btn btn-primary" id="reg_btn">Registracija</button>
                        </div>

                    </form>
                </div>

                <script src="./js/pass-match.js"></script>

                <div class="card-footer">
                    Že imate račun? Prijavite se: <a href="./index.php?page=login">Prijava</a>.
                </div>
            </div>
        </div>
    </div>
</div>
