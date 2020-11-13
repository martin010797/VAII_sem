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

    <link rel="stylesheet" href="css/main_page_style.css">
</head>
<body>

<?php
require 'MovieInfo.php';
require 'DBStorage.php';

$storage = new DBStorage();

//$movies = $storage->loadAllMovies();
$movies = $storage->loadRecentlyAdded();
?>

<nav class="navbar navbar-expand-lg bg-dark navbar-dark fixed-top">
    <a class="navbar-brand justify-content-center" href="#">What to watch</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar, #rightSideBar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-light" href="#">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="#">Movies</a>
            </li>
            <li class="nav-item">
                <a class=" nav-link text-light" href="#">Series</a>
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

<div class="jumbotron text-center shadow">
    <h2>What to watch</h2>
    <p>Welcome to the app for creating lists of your favorite movies and series.</p>
    <p>Makes it easier to decide what to watch.</p>
</div>

<div class="container">
    <h2>Recently added movies</h2>
    <div class="row bg-secondary text-light">
        <?php
        /** @var MovieInfo $movie */
        foreach ($movies as $movie) {
            echo '<div class="col-md border pt-3">';
            //echo '<img src="images/hp6thumbnail.jpeg" class="img-thumbnail" alt="Cinque Terre">';
            if (is_null($movie->getImage())){
                echo '<img src="images/no_image.png" class="img-thumbnail" alt="Cinque Terre">';
            }else{
                echo '<img src=data:image;base64,' . $movie->getImage() . ' class="img-thumbnail" alt="Cinque Terre">';
            }
            echo '<h3><a href="#">' . $movie->getTitle() . '</a>';
            echo '</h3>';
            //echo '<p>' . $movie->getDescription() . '</p>' ;
            echo '<p>' . substr($movie->getDescription(), 0, 380) . '...</p>' ;
            echo "</div>";

        }
        ?>
    </div>


</div>

<div class="container">
    <h2>Recently added series</h2>

    <div class="row bg-secondary text-light">
        <div class="col-md border pt-3">
            <img src="images/breakingBad.jpeg" class="img-thumbnail" alt="Cinque Terre">
            <h3><a href="#">Breaking bad</a>
            </h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sed massa sit amet justo tristique interdum eget ac
                est. In quis tortor non est convallis porta. Maecenas ut faucibus lacus. Vestibulum ac arcu imperdiet, volutpat
                justo a, malesuada elit.
            </p>
        </div>
        <div class="col-md border pt-3">
            <img src="images/13r.jpeg" class="img-thumbnail" alt="Cinque Terre">
            <h3><a href="#">13 reasons why</a>
            </h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sed massa sit amet justo tristique interdum eget ac
                est. In quis tortor non est convallis porta. Maecenas ut faucibus lacus. Vestibulum ac arcu imperdiet, volutpat
                justo a, malesuada elit.
            </p>
        </div>
    </div>


</div>

</body>
</html>