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
    /** 
     * Load the application
     * 
     * @return void
     */
    public function Init($subscriptions)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
            session_regenerate_id(false);
        }
        try {
            $this->Config();
            $this->Feed($subscriptions);
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
     * Sanitize and validate the feed content.
     * 
     * Session Data Validation: Storing $subscriptions directly in the session 
     * without any validation or sanitization could pose a risk, depending on 
     * how this data is used later.
     */
    protected function Feed($subscriptions)
    {
        // check if $subscriptions is an array and not empty
        if (!is_array($subscriptions) || empty($subscriptions)) {
            throw new Exception('No subscriptions found.');
        }
        // Review the $subscriptions array and validate each feed url.
        foreach ($subscriptions as $key => $value) {
            // check if the feed url is a string
            if (!is_string($value)) {
                throw new Exception('Invalid feed url.');
            }
            // check if the feed url is a valid url
            if (!filter_var($value, FILTER_VALIDATE_URL)) {
                throw new Exception('Invalid feed url.');
            }
        }
        // store the subscriptions in the session
        $_SESSION['subscriptions'] = $subscriptions;
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
