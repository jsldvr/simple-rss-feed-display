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
        $dataDir = APP_DIR . '/app/.data';
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
     * 
     * @return void
     */
    public function SetDatabase()
    {
        /** options.json */
        $options_file = APP_DIR . '/app/.data/options.json';
        // check if $options_file exists, if not create it, stop
        if (!file_exists($options_file)) {
            $options = [];
            $options_json = json_encode($options, JSON_PRETTY_PRINT);
            file_put_contents($options_file, $options_json);
        }

        /** authors.json */
        $authors_file = APP_DIR . '/app/.data/authors.json';
        // check if $authors_file exists, if not create it, stop
        if (!file_exists($authors_file)) {
            $authors = [];
            $authors_json = json_encode($authors, JSON_PRETTY_PRINT);
            file_put_contents($authors_file, $authors_json);
        }

        /** posts.json */
        $posts_file = APP_DIR . '/app/.data/posts.json';
        // check if $posts_file exists, if not create it, stop
        if (!file_exists($posts_file)) {
            $posts = [];
            $posts_json = json_encode($posts, JSON_PRETTY_PRINT);
            file_put_contents($posts_file, $posts_json);
        }

        /** comments.json */
        $comments_file = APP_DIR . '/app/.data/comments.json';
        // check if $comments_file exists, if not create it, stop
        if (!file_exists($comments_file)) {
            $comments = [];
            $comments_json = json_encode($comments, JSON_PRETTY_PRINT);
            file_put_contents($comments_file, $comments_json);
        }

        /** categories.json */
        $categories_file = APP_DIR . '/app/.data/categories.json';
        // check if $categories_file exists, if not create it, stop
        if (!file_exists($categories_file)) {
            $categories = [];
            $categories_json = json_encode($categories, JSON_PRETTY_PRINT);
            file_put_contents($categories_file, $categories_json);
        }

        /** tags.json */
        $tags_file = APP_DIR . '/app/.data/tags.json';
        // check if $tags_file exists, if not create it, stop
        if (!file_exists($tags_file)) {
            $tags = [];
            $tags_json = json_encode($tags, JSON_PRETTY_PRINT);
            file_put_contents($tags_file, $tags_json);
        }

        /** users.json */
        $users_file = APP_DIR . '/app/.data/users.json';
        // check if $users_file exists, if not create it, stop
        if (!file_exists($users_file)) {
            $users = [];
            $users_json = json_encode($users, JSON_PRETTY_PRINT);
            file_put_contents($users_file, $users_json);
        }

        /** access-log.json */
        $access_log_file = APP_DIR . '/app/.data/access-log.json';
        // check if $access_log_file exists, if not create it, stop
        if (!file_exists($access_log_file)) {
            $access_log = [];
            $access_log_json = json_encode($access_log, JSON_PRETTY_PRINT);
            file_put_contents($access_log_file, $access_log_json);
        }
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
        $access_log_file = APP_DIR . '/app/.data/access-log.json';
        // if $access_log_file doesn't exist, create it via SetDatabase()
        if (!file_exists($access_log_file)) {
            $this->SetDatabase();
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
            // 'http_referer' => $_SERVER['HTTP_REFERER'],
            'http_user_agent' => $_SERVER['HTTP_USER_AGENT'],
            'http_user_language' => $_SERVER['HTTP_ACCEPT_LANGUAGE'],
            'error_message' => error_get_last(),

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
