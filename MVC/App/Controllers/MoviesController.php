<?php


namespace App\Controllers;


use App\Core\AControllerBase;
use App\Models\MyMovies;
use App\MovieInfo;

class MoviesController extends AControllerBase
{

    public function index()
    {
        //return MovieInfo::getAll();
        return $this->html(MovieInfo::getAll());
    }

    public function mymovies(){
        return $this->html();
    }

    public function jsonMovies(){
        return $this->json(MyMovies::getAllWhere("user_id = ?",[$_SESSION["user"]->getUserId()]));
    }
}