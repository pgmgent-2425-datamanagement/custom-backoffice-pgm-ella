<?php

//$router->get('/', function() { echo 'Dit is de index vanuit de route'; });
$router->setNamespace('\App\Controllers');

// Home
$router->get('/', 'HomeController@index');

// Clients
$router->get('/clients', 'ClientControler@list');

// Bouquets
$router->get('/bouquets', 'BouquetController@list');

// Flowers
$router->get('/flowers', 'FlowerController@list');
$router->get('/flowers/edit/(\d+)', 'FlowerController@edit');
$router->post('/flowers/edit/(\d+)', 'FlowerController@edit');
$router->get('/flowers/delete/(\d+)', 'FlowerController@delete');
$router->get('/flowers/add', 'FlowerController@add');
$router->post('/flowers/add', 'FlowerController@add');