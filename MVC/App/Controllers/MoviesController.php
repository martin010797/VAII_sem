<?php


namespace App\Controllers;


use App\Core\AControllerBase;
use App\MovieInfo;

class MoviesController extends AControllerBase
{

    public function index()
    {
        //return MovieInfo::getAll();
        return $this->html(MovieInfo::getAll());
    }
}