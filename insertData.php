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

<form method="post" enctype="multipart/form-data">
    <br/>
        <input type="text" name="title" placeholder="Vloz nadpis" >
        <input type="text" name="description" placeholder="Vloz text" >
        <input type="file" name="image" />

        <br/><br/>
        <input type="submit" name="sumit" value="Upload" />
</form>

<?php
    if (isset($_POST['sumit'])){
        /*if (getimagesize($_FILES['image']['tmp_name']) == FALSE)
        {
            echo "Please select image";
        }*/
        //else
        //{
            $image= addslashes($_FILES['image']['tmp_name']);
            //$name= addslashes($_FILES['image']['name']);
            $image= file_get_contents($image);
            $image= base64_encode($image);
            $title= $_POST["title"];
            $description= $_POST["description"];
            $storage->save(new MovieInfo($title, $description, $image));
            //save image
        //}
    }
?>

</body>
</html>