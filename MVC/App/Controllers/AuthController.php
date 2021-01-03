<?php


namespace App\Controllers;

use App\Core\AControllerBase;

class AuthController extends \App\Core\AControllerBase
{
    /**
     * @inheritDoc
     */
    public function index()
    {
        return $this->redirect('?c=auth&a=login');
    }

    public function login(){
        //$formData = $this->app->getRequest()->getPost();
    }
}