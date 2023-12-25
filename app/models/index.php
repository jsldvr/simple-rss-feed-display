<?php

/**
 * Class AppModel
 * 
 * This class represents the base model for the application.
 * Add your model logic here.
 */

class AppModel
{
    // Init() function
    public function Init($subscriptions)
    {
        $this->Feed($subscriptions);
    }

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
}
