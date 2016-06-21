<?php

class App
{
    
    //default controller and default method
    protected $controller = 'home';
    protected $method = 'index';

    protected $params = [];

    public function __construct()
    {
        echo 'App Running...';
        //parse our URL
        $this->parseUrl();

    }

    public function parseUrl() {
        //expose and trim a sanitized URL to extract:
        //controller
        //method
        //parameters

        //GET is a 'super global'?
        if(isset($_GET['url'])) {
            echo $_GET['url'];
        }
    }

}