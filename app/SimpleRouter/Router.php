<?php 

/**
 * @author Ilesanmi Olawale Adedotun
 */
namespace App\SimpleRouter;

class Router
{
    private $routes;


    /**
     * Load routes to the router
     * 
     * @param array $routes
     * 
     * @return void
     */
    public function load( array $routes )
    {
        $this->routes ? ( $this->routes + $routes ) : ($this->routes = $routes);
    }


    /**
     * remove a route or routes from the router
     * 
     * @param array $routes
     * 
     * @return void
     */
    public function remove( $key ) : void
    {
        if ( is_array($key)){
            foreach ($key as $value) {
                $this->unset($value);
            }
        }else{
            $this->unset($key);
        }


    }


    /**
     * remove a route from the router
     * 
     * @param array $routes
     * 
     * @return void
     */
    private function unset( string $key ) : void
    {
        if ( isset($this->routes[$key]) ) unset( $this->routes[$key] );
    }



    /**
     * Dispath the route to the browser
     * 
     * @param array $routes
     * 
     * @return void
     */
    public function dispatch( string $path )
    {
        $path = trim( $path, '/');

        foreach ($this->routes as $route => $controller) {
            if ( $path === trim($route, '/') && is_file($controller) ) {

                require_once $controller;
                return;

            }
        }

        echo '<h1>Page Not Found</h1>';
    }

}
