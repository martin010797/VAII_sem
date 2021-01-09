<!DOCTYPE html>
<?php
/** @var \App\Core\AAuthenticator $auth */
?>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <title>WtW</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!--<link rel="stylesheet" href="../../public/css/main_page_style.css">-->
</head>
<body>

<nav class="navbar navbar-expand-xl bg-dark navbar-dark fixed-top">
    <a class="navbar-brand justify-content-center" href="?c=Home">What to watch</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar, #rightSideBar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-light" href="?c=Home">Domov</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="?c=Movies">Filmy</a>
            </li>
            <li class="nav-item">
                <a class=" nav-link text-light" href="?c=Series">Seriály</a>
            </li>
            <?php
            if ($auth->isLogged() && $auth->isMaintainer()) { ?>
                <li class="nav-item">
                    <a class=" nav-link text-light" href="?c=Home&a=Insert">Vložiť prvok</a>
                </li>
            <?php } ?>
        </ul>
    </div>

    <div class="collapse navbar-collapse" id="rightSideBar">
        <form id="searchBar" class="form-inline" action="#">
            <input class="form-control mr-sm-2" type="text" placeholder="Hľadať">
            <button class="btn btn-info" type="submit">Vyhľadať</button>
        </form>
        <ul class="navbar-nav ml-auto">
            <?php
            if ($auth->isLogged() && !$auth->isMaintainer()) { ?>
                <li class="nav-item">
                    <a class="nav-link text-light" href="?c=Movies&a=mymovies">Moje filmy</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="?c=Series&a=myseries">Moje seriály</a>
                </li>
            <?php } ?>
            <?php
            if (!$auth->isLogged()) { ?>
            <li class="nav-item">
                <a class="nav-link text-light" href="?c=auth&a=signup">Registrácia</a>
            </li>
            <li class="nav-item">
                <a class=" nav-link text-light" href="?c=auth&a=login">Prihlásenie</a>
            </li>
            <?php } ?>
            <?php
            if ($auth->isLogged()) {
                if ($auth->isMaintainer()){?>
                    <li class="nav-item">
                        <a class=" nav-link" style="color: dodgerblue">Správca</a>
                    </li>
                <?php }else{ ?>
                <li class="nav-item">
                    <a class=" nav-link" style="color: dodgerblue"><?= $auth->getLoggedUser()->getEmail() ?></a>
                </li>
                <?php } ?>
            <li class="nav-item">
                <a class=" nav-link text-light" href="?c=auth&a=logout">Odhlásenie</a>
            </li>
            <?php } ?>
        </ul>
    </div>

</nav>


<div class="web-content pt-5">
    <?= $contentHTML ?>
</div>


</body>
</html>