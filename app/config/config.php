<?php

/**
 * Configuration
 * 
 * This class is used to configure the application and environment.
 */

class Config
{
    // Init() and k.i.s.s.
    public function Init()
    {
        $this->SetEnvironment();
        $this->SetDatabase();
        $this->CreateAccessLog();
    }

    /** 
     * SetEnvironment() 
     * 
     * Checks if there's an app/data directory and the proper permissions set, if 
     * not, it creates one and sets the permissions to allow the application to 
     * write to it. The app will use app/data as a json database.
     */
    public function SetEnvironment()
    {
        $dataDir = APP_DIR . '/app/data';
        if (!file_exists($dataDir)) {
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
        /** 
         * options.json 
         * 
         * This file is used to store the site options. The options are used to
         * configure the site and are used in the theme.
         */
        // check if the file exists, if not, create it.
        $options_file = APP_DIR . '/app/data/options.json';
        if (!file_exists($options_file)) {
            $options = array(
                'site_created' => date('Y-m-d H:i:s'),
                'site_updated' => date('Y-m-d H:i:s'),
                'site_name' => 'News Feed',
                'site_description' => 'RSS Feed Reader PHP Application',
                'site_url' => 'http://localhost:8080',
                'site_theme' => 'default',
                'site_author' => 'john doe',
                'site_email' => 'john@doe.com',
                'site_twitter' => 'johndoe'
            );
            $options_json = json_encode($options, JSON_PRETTY_PRINT);
            file_put_contents($options_file, $options_json);
        }

        /** authors.json */
        // check if the file exists, if not, create it.
        $authors_file = APP_DIR . '/app/data/authors.json';
        if (!file_exists($authors_file)) {
            $authors = array();
            $authors_json = json_encode($authors, JSON_PRETTY_PRINT);
            file_put_contents($authors_file, $authors_json);
        }
        // get the rss feeds from the session
        $authors_rss = $_SESSION['subscriptions'];
        // if $authors_rss is not empty, add the rss feeds to the authors.json file
        if (!empty($authors_rss)) {
            $authors = json_decode(file_get_contents($authors_file), true);
            foreach ($authors_rss as $author_rss) {
                $author_fqdn = parse_url($author_rss, PHP_URL_HOST);
                $authors[] = array(
                    'author_id' => hash('sha256', $author_rss),
                    'author_name' => $author_fqdn,
                    'author_feed' => $author_rss,
                    'author_created' => date('Y-m-d H:i:s'),
                    'author_updated' => date('Y-m-d H:i:s')
                );
            }
            $authors_json = json_encode($authors, JSON_PRETTY_PRINT);
            file_put_contents($authors_file, $authors_json);
        }
    }

    /**
     * CreateAccessLog()
     * 
     * Creates the access log file if it doesn't exist and logs PHP access to the file for debugging purposes.
     */
    public function CreateAccessLog()
    {
        $access_log_file = APP_DIR . '/app/data/access-log.json';
        if (!file_exists($access_log_file)) {
            $access_log = array();
            $access_log_json = json_encode($access_log, JSON_PRETTY_PRINT);
            file_put_contents($access_log_file, $access_log_json);
        }

        $access_log = json_decode(file_get_contents($access_log_file), true);
        $access_log[] = array(
            'session_id' => $this->SetSessionId(),
            'date' => date('Y-m-d H:i:s'),
            'remote_addr' => $_SERVER['REMOTE_ADDR'],
            'request_uri' => $_SERVER['REQUEST_URI'],
            'request_method' => $_SERVER['REQUEST_METHOD'],
            'user_agent' => $_SERVER['HTTP_USER_AGENT'],
            'user_language' => $_SERVER['HTTP_ACCEPT_LANGUAGE'],
            'fingerprint' => $this->UserFingerprint(),
            'referer' => $_SERVER['HTTP_REFERER'],
        );
        $access_log_json = json_encode($access_log, JSON_PRETTY_PRINT);
        file_put_contents($access_log_file, $access_log_json);
    }

    /**
     * Sets the session ID if it is not already set.
     *
     * @return string The session ID.
     */
    private function SetSessionId()
    {
        if (!isset($_SESSION['session_id'])) {
            $_SESSION['session_id'] = session_id();
        }
        return $_SESSION['session_id'];
    }

    /**
     * Generates a unique user fingerprint based on user data.
     *
     * @return string The generated user fingerprint.
     */
    private function UserFingerprint()
    {
        // Collect user data
        $ipAddress = $_SERVER['REMOTE_ADDR']; // User IP address
        $userAgent = $_SERVER['HTTP_USER_AGENT']; // Browser/Device information
        $language = $_SERVER['HTTP_ACCEPT_LANGUAGE']; // Language preferences

        // Create a combined string
        $fingerprintString = $ipAddress . $userAgent . $language;

        // Generate a hash of the fingerprint string
        return hash('sha256', $fingerprintString);
    }
}
