<?php
/** @var Array $data */
?>
<link rel="stylesheet" href="MVC/public/css/login_reg_style.css">

<div id="loginRegContainer" class="container shadow-lg">
    <h2 class="text-center">Registrácia</h2>
    <form class="form-group" method="post" action="?c=auth&a=signup">
        <?php if (isset($data[1][0])) {
            foreach ($data[1][0] as $error) {
                ?>
                <div class="text-danger">
                    <?= $error ?>
                </div>

            <?php }
        } ?>
        <input type="text" required class="form-control mb-2" name="email" placeholder="Email" value="<?=$data[0]?>">
        <?php if (isset($data[1][1])) {
            foreach ($data[1][1] as $error) {
                ?>
                <div class="text-danger">
                    <?= $error ?>
                </div>
            <?php }
        } ?>
        <input type="password" required class="form-control mb-2" name="password" placeholder="Heslo">
        <input type="password" required class="form-control mb-3" name="repeatPassword" placeholder="Opakované heslo">
        <button type="submit" class="btn btn-primary mb-1 shadow" name="signup">Vytvoriť konto</button>
    </form>
</div>
