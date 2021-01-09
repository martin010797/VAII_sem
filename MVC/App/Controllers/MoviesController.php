<?php


namespace App\Controllers;


use App\Core\AControllerBase;
use App\Models\MyMovies;
use App\MovieInfo;

class MoviesController extends AControllerBase
{

    public function index()
    {
        return $this->html(MovieInfo::getAll());
    }

    public function mymovies(){
        if (!$this->app->getAuth()->isLogged() || $this->app->getAuth()->isMaintainer()) {
            return $this->redirect('?c=home');
        }else{
            return $this->html();
        }
    }

    public function jsonMovies(){
        return $this->json(MyMovies::getAllWhere("user_id = ?",[$_SESSION["user"]->getUserId()]));
    }
}