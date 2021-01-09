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
        if (!$this->app->getAuth()->isLogged() || $this->app->getAuth()->isMaintainer()) {
            return $this->redirect('?c=home');
        }else{
            return $this->html();
        }
    }

    public function jsonSeries(){
        return $this->json(MySeries::getAllWhere("user_id = ?",[$_SESSION["user"]->getUserId()]));
    }
}