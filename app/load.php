<?php

/**
 * Load the website
 */

class LoadApp
{

    public function Website()
    {
        /** Load app/html */
        require_once APP_DIR . '/app/views/home.php';
        // echo APP_DIR;
    }
}
