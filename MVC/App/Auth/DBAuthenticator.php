<?php


namespace App\Auth;

use App\Core\AAuthenticator;
use App\Models\User;

class DBAuthenticator extends AAuthenticator
{

    public function __construct()
    {
        session_start();
    }

    function login($userLogin, $pass)
    {
        $foundUser = User::getAllWhere("email = ?",[$userLogin]);

        if (count($foundUser) == 1){
            $foundUser = $foundUser[0];
            //if ($pass == $foundUser->getPassword()){
            if (password_verify($pass, $foundUser->getPassword())){
                $_SESSION['user'] = $foundUser;
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function signup($email, $password){
        $foundUser = User::getAllWhere("email = ?",[$email]);
        if (count($foundUser) == 0) {
            //ak este takz nikto zaregistrovany nie je
            $user = new User("",$email, $password, 0);
            $user->signupUser();
            return true;
        }else{
            //niekto uz taky email pouziva
            return false;
        }
    }

    function logout()
    {
        if (isset($_SESSION["user"])){
            unset($_SESSION["user"]);
            session_destroy();
        }
    }

    function getLoggedUser(): User
    {
        return $_SESSION['user'];
    }

    function isLogged()
    {
        return isset($_SESSION['user']) && $_SESSION['user'] != null;
    }

    function isMaintainer()
    {
        if (isset($_SESSION['user']) && $_SESSION['user'] != null){
            $user = $_SESSION['user'];
            if ($_SESSION['user']->getMaintainer() == 1){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}