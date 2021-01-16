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

    public function randomSeriesFromList(){
        if (!$this->app->getAuth()->isLogged() || $this->app->getAuth()->isMaintainer()) {
            return $this->redirect('?c=home');
        }else{
            $allItems = MySeries::getAllWhere("user_id = ?",[$_SESSION["user"]->getUserId()]);
            $size = sizeof($allItems);
            if ($size > 0){
                $item = $allItems[rand(0,($size-1))];
                $id = $item->getItem_Id();
                return $this->redirect('?c=Detail&id=' . $id . '&type=s');
            }else{
                return $this->redirect('?c=Movies&a=myseries');
            }
        }


    }
}