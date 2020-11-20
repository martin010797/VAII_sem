<?php


namespace App\Controllers;


use App\Core\AControllerBase;
use App\Core\Model;
use App\MovieInfo;
use App\SeriesInfo;

class DetailController extends AControllerBase
{

    public function index()
    {
        if (isset($_GET['id']) && isset($_GET['type'])){
            if ($_GET['type'] == 'm'){
                return MovieInfo::getOne($_GET['id'], "item_id");
            }
            if ($_GET['type'] == 's'){
                return SeriesInfo::getOne($_GET['id'] , "item_id");
            }
        }
    }

    public function delete(){
        if ($_GET['type'] == 'm'){
            //$_GET['id']
            Model::deleteMovie($_GET['id']);
            header("Location: http://localhost/VAII_sem/MVC?c=Movies");
            die();
        }
        if ($_GET['type'] == 's'){
            Model::deleteSeries($_GET['id']);
            header("Location: http://localhost/VAII_sem/MVC?c=Series");
            die();
        }

    }

    public function edit(){
        if (isset($_POST['submit'])) {
            //ak nie je nastaveny subor
            //if ($_FILES['tmp_name'] == "")

            $image = addslashes($_FILES['image']['tmp_name']);
            $image = file_get_contents($image);
            $image = base64_encode($image);

            $title = $_POST["title"];
            $description = $_POST["description"];


            if ($_POST['type'] == 'm'){
                $duration = $_POST["duration"];
                $movie = new MovieInfo($title, $description, $image, $duration);
                $movie->setId($_POST["id"]);
                $movie->editMovie();
            }
            if ($_POST['type'] == 's'){
                $numberOfSeasons = $_POST['numbOfSe'];
                $series = new SeriesInfo($title, $description, $image, $numberOfSeasons);
                $series->setItemId($_POST["id"]);
                $series->editSeries();
            }

            header("Location: http://localhost/VAII_sem/MVC?c=Movies");
            die();
        }else{
            if (isset($_GET['id']) && isset($_GET['type'])){
                if ($_GET['type'] == 'm'){
                    return MovieInfo::getOne($_GET['id'], "item_id");
                }
                if ($_GET['type'] == 's'){
                    return SeriesInfo::getOne($_GET['id'] , "item_id");
                }
            }
        }

    }
}