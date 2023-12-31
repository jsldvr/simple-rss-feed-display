<?php

/**
 * Cron Script
 * 
 * This script will check if crontab -e is set up correctly. If so, then it will 
 * do nothing. If not, then it will setup the crontab -e for you. The crontab -e 
 * will run the cron.php script at 12 AM and PM every day.
 *
 * @package Cron
 */

// if APP_DIR is not defined, define it
if (!defined('APP_DIR')) {
    define('APP_DIR', dirname(dirname(__FILE__)));
}

function Cron()
{
    // // Get the current crontab -e
    // $crontab = shell_exec('crontab -l');
    // // Check if the crontab -e is set up correctly
    // if (strpos($crontab, 'php ' . APP_DIR . '/app/utils/cron.php') === false) {
    //     // Set up the crontab -e
    //     shell_exec('(crontab -l ; echo "0 0,12 * * * php ' . APP_DIR . '/app/utils/cron.php") | crontab -');
    // }

    /**  */
}

Cron();
