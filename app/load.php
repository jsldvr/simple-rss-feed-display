<?php

/**
 * Load the website
 * 
 * Loads all necessary files for the website to run. 
 * 
 * @package RSS News Feed Reader
 * @version 1.0.0
 */



class Load
{

    /** 
     * Load the application
     * 
     * @return void
     */
    public function Init()
    {
        // generate a session id for the user
        session_start();

        // try/catch
        try {
            $this->Config();
            $this->Functions();
            $this->Website();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /** 
     * Load the configuration dir/files 
     */
    public function Config()
    {
        $this->Require('app/config', 'config');

        $config = new Config();
        $config->Init();
    }

    /**
     * Loads the necessary functions for the application.
     */
    public function Functions()
    {
        $this->Require('app/utils', 'func');
    }

    /** 
     * Load the  web interface 
     */
    public function Website()
    {
        $this->Require('app/views', 'home');
    }

    /**
     * Safely require a file.
     */
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
