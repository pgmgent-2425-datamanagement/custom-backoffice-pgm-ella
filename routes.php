<?php

//$router->get('/', function() { echo 'Dit is de index vanuit de route'; });
$router->setNamespace('\App\Controllers');
$router->get('/', 'HomeController@index');
$router->get('/clients', 'ClientControler@list');
$router->get('/bouquets', 'BouquetController@list');
$router->get('/flowers', 'FlowerController@list');
$router->get('/flowers/recent', 'FlowerController@recent');