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
        if (isset($_GET['id']) && isset($_GET['type'])) {
            if ($_GET['type'] == 'm') {
                //return MovieInfo::getOne($_GET['id'], "item_id");
                return $this->html(MovieInfo::getOne($_GET['id'], "item_id"));
            }
            if ($_GET['type'] == 's') {
                //return SeriesInfo::getOne($_GET['id'], "item_id");
                return $this->html(SeriesInfo::getOne($_GET['id'], "item_id"));
            }
        }
    }

    public function delete()
    {
        if ($_GET['type'] == 'm') {
            Model::deleteMovie($_GET['id']);
            header("Location: http://localhost/VAII_sem/MVC?c=Movies");
            die();
        }
        if ($_GET['type'] == 's') {
            Model::deleteSeries($_GET['id']);
            header("Location: http://localhost/VAII_sem/MVC?c=Series");
            die();
        }

    }

    public function edit()
    {
        $itemValidation = null;
        $item = null;
        if (isset($_POST['submit'])) {
            $image = addslashes($_FILES['image']['tmp_name']);
            $image = file_get_contents($image);
            $image = base64_encode($image);

            $title = $_POST["title"];
            $description = $_POST["popis_prvku"];


            if ($_POST['type'] == 'm') {
                $duration = $_POST["duration"];

                $itemValidation = $this->validation($title, $description, null, $duration);
                //ak presiel validaciou tak moze ulozit
                if ($itemValidation == null) {
                    $movie = new MovieInfo($title, $description, $image, $duration);
                    $movie->setId($_POST["id"]);
                    $movie->editMovie();
                    header("Location: http://localhost/VAII_sem/MVC?c=Movies");
                    die();
                } else {
                    $item = MovieInfo::getOne($_GET['id'], "item_id");
                    $item->setTitle($title);
                    $item->setDescription($description);
                    $item->setDuration($duration);
                    //return [$item, $itemValidation];
                    return $this->html([$item, $itemValidation]);
                }
            }
            if ($_POST['type'] == 's') {
                $numberOfSeasons = $_POST['numbOfSe'];

                $itemValidation = $this->validation($title, $description, $numberOfSeasons, null);
                if ($itemValidation == null) {
                    $series = new SeriesInfo($title, $description, $image, $numberOfSeasons);
                    $series->setItemId($_POST["id"]);
                    $series->editSeries();
                    header("Location: http://localhost/VAII_sem/MVC?c=Series");
                    die();
                } else {
                    $item = SeriesInfo::getOne($_GET['id'], "item_id");
                    $item->setTitle($title);
                    $item->setDescription($description);
                    $item->setNumberOfSeasons($numberOfSeasons);
                    //return [$item, $itemValidation];
                    return $this->html([$item, $itemValidation]);
                }
            }


        } else {
            if (isset($_GET['id']) && isset($_GET['type'])) {
                if ($_GET['type'] == 'm') {
                    $item = MovieInfo::getOne($_GET['id'], "item_id");
                    //return [$item, null];
                    return $this->html([$item, null]);
                    //return MovieInfo::getOne($_GET['id'], "item_id");
                }
                if ($_GET['type'] == 's') {
                    $item = SeriesInfo::getOne($_GET['id'], "item_id");
                    //return [$item, null];
                    return $this->html([$item, null]);
                    //return SeriesInfo::getOne($_GET['id'] , "item_id");
                }
            }
        }
    }

    static public function validation($title, $description, $numberOfSeasons, $duration)
    {
        //title validation
        $titleErrors = [];
        if (strlen($title) < 2) {
            $titleErrors[] = "Nazov musi mat dlzku aspon 2 znaky";
        }
        if (strlen($title) > 120) {
            $titleErrors[] = "Nazov musi byt kratsi ako 120 znakov";
        }

        //description validation
        $descriptionErrors = [];
        if (strlen($description) > 3500) {
            $descriptionErrors[] = "Popis nesmie byt dlhsi ako 3500 znakov";
        }
        if (strlen($description) < 5) {
            $descriptionErrors[] = "Popis by mal byt dlhsi ako 5 znakov";
        }

        //duration validation
        $durationErrors = [];
        if (!is_null($duration)){
            if (strlen($duration) > 20){
                $durationErrors[] = "Dlzka trvania by nemala presahovat 20 znakov";
            }
            if (strlen($duration) == 0){
                $durationErrors[] = "Dlzka trvania musi byt pri filme vyplnena";
            }
        }

        //number of seasons validation
        $nosErrors = [];
        if (!is_null($numberOfSeasons)){
            if (strlen($numberOfSeasons) > 5){
                $nosErrors[] = "Pocet serii nemoze mat viac ako 5 znakov";
            }
            if (strlen($numberOfSeasons) == 0){
                $nosErrors[] = "Pocet serii musi byt pre serial vyplneny";
            }
            if (!is_numeric($numberOfSeasons)){
                $nosErrors[] = "Pocet serii musi byt reprezentovany cislom";
            }
            $dot = strpos($numberOfSeasons, ",");
            $comma = strpos($numberOfSeasons, ".");
            if (($comma != false) || ($dot != false)){
                $nosErrors[] = "Pocet serii musi byt reprezentovany celym cislom";
            }
        }

        //returning errors if its needed
        if ((count($titleErrors) > 0) || (count($descriptionErrors) > 0) || (count($durationErrors) > 0) || (count($nosErrors) > 0)) {
            return [$titleErrors, $descriptionErrors, $durationErrors, $nosErrors];
        } else {
            return null;
        }
    }
}