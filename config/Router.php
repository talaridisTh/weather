<?php
//use App\Controllers\HomeController;
use App\Helpers\Errors\NotFount;

require './App/Controllers/HomeController.php';
require './App/Helpers/Errors/NotFount.php';

class Router {

    /**
     * @var array
     */
    protected $routes = [];

    /**
     * Load route file
     * @param $file
     * @return static
     */
    public static function call($file)
    {
        $router = new static;
        require $file;

        return $router;
    }

    /**
     * Add route name
     * @param $routes
     */
    public function define($routes)
    {
        $this->routes = $routes;

    }

    /**
     * Load url from request
     * @param $url
     * @return false|mixed
     */
    public function from($url)
    {

        if (array_key_exists($url, $this->routes)) {
            return $this->loadAction(...explode('@', $this->routes[$url]));
        }
        (new NotFount("No route defined for this URL. " . $_SERVER['REQUEST_URI']))->throwError();

        return false;
    }

    /**
     * @param $controller
     * @param $action
     * @return mixed
     */
    protected function loadAction($controller, $action)
    {
        $controller = "App\\Controllers\\{$controller}";
        $controller = new $controller();

        return $controller->$action();
    }

}