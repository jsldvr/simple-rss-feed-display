<?php

/**
 * RSS News Feed Reader
 * 
 * This is the public entry point for the application. It defines the root dir 
 * of the project and requires the `../app/load.php` file. 
 * 
 * @package RSS News Feed Reader
 * @version 1.0.0
 * @link https://github.com/jsldvr/simple-rss-feed-display
 * @since 1.0.0
 */

/** Define the root dir of the project. */
if (!defined('APP_DIR')) {
    define('APP_DIR', dirname(__DIR__));
}

/** Require once the `../app/load.php` file. */
require_once APP_DIR . '/app/load.php';

/** Instantiate the `LoadApp` class. */
$website = new Load;
$website->Init();
