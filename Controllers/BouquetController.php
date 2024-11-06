<?php

namespace App\Controllers;

use Bouquet;

class BouquetController extends BaseController {

    public static function list () {
        $bouquets = Bouquet::all();

        self::loadView('/bouquets', [
            'title' => 'Bouquets',
            'bouquets' => $bouquets
        ]);
    }

}