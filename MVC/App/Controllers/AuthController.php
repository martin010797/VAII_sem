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

    public function login()
    {
        //temp
        //return $this->html();
        $formData = $this->app->getRequest()->getPost();
        $logged = null;
        if (isset($formData['login'])) {
            $logged = $this->app->getAuth()->login($formData['email'], $formData['password']);
            if ($logged){
                //pokial je spravne prihlaseny tak redirectni na
                return $this->redirect('?c=home');
            }
        }

        $data = ($logged === false ? ['message' => 'Zlý email alebo heslo!'] : []);
        return $this->html($data, 'login');
    }

    public function logout(){
        $this->app->getAuth()->logout();
        return $this->redirect('?c=home');
    }
}