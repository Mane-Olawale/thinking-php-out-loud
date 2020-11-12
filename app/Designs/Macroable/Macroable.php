<?php 

namespace App\Designs\Macroable;

use Closure;
use BadMethodCallException;

class Macroable
{
    /**
     * Hold registered macros
     * 
     * @var array
     */
    protected static array $methods = [];

    /**
     * Registers a new macros(methods) to the class
     * 
     * @param string $name
     * @param Closure|Callable|string
     * @param string|null scope
     */
    public static function macro( string $name, $callable, string $scope = 'normal')
    {
        if ( !method_exists(static::class, $name) ) static::$methods[$name] = [
            'callable' => $callable,
            'scope' => $scope
        ];

    }

    /**
     * Register a static macro(method) to the class
     * 
     * @param string $name
     * @param Closure|Callable|string
     */
    public function staticMacro( string $name, $callable)
    {
        static::macro($name, $callable, 'static');
    }

    /**
     * Checks if a macro is registered
     * 
     * @param string $name
     * @return void
     */
    public static function hasMacro(string $name)
    {
        return ( isset(static::$methods[$name]) && static::$methods[$name]['scope'] === 'normal');
    }



    /**
     * Checks if a static macro is registered
     * 
     * @param string $name
     * @return void
     */
    public static function hasStaticMacro(string $name)
    {
        return ( isset(static::$methods[$name]) && static::$methods[$name]['scope'] === 'static');
    }


    /**
     * Checks if a macro is registered with any scope(normal/static)
     * 
     * @param string $name
     * @return void
     */
    public static function hasAnyMacro(string $name)
    {
        return ( isset(static::$methods[$name]) && static::$methods[$name]['scope'] === 'any');
    }

    /**
     * Handles method calls dynamically
     * 
     * @param string $name
     */
    public function __call($method, $parameters)
    {

        if (! static::hasMacro($method)) {
            throw new BadMethodCallException(sprintf(
                'Call to a static %s::%s does not exist.', static::class, $method
            ));
        }

        if (! static::hasMacro($method)) {
            throw new BadMethodCallException(sprintf(
                'Method %s::%s does not exist.', static::class, $method
            ));
        }

    }


}
