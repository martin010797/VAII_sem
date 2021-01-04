<?php

namespace App;

use App\Config\Configuration;
use App\Core\AAuthenticator;
use App\Core\DB\Connection;
use App\Core\Request;
use App\Core\Router;

/**
 * Class App
 * Main Application class
 * @package App
 */
class App
{
    /**
     * @var Router
     */
    private $router;

    /**
     * @var Request
     */
    private Request $request;

    private ?AAuthenticator $auth;

    /**
     * App constructor
     */
    public function __construct()
    {
        $this->router = new Router();
        $this->request = new Request();

        // Check if there is an authenticator
        if (defined('\\App\\Config\\Configuration::AUTH_CLASS')) {
            $authClass = Configuration::AUTH_CLASS;
            $this->auth = $authClass::getInstance();
        } else {
            $this->auth = null;
        }
    }

    /**
     * Runs the application
     * @throws \Exception
     */
    public function run()
    {
        ob_start();

        // get a controller and action from URL
        $this->router->processURL();

        //create a Controller and inject App into it
        $controllerName = $this->router->getFullControllerName();
        $controller = new $controllerName($this);

        // call appropriate method of the controller class
        $response = call_user_func([$controller, $this->router->getAction()]);

        // return view to user
        $response->generate();

        // if DEBUG for SQL is set, show SQL queries to DB
        if (Configuration::DEBUG_QUERY) {
            header_remove('Location');
            $queries = array_map(function ($q) {
                $lines = explode("\n", $q);
                return '<pre>' . (substr($lines[1], 0, 7) == 'Params:' ? 'Sent ' . $lines[0] : $lines[1]) . '</pre>';
            }, Connection::getQueryLog());
            echo PHP_EOL . PHP_EOL . implode(PHP_EOL . PHP_EOL, $queries) . "\n\nTotal queries: " . count($queries);
        }
    }

    /**
     * @return Router
     */
    public function getRouter(): Router
    {
        return $this->router;
    }

    /**
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

    /**
     * @return AAuthenticator|null
     */
    public function getAuth(): ?AAuthenticator
    {
        return $this->auth;
    }

}