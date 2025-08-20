<?php

namespace App\Controllers;  
// Defines the namespace for this class (so it can be autoloaded and not conflict with other classes).

class BaseController {

    // Default properties every controller can use
    protected $viewPath = '';   // Path to the view folder related to this controller
    protected $method = 'index'; // Default method name
    protected $viewParams = [];  // Parameters passed to the view
    
    public function __construct(){
        // Runs when a controller is created
        if ( ! $this->viewPath ) { 
            // Get the name of the class that was called (e.g., HomeController)
            $classname = get_called_class();
            // Remove "Controller" and namespace prefix, leaving e.g. "Home"
            $this->viewPath = str_replace("Controller", '', str_replace("App\\Controllers\\", '', $classname ));
        };
    }

    public static function __callStatic ($method, $arg) {
        // Magic method: catches static calls to undefined methods
        $obj = new static; // Obj becomes an object of the class static
        // Try calling the method on that instance with given arguments
        $result = call_user_func_array (array ($obj, $method), $arg);
        // If the method exists in the object, return the result
        if (method_exists ($obj, $method))
            return $result;
        // Otherwise return the object itself (allows chaining)
        return $obj;
    }

    private function loadView ($view = '', $params = [], $layout = 'main') {
        // Loads a view file and wraps it in a layout
        
        // Turns array keys into variables (['title'=>'Hi'] => $title="Hi")
        extract($params);
        
        // Start output buffering (capture output instead of sending it)
        ob_start();
        // Include the view file
        include BASE_DIR . "/views/$view.php";
        // Get the buffered content (HTML from view)
        $content = ob_get_contents();
        // Clean the buffer (stop capturing)
        ob_end_clean();

        // Path to layout file (default = main.php inside views/_layout/)
        $layout = BASE_DIR . "/views/_layout/$layout.php";

        if (file_exists($layout)) {
            // If layout exists, include it (layout will use $content)
            include $layout;
        } else {
            // Otherwise, just echo the content directly
            echo $content;
        }
    }

    protected function redirect($url, $code = 302) {
        // Redirects browser to another URL with a status code (default 302 = temporary redirect)
        header("Location: " . $url, true, $code);
        exit(); // Always stop execution after redirect
    }
}