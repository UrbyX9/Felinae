<?php

    if(isset($_POST['Submit'])){
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['password'] = $_POST['password'];
        $_SESSION['confirm_password'] = $_POST['confirm_password'];

    }

?>


<div class="container">
    <div class="my-form">
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <div class="card user-form">
                    <div class="card-header">
                        <h1 class="card-title">Registracija</h1>
                    </div>
                    <div class="card-body">
                        <form method="post" action="./index.php?page=includes/register.inc" class="content">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right" for="fname">Ime<span class="required">*</span></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="fname" id="fname" placeholder="Ime" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right" for="lname">Priimek<span class="required">*</span></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="lname" id="lname" placeholder="Priimek" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right" for="phoneNumber">Telefonska številka</label>
                                <div class="col-md-6">
                                    <input type="tel" class="form-control" name="phoneNumber" id="phoneNumber" placeholder="000-000-000" pattern="[0-9]{3}-[0-9]{3}-[0-9]{3}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <lable class="col-md-4 col-form-label text-md-right" for="address">Naslov<span class="required">*</span></lable>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="address" id="address" placeholder="Velika ulica, 4" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <lable class="col-md-4 col-form-label text-md-right" for="postalCode">Poštna številka<span class="required">*</span></lable>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="postalCode" id="postalCode" placeholder="1000" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <lable class="col-md-4 col-form-label text-md-right" for="city">Mesto<span class="required">*</span></lable>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="city" id="city" placeholder="Ljubljana" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right" for="country">Država<span class="required">*</span></label>
                                <div class="col-md-6">
                                    <select name="country" id="country" class="form-control">
                                    <?php foreach (countries() as $item): ?>
                                        <option value="<?=$item['id']?>"><?=$item['country']?></option>
                                    <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-6 offset-md-4 float-right float-sm-right">
                                <button type="submit" name="Submit" class="btn btn-primary" id="reg_btn">Registracija</button>
                            </div>

                        </form>
                    </div>

                    <div class="card-footer">
                        Že imate račun? Prijavite se: <a href="./index.php?page=login">Prijava</a>.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>