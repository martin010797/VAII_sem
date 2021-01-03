<?php
/** @var Array $data */
?>
<link rel="stylesheet" href="http://localhost/VAII_SEM/MVC/public/css/login_reg_style.css">

<div id="loginRegContainer" class="container shadow-lg">
    <h2 class="text-center">Login</h2>
    <form class="form-group" method="post" action="?c=auth&a=login">
        <div class="text-center text-danger mb-3">
            <?= @$data['message'] ?>
        </div>
        <input type="text" class="form-control mb-2" name="email" placeholder="Email">
        <input type="text" class="form-control mb-3" name="password" placeholder="Password">
        <button type="submit" class="btn btn-primary mb-1 shadow" name="login">Login</button>
        <button type="button" class="btn btn-link btn-block p-0 text-right" style="color: black">Forgot your password?</button>
        <button type="button" class="btn btn-link btn-block p-0 m-0 text-right" style="color: black">Don't have an account?</button>
    </form>
</div>
