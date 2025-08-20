<?php

namespace App\Controllers;

use App\Models\Flower;
use App\Controllers\BaseController;

class FlowerApiController extends BaseController
{
    // GET /api/flowers?name=rose
    public function index() // Method to handle GET requests to fetch flowers
    {
        header('Content-Type: application/json'); // Tell the browser/client that the response is JSON

        // Optional search parameter
        $name = $_GET['name'] ?? null; // Get the 'name' query parameter from the URL if it exists, otherwise null

        // Base SQL query
        $sql = "SELECT * FROM flowers WHERE 1=1"; // Start a SQL query that selects all flowers; '1=1' is a placeholder to make appending conditions easier
        $params = []; // Initialize an empty array for query parameters (used for prepared statements)

        // If a name filter was provided
        if ($name) { 
            $sql .= " AND name LIKE :name"; // Append a safe SQL condition using a placeholder ':name'
            $params[':name'] = "%$name%"; // Bind the name parameter with wildcards for partial matches
        }

        // Execute query via PDO from the model
        $stmt = Flower::getDb()->prepare($sql); // Prepare the SQL statement to prevent SQL injection
        $stmt->execute($params); // Execute the statement with bound parameters

        $flowers = $stmt->fetchAll(\PDO::FETCH_ASSOC); // Fetch all results as an associative array

        echo json_encode($flowers); // Convert the array to JSON and send it to the client
    }

    // POST /api/flowers
    public function store() // Method to handle POST requests to add a new flower
    {
        header('Content-Type: application/json'); // Tell the client we will return JSON

        // Read raw JSON input from the request body
        $input = json_decode(file_get_contents('php://input'), true); // Decode JSON to PHP associative array
        $name = $input['name'] ?? null; // Extract 'name' from input or null if missing
        $color = $input['color'] ?? null; // Extract 'color' from input or null if missing

        // Minimal validation
        if (!$name || !$color) { // Check if either name or color is missing
            http_response_code(400); // Set HTTP status code 400 (Bad Request)
            echo json_encode(['error' => 'Name and color are required']); // Send error message as JSON
            return; // Stop execution
        }

        // Insert new flower into the database
        $sql = "INSERT INTO flowers (name, color) VALUES (:name, :color)"; // SQL insert statement with placeholders
        $stmt = Flower::getDb()->prepare($sql); // Prepare the SQL statement for safe execution
        $stmt->execute([ // Execute the statement with bound values
            ':name' => $name,
            ':color' => $color
        ]);

        http_response_code(201); // Set HTTP status code 201 (Created)
        echo json_encode(['success' => 'Flower added']); // Send success message as JSON
    }
}