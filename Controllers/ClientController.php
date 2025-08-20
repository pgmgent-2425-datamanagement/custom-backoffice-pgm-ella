<?php

namespace App\Controllers;

// This imports the Client model so we can interact with the client data.
use Client;

class ClientController extends BaseController {

    // This static method will handle listing all clients.
    public static function list () {
        // Retrieves all client records from the database using the Client model.
        $clients = Client::all();

        // Calls a method from BaseController to load the 'clients' view,
        // passing in the title and the retrieved clients data for rendering.
        self::loadView('/clients', [
            'title' => 'Clients',
            'clients' => $clients
        ]);
    }

}