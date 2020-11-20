
<!DOCTYPE html>
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

<nav class="navbar navbar-expand-lg bg-dark navbar-dark fixed-top">
    <a class="navbar-brand justify-content-center" href="?c=Home">What to watch</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar, #rightSideBar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-light" href="?c=Home">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="?c=Movies">Movies</a>
            </li>
            <li class="nav-item">
                <a class=" nav-link text-light" href="?c=Series">Series</a>
            </li>
            <li class="nav-item">
                <a class=" nav-link text-light" href="?c=Home&a=Insert">Insert item</a>
            </li>
        </ul>
    </div>

    <div class="collapse navbar-collapse" id="rightSideBar">
        <form id="searchBar" class="form-inline" action="#">
            <input class="form-control mr-sm-2" type="text" placeholder="Search">
            <button class="btn btn-info" type="submit">Search</button>
        </form>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link text-light" href="#">Sign up</a>
            </li>
            <li class="nav-item">
                <a class=" nav-link text-light" href="#">Login</a>
            </li>
            <li class="nav-item">
                <a class=" nav-link text-light" href="#">FAQ</a>
            </li>
        </ul>
    </div>

</nav>



<div class="web-content pt-5">
    <?= $contentHTML ?>
</div>


</body>
</html>