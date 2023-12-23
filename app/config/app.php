<?php 

/**
 * App Configuration File
 *
 * This file contains the configuration settings for the app.
 * 
 * @package rssNewsFeed
 * @version 1.0.0
 * @since 1.0.0
 */

class Config {
    /**
     * @var string $title The title of the app
     */
    public static $title = 'rssNewsFeed';

    /**
     * @var string $description The description of the app
     */
    public static $description = 'A simple RSS news feed reader';

    /**
     * @var string $author The author of the app
     */
    public static $author = 'John Doe';

    /**
     * @var string $authorEmail The author's email address
     */
    public static $authorEmail = 'jorge@sldvr.com';

    /**
     * @var string $authorWebsite The author's website
     */
    public static function get_info($arg) {
        return self::$$arg;
    }

    /**
     * Retrieves the RSS feed.
     *
     * This method requires the 'get_rss.php' file.
     */
    public static function get_rss() {
        require_once('get_rss.php');
    }
}