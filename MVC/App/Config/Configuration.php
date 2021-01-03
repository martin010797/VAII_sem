<?php

namespace App\Config;

/**
 * Class Configuration
 * Main configuration for the application
 * @package App\Config
 */
class Configuration
{
    public const DB_HOST = 'localhost';
    public const DB_NAME = 'wtw';
    public const DB_USER = 'root';
    public const DB_PASS = 'dtb456';

    public const LOGIN_URL = '/';

    public const ROOT_LAYOUT = 'root.layout.view.php';

    public const DEBUG_QUERY = false;

    private static $instance = NULL;

    /**
     * Gets olny one instance
     * @return Configuration|null
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}