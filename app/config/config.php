<?php

/**
 * Configuration
 * 
 * This class is used to configure the application and environment.
 */

class Config
{
    /** 
     * Init() and k.i.s.s.
     * 
     * The Init() method is used to initialize the application and environment.
     * 
     * @return void
     */
    public function Init()
    {
        $this->SetEnvironment();
        $this->SetDatabase();
        $this->AccessLog();
    }

    /** 
     * SetEnvironment() 
     * 
     * Checks if there's an app/data directory and the proper permissions set, if 
     * not, it creates one and sets the permissions to allow the application to 
     * write to it. The app will use app/data as a json database.
     * 
     * @return void
     */
    public function SetEnvironment()
    {
        // Define the data directory
        $dataDir = APP_DIR . '/app/data';
        // Check if the data directory exists
        if (!file_exists($dataDir)) {
            // Create the data directory
            mkdir($dataDir, 0777, true);
        }
    }

    /**
     * SetDatabase()
     * 
     * The database is a collection of json files that are used to store data. 
     * The following files must be present in the app/data directory:
     * * options.json
     * * access-log.json
     * * users.json
     * * authors.json
     * * posts.json
     * * comments.json
     * * categories.json
     * * tags.json
     */
    public function SetDatabase()
    {
        // /** options.json */
        // $options_file = APP_DIR . '/app/data/options.json';
        // if (!file_exists($options_file)) {
        //     $options = array(
        //         'site_created' => date('Y-m-d H:i:s'),
        //         'site_updated' => date('Y-m-d H:i:s'),
        //         'site_name' => 'News Feed',
        //         'site_description' => 'RSS Feed Reader PHP Application',
        //         'site_url' => 'http://localhost:8080',
        //         'site_theme' => 'default',
        //         'site_author' => 'john doe',
        //         'site_email' => 'john@doe.com',
        //         'site_twitter' => 'johndoe'
        //     );
        //     $options_json = json_encode($options, JSON_PRETTY_PRINT);
        //     file_put_contents($options_file, $options_json);
        // }

        // /** authors.json */
        // $authors_file = APP_DIR . '/app/data/authors.json';
        // if (!file_exists($authors_file)) {
        //     $authors = array();
        //     $authors_json = json_encode($authors, JSON_PRETTY_PRINT);
        //     file_put_contents($authors_file, $authors_json);
        // }

        // $authors_rss = $_SESSION['subscriptions'];

        // // if $authors_rss is not empty, add the rss feeds to the authors.json file
        // if (!empty($authors_rss)) {
        //     $authors = json_decode(file_get_contents($authors_file), true);
        //     foreach ($authors_rss as $author_rss) {
        //         $author_fqdn = parse_url($author_rss, PHP_URL_HOST);
        //         $authors[] = array(
        //             'author_id' => hash('sha256', $author_rss),
        //             'author_name' => $author_fqdn,
        //             'author_feed' => $author_rss,
        //             'author_created' => date('Y-m-d H:i:s'),
        //             'author_updated' => date('Y-m-d H:i:s')
        //         );
        //     }
        //     $authors_json = json_encode($authors, JSON_PRETTY_PRINT);
        //     file_put_contents($authors_file, $authors_json);
        // }
    }

    /**
     * AccessLog()
     * 
     * Creates the access log file if it doesn't exist and logs PHP access to 
     * the file for debugging purposes. The access log file is used to log all 
     * access to the application. This includes the user's IP address, the 
     * request method, the request URI, the HTTP referer, the user agent, and 
     * the user language. This information is used to help debug the application.
     * 
     * @return void
     */
    public function AccessLog()
    {
        // Define the access log file
        $access_log_file = APP_DIR . '/app/data/access-log.json';
        // Create the access log file if it doesn't exist
        if (!file_exists($access_log_file)) {
            $access_log = array();
            $access_log_json = json_encode($access_log, JSON_PRETTY_PRINT);
            file_put_contents($access_log_file, $access_log_json);
        }
        // Log PHP access to the access log file
        $access_log = json_decode(file_get_contents($access_log_file), true);
        // Add the access log entry
        $access_log[] = array(
            '_session_id' => $this->SetSessionId(),
            '_user_fingerprint' => $this->UserFingerprint(),
            'datetime' => (new DateTime())->format('Ymd\THis\Z'),
            'remote_addr' => $_SERVER['REMOTE_ADDR'],
            'request_method' => $_SERVER['REQUEST_METHOD'],
            'request_uri' => $_SERVER['REQUEST_URI'],
            'http_referer' => $_SERVER['HTTP_REFERER'],
            'http_user_agent' => $_SERVER['HTTP_USER_AGENT'],
            'http_user_language' => $_SERVER['HTTP_ACCEPT_LANGUAGE'],
        );
        // Encode the access log array
        $access_log_json = json_encode($access_log, JSON_PRETTY_PRINT);
        // Save the access log file
        file_put_contents($access_log_file, $access_log_json);
    }

    /**
     * Sets the session ID if it is not already set.
     *
     * @return string The session ID.
     */
    private function SetSessionId()
    {
        // Check if the session ID is already set
        if (!isset($_SESSION['session_id'])) {
            // Set the session ID
            $_SESSION['session_id'] = session_id();
        }
        // Return the session ID
        return $_SESSION['session_id'];
    }

    /**
     * Generates a unique user fingerprint based on user data.
     *
     * @return string The generated user fingerprint.
     */
    private function UserFingerprint()
    {
        // User IP address
        $ipAddress = $_SERVER['REMOTE_ADDR'];
        // Browser/Device information
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        // Language preferences
        $language = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
        // Create a combined string
        $fingerprintString = $ipAddress . $userAgent . $language;
        // Generate a hash of the fingerprint string
        return hash('sha256', $fingerprintString);
    }
}
