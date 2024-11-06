<?php

namespace App\Controllers;

use Client;

class ClientController extends BaseController {

    public static function list () {
        $clients = Client::all();

        self::loadView('/clients', [
            'title' => 'Clients',
            'clients' => $clients
        ]);
    }

}