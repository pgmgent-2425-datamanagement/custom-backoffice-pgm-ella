<?php

namespace App\Controllers;

// HomeController is responsible for handling the homepage
class HomeController extends BaseController {

    // This method loads the homepage view
    public static function index () {

        // Load the view located at '/home/index' and pass the page title
        self::loadView('/home/index', [
            'title' => 'Homepage'
        ]);
    }

}