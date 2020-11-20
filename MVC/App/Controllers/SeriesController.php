<?php


namespace App\Controllers;


use App\Core\AControllerBase;
use App\SeriesInfo;

class SeriesController extends AControllerBase
{

    public function index()
    {
        return SeriesInfo::getAll();
    }
}