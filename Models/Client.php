<?php

use App\Models\BaseModel; // Use the base model

class Client extends BaseModel
{
    public function recent()
    {
        $sql = 'SELECT * FROM `' . $this->table . '` ORDER BY `created_at` DESC LIMIT 20'; 
        // Select last 20 clients ordered by creation date descending

        $pdo_statement = $this->db->prepare($sql);
        $pdo_statement->execute(); // Execute the query

        $db_items = $pdo_statement->fetchAll(); // Fetch all results
        return self::castToModel($db_items); // Convert to model objects
    }
}