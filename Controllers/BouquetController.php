<?php

namespace App\Controllers;

// This imports the Bouquet model so we can interact with the bouquet data.
use Bouquet;

class BouquetController extends BaseController {

    // This static method will handle listing all bouquets.
    public static function list () {
        // Retrieves all bouquet records from the database using the Bouquet model.
        $bouquets = Bouquet::all();

        // Calls a method from BaseController to load the 'bouquets' view,
        // passing in the title and the retrieved bouquets data for rendering.
        self::loadView('/bouquets', [
            'title' => 'Bouquets',
            'bouquets' => $bouquets
        ]);
    }

}