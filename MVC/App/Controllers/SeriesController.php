<?php


namespace App\Controllers;


use App\Core\AControllerBase;
use App\Models\MySeries;
use App\SeriesInfo;

class SeriesController extends AControllerBase
{

    public function index()
    {
        return $this->html(SeriesInfo::getAll());
    }

    public function myseries(){
        return $this->html();
    }

    public function jsonSeries(){
        return $this->json(MySeries::getAllWhere("user_id = ?",[$_SESSION["user"]->getUserId()]));
    }
}