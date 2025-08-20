<?php
require_once '../app/init.php'; // load models, controllers, DB connection

header('Content-Type: application/json');

$controller = new \App\Controllers\FlowerApiController();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $controller->index();
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->store();
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
}