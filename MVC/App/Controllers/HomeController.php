<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Model;
use App\MovieInfo;
use App\SeriesInfo;

class HomeController extends AControllerBase
{

    public function index()
    {

        $allItems = [];
        //$allItems['movie'] = MovieInfo::getAll();
        $allItems['movie'] = MovieInfo::getRecentlyAddedItems();
        //$allItems['series'] = SeriesInfo::getAll();
        $allItems['series'] = SeriesInfo::getRecentlyAddedItems();
        return $allItems;
    }

    public function insert()
    {
        if (isset($_POST['submit'])) {

            $image = addslashes($_FILES['image']['tmp_name']);
            $image = file_get_contents($image);
            $image = base64_encode($image);

            $title = $_POST["title"];
            $description = $_POST["description"];


            if ($_POST['type'] == 'm'){
                $duration = $_POST["duration"];
                $movie = new MovieInfo($title, $description, $image, $duration);
                $movie->saveMovie();
            }
            if ($_POST['type'] == 's'){
                $numberOfSeasons = $_POST['numbOfSe'];
                $series = new SeriesInfo($title, $description, $image, $numberOfSeasons);
                $series->saveSeries();
            }
            header("Location: http://localhost/VAII_sem/MVC?c=Home");
            die();
        }
    }




}