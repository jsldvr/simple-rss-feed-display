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

/** 
 * Edit Subscriptions Here! 
 * 
 * START EDITING HERE!
 */

$subscriptions = [
    'https://feeds.feedburner.com/realclearpolitics/qlMj',
    'https://nypost.com/rss',
    'https://rss.politico.com/congress.xml',
    'https://news.yahoo.com/rss',
    'https://www.cbsnews.com/latest/rss/main',
    'https://feeds.nbcnews.com/nbcnews/public/news',
    'https://www.nationalreview.com/feed/',
    'https://thehill.com/rss/syndicator/19109',
    'https://feeds.feedburner.com/breitbart',
    'https://www.theblaze.com/rss',
    'https://thefederalist.com/feed/',
    'https://www.theepochtimes.com/feed',
    'https://www.businessinsider.com/rss',
    'https://www.military.com/rss-feeds/content?keyword=headlines&channel=news&type=news',
    'https://jonathanturley.org/rss',
    'https://rss.nytimes.com/services/xml/rss/nyt/Politics.xml',
    'https://rss.nytimes.com/services/xml/rss/nyt/Business.xml',
    'https://rss.nytimes.com/services/xml/rss/nyt/Technology.xml',
    'https://www.thefirearmblog.com/blog/feed/',
    'https://www.aol.com/rss',
    'https://www.newsweek.com/rss'
];

// STOP EDITING HERE!

/** Require once the `../app/load.php` file. */
require_once APP_DIR . '/app/load.php';

/** Instantiate the `LoadApp` class. */
$website = new Load;
$website->Init($subscriptions);
