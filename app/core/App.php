<?php

class App
{
    protected $siteRoot = 'public';

    //default controller and default method
    protected $controller = 'home';
    protected $method = 'index';

    protected $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();

        if (!is_null($url) && !count($url) == 0) {

            //strip off the first element - depends on the hosting environment
            array_shift($url);

            if (file_exists('../app/controllers/' . $url[0] . '.php')) {

                $this->controller = $url[0];
                unset($url[0]);

            }
            require_once '../app/controllers/' . $this->controller . '.php';

            $this   ->controller = new $this->controller;

            if (isset($url[1])) {

                if (method_exists($this->controller, $url[1])) {

                    $this->method = $url[1];
                    unset($url[1]);
                }
            }

            $this->params = $url ? array_values($url) : [];
        }

        //finally, call the target method on the target controller and pass t   he parameters...
        call_user_func_array([$this->controller, $this->method], $this->params);


//        if(empty($elements[0])) {                       // No path elements means home
//            //ShowHomepage();
//            echo 'Homepage';
//        }
//        else switch(array_shift($elements))             // Pop off first item and switch
//        {
//            case 'Some-text-goes-here':
//                ShowPicture($elements); // passes rest of parameters to internal function
//                break;
//            case 'more':
//                //stuff
//            default:
//                header('HTTP/1.1 404 Not Found');
//                echo 'Error! - Not a know route.';
//            //Show404Error();
//        }
    }

    public function parseUrl()
    {

        $path = filter_var(rtrim($_SERVER['REQUEST_URI'], '/'), FILTER_SANITIZE_URL);    // Trim trailing slash(es)
        $path = ltrim($path, '/');                                                       // Trim leading slash(es)
        $elements = explode('/', $path);                                                 // Split path on slashes

        return $elements;
    }

}