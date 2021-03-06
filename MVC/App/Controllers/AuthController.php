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
        if ($this->app->getAuth()->isLogged()) {
            return $this->redirect('?c=home');
        }else{
            return $this->redirect('?c=auth&a=login');
        }
    }

    public function login()
    {
        if ($this->app->getAuth()->isLogged()) {
            return $this->redirect('?c=home');
        } else {
            $formData = $this->app->getRequest()->getPost();
            if (isset($formData['signup'])) {
                return $this->redirect("?c=auth&a=signup");
            }
            $logged = null;
            if (isset($formData['login'])) {
                $logged = $this->app->getAuth()->login($formData['email'], $formData['password']);
                if ($logged) {
                    //pokial je spravne prihlaseny tak redirectni na
                    return $this->redirect('?c=home');
                }
            }

            $data = ($logged === false ? ['message' => 'Zlý email alebo heslo!'] : []);
            return $this->html($data, 'login');
        }
    }

    public function signup()
    {
        if ($this->app->getAuth()->isLogged()) {
            return $this->redirect('?c=home');
        } else {
            $formData = $this->app->getRequest()->getPost();
            if (isset($formData['signup'])) {
                $userValidation = null;
                $userValidation = $this->signupValidation($formData['email'], $formData['password'], $formData['repeatPassword']);
                if ($userValidation == null) {
                    $signedUp = $this->app->getAuth()->signup($formData['email'], password_hash($formData['password'], PASSWORD_DEFAULT));
                    if ($signedUp){
                        $logged = $this->app->getAuth()->login($formData['email'], $formData['password']);
                        return $this->redirect('?c=home');
                    }else{
                        $mail = $formData['email'];
                        $emailErrors = [];
                        $passwordErrors = [];
                        $emailErrors[] = "Taký email sa už používa";
                        return $this->html([$mail, [$emailErrors, $passwordErrors]], 'signup');
                    }
                } else {
                    $mail = $formData['email'];
                    return $this->html([$mail, $userValidation], 'signup');
                }
            } else {
                return $this->html(['']);
            }
        }
    }

    public function signupValidation($email, $password, $repeatPassword)
    {
        //kontorla hesla by sa nemala asi robit tymto sposobom
        $emailErrors = [];
        $pos = strpos($email, '@');
        if ($pos === false) {
            $emailErrors[] = "Email musí obsahovať @";
        }

        $passwordErrors = [];
        if ($password != $repeatPassword) {
            $passwordErrors[] = "Heslá sa nezhodujú";
        } elseif (strlen($password) < 5) {
            $passwordErrors[] = "Heslo musí mať dĺžku aspoň 5 znakov.";
        }

        if ((count($emailErrors) > 0) || (count($passwordErrors) > 0)) {
            return [$emailErrors, $passwordErrors];
        } else {
            return null;
        }
    }

    public function logout()
    {
        $this->app->getAuth()->logout();
        return $this->redirect('?c=home');
    }
}