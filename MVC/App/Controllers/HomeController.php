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
        $allItems['movie'] = MovieInfo::getRecentlyAddedItems();
        $allItems['series'] = SeriesInfo::getRecentlyAddedItems();
        //$allItems['alert'] = null;
        return $allItems;
    }

    /*public function alert(){
        $allItems = [];
        $allItems['movie'] = MovieInfo::getRecentlyAddedItems();
        $allItems['series'] = SeriesInfo::getRecentlyAddedItems();
        $allItems['alert'] = "nejaky alert";
        return $allItems;
    }*/

    public function insert()
    {
        $itemValidation = null;
        $item = null;
        if (isset($_POST['submit'])) {

            $image = addslashes($_FILES['image']['tmp_name']);
            $image = file_get_contents($image);
            $image = base64_encode($image);

            $title = $_POST["title"];
            $description = $_POST["popis_prvku"];


            if ($_POST['type'] == 'm'){
                $duration = $_POST["duration"];

                $itemValidation = DetailController::validation($title, $description, null, $duration);
                //ak presiel validaciou tak moze ulozit
                if ($itemValidation == null){
                    $movie = new MovieInfo($title, $description, $image, $duration);
                    $movie->saveMovie();
                    //header("Location: http://localhost/VAII_sem/MVC?c=Home");
                    header("Location: http://localhost/VAII_sem/MVC?c=Home&a=alert");
                    die();
                }else{
                    $item = [];
                    $item[] = $title;
                    $item[] = $description;
                    $item[] = "m";
                    $item[] = $duration;
                    return [$item, $itemValidation];
                }
            }
            if ($_POST['type'] == 's'){
                $numberOfSeasons = $_POST['numbOfSe'];

                $itemValidation = DetailController::validation($title, $description, $numberOfSeasons, null);
                //ak presiel validaciou tak moze ulozit
                if ($itemValidation == null){
                    $series = new SeriesInfo($title, $description, $image, $numberOfSeasons);
                    $series->saveSeries();
                    header("Location: http://localhost/VAII_sem/MVC?c=Home");
                    die();
                }else{
                    $item = [];
                    $item[] = $title;
                    $item[] = $description;
                    $item[] = "s";
                    $item[] = $numberOfSeasons;
                    return [$item, $itemValidation];
                }
            }
        }
        return null;
    }




}