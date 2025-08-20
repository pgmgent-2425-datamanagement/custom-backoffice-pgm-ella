<?php

namespace App\Models;

use PDO;

class Flower extends BaseModel
{
   // Get the most popular flowers based on order count
    public static function getMostPopularFlowers($limit = 5)
    {
        $sql = "SELECT f.name, COUNT(o.id) AS count
                FROM flowers f
                JOIN orders o ON f.id = o.flower_id
                GROUP BY f.id
                ORDER BY count DESC
                LIMIT :limit"; // SQL joins orders to count per flower

        $stmt = self::getDb()->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT); // Bind the limit
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Return as associative array
    }

    // Get total number of flowers in the database
    public static function getTotalAmount()
    {
        $sql = "SELECT COUNT(*) AS total FROM flowers";
        $stmt = self::getDb()->query($sql);
        return $stmt->fetchColumn(); // Return total count
    }
}