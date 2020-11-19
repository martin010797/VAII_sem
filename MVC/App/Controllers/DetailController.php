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
                return MovieInfo::getOne($_GET['id']);
            }
            if ($_GET['type'] == 's'){
                return SeriesInfo::getOne($_GET['id']);
            }
        }
    }
}