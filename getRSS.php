<?php

/**
 * Retrieves RSS feed from the specified URL and returns an array of posts.
 *
 * @param string $url The URL of the RSS feed.
 * @return array An array of posts, each containing title, description, link, and publication date.
 */
function retrieveRSS($url) {
    // Retrieve the RSS feed
    $rss = simplexml_load_file($url);
    // Create an array to store the posts
    $posts = [];
    // Loop through each item in the RSS feed
    foreach ($rss->channel->item as $item) {
        // Format the publication date
        $pubDate = date_create((string)$item->pubDate);
        // Set the time zone to Central
        $pubDate->setTimezone(new DateTimeZone('America/Chicago'));
        // Format the date to YYYY-MM-DD HH:MM:SS
        $formattedDate = date_format($pubDate, 'Y-m-d H:i:s');
        // Create an array to store the post
        $post = [
            'title' => (string)$item->title,
            'description' => (string)$item->description,
            'link' => (string)$item->link,
            'pubDate' => $formattedDate
        ];
        // Add the post to the array of posts
        $posts[] = $post;
    }
    // Return the array of posts
    return $posts;
}

// Array of RSS feed URLs
$feedURLs = [
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

// Array to store all posts
$allPosts = [];

// Retrieve and merge posts from all feeds
foreach ($feedURLs as $url) {
    $posts = retrieveRSS($url);
    $allPosts = array_merge($allPosts, $posts);
}

// check if `app/data/` directory exists
if (!file_exists('app/data/')) {
    // if not, create it
    mkdir('app/data/', 0777, true);
}

// Save the posts in a JSON file
$jsonData = json_encode($allPosts, JSON_PRETTY_PRINT);
$file = 'app/data/posts.json';

file_put_contents($file, $jsonData);

// echo "RSS feeds retrieved and saved successfully to $file";
?>
