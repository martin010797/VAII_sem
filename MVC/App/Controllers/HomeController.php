<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Model;
use App\MovieInfo;
use App\SeriesInfo;
use App\App;

class HomeController extends AControllerBase
{

    public function index()
    {
        $allItems = [];
        $allItems['movie'] = MovieInfo::getRecentlyAddedItems();
        $allItems['series'] = SeriesInfo::getRecentlyAddedItems();
        return $this->html($allItems);
    }

    public function insert()
    {
        if (!$this->app->getAuth()->isMaintainer()){
            return $this->redirect("?c=auth&a=login");
        }else{
            $itemValidation = null;
            $item = null;
            if (isset($_POST['submit'])) {
                $imageName = $_FILES['image']['name'];

                $title = $_POST["title"];
                $description = $_POST["popis_prvku"];


                if ($_POST['type'] == 'm'){
                    $duration = $_POST["duration"];

                    $itemValidation = DetailController::validation($title, $description, null, $duration);
                    //ak presiel validaciou tak moze ulozit
                    if ($itemValidation == null){
                        $movie = new MovieInfo($title, $description, $duration, $imageName);
                        $movie->saveMovie();
                        header("Location: http://localhost/VAII_sem/MVC?c=Movies");
                        die();
                    }else{
                        $item = [];
                        $item[] = $title;
                        $item[] = $description;
                        $item[] = "m";
                        $item[] = $duration;
                        return $this->html([$item, $itemValidation]);
                    }
                }
                if ($_POST['type'] == 's'){
                    $numberOfSeasons = $_POST['numbOfSe'];

                    $itemValidation = DetailController::validation($title, $description, $numberOfSeasons, null);
                    //ak presiel validaciou tak moze ulozit
                    if ($itemValidation == null){
                        $series = new SeriesInfo($title, $description, $numberOfSeasons, $imageName);
                        $series->saveSeries();
                        header("Location: http://localhost/VAII_sem/MVC?c=Series");
                        die();
                    }else{
                        $item = [];
                        $item[] = $title;
                        $item[] = $description;
                        $item[] = "s";
                        $item[] = $numberOfSeasons;
                        return $this->html([$item, $itemValidation]);
                    }
                }
            }
            return $this->html();
        }
    }

    public function search(){
        if (isset($_POST['search'])) {
            $allItems = [];
            $allItems['movie'] = MovieInfo::searchMovies($_POST['text']);
            $allItems['series'] = SeriesInfo::searchSeries($_POST['text']);
            return $this->html($allItems);
        }
    }




}