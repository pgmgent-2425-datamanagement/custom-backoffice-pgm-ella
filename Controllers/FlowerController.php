<?php

namespace App\Controllers;

use Flower;

class FlowerController extends BaseController {

    public static function list () {
        $flowers = Flower::all();

        self::loadView('/flowers', [
            'title' => 'Flowers',
            'flowers' => $flowers
        ]);
    }

}