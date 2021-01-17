<?php
/** @var Array $data */
?>
<link rel="stylesheet" href="MVC/public/css/login_reg_style.css">

<div id="loginRegContainer" class="container shadow-lg">
    <h2 class="text-center">Prihlásenie</h2>
    <form class="form-group" method="post" action="?c=auth&a=login">
        <div class="text-center text-danger mb-3">
            <?= @$data['message'] ?>
        </div>
        <input type="text" class="form-control mb-2" name="email" placeholder="Email">
        <input type="password" class="form-control mb-3" name="password" placeholder="Heslo">
        <button type="submit" class="btn btn-primary mb-1 shadow" name="login">Login</button>
        <button type="submit" class="btn btn-link btn-block p-0 m-0 text-right" name="signup" style="color: black">Nemáš konto?</button>
    </form>
</div>
