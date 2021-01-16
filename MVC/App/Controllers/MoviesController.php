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

    public function randomMovieFromList(){
        $allItems = MyMovies::getAllWhere("user_id = ?",[$_SESSION["user"]->getUserId()]);
        $size = sizeof($allItems);
        if ($size > 0){
            $item = $allItems[rand(0,($size-1))];
            $id = $item->getId();
            return $this->redirect('?c=Detail&id=' . $id . '&type=m');
        }else{
            return $this->redirect('?c=Movies&a=mymovies');
        }
    }
}