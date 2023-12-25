<?php

/**
 * Load the website
 * 
 * Loads all necessary files for the website to run, initializes the Load class, 
 * and calls the respective methods to load the application.
 * 
 * @package RSS News Feed Reader
 * @version 1.0.0
 */

class Load
{
    public function Init($config = NULL, $utils = NULL, $subs = NULL, $ctrl = NULL, $views = NULL)
    {
        $this->initSession();
        try {
            $this->initConfig($config);
            $this->initUtils($utils);
            $this->initModel($subs);
            $this->initController($ctrl);
            $this->initView($views);
        } catch (Exception $e) {
            // echo $e->getMessage();
            echo "An error occurred. Please try again later.";
        }
    }

    private function initSession()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
            session_regenerate_id(false);
        }
    }

    public function initConfig($conf)
    {
        $this->Require('app/config', 'config');
        $config = new Config();
        $config->Init($conf);
    }

    public function initUtils($util)
    {
        $this->Require('app/utils', 'index');
        $utils = new AppUtils();
        $utils->Init($util);
    }

    public function initModel($subs)
    {
        $this->Require('app/models', 'index');
        $model = new AppModel();
        $model->Init($subs);
    }

    public function initController($ctrl)
    {
        $this->Require('app/controllers', 'index');
        $controller = new AppController();
        $controller->Init($ctrl);
    }

    public function initView($views)
    {
        $this->Require('app/views', 'index');
        $views = new AppViews();
        $views->Init($views);
    }

    public static function Require($directory, $file_name)
    {
        $filePath = APP_DIR . '/' . $directory . '/' . $file_name . '.php';
        if (file_exists($filePath)) {
            require_once $filePath;
        } else {
            throw new Exception("File '$filePath' not found.");
        }
    }
}
