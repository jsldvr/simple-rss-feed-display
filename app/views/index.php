<?php

class AppViews
{
    // define a theme name
    private $theme = 'default';

    // Init() function
    public function Init()
    {
        Load::Require('app/views/' . $this->theme, 'home');
    }
}
