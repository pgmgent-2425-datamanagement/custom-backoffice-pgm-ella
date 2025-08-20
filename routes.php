<?php

//Filemanager
$router->get('/files', 'FileManagerController@index');

//$router->get('/', function() { echo 'Dit is de index vanuit de route'; });
$router->setNamespace('\App\Controllers');

// Home
$router->get('/', 'HomeController@index');

// Clients
$router->get('/clients', 'ClientController@list');

// Bouquets
$router->get('/bouquets', 'BouquetController@list');

// Flowers
$router->get('/flowers', 'FlowerController@list');

// Add a new flower
$router->get('/flowers/add', 'FlowerController@add');  // show form
$router->post('/flowers/add', 'FlowerController@add'); // handle submission

// Edit a flower
$router->get('/flowers/edit/(\d+)', 'FlowerController@edit');  // show form
$router->post('/flowers/edit/(\d+)', 'FlowerController@edit'); // handle submission

// Delete a flower
$router->get('/flowers/delete/(\d+)', 'FlowerController@delete'); // you could also do POST/DELETE

// Profile
$router->get('/profile', 'ProfileController@index');