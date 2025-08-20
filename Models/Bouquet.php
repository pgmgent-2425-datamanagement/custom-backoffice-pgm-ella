<?php

use App\Models\BaseModel; // Import the base model

class Bouquet extends BaseModel
{
    // Get stats on Bouquet statuses
    public static function getBouquetStatusStats()
    {
        $sql = "SELECT status, COUNT(*) AS total
                FROM bouquets
                GROUP BY status"; // Group bouquets by status to get counts

        $stmt = self::getDb()->prepare($sql); // Use prepare instead of query to prevent SQL injection
        $stmt->execute(); // Execute the prepared statement
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Return as associative array
    }

    // Get today's Bouquets
    public static function getTodayBouquets()
    {
        $sql = "SELECT COUNT(*) AS total
                FROM bouquets
                WHERE DATE(created_at) = CURDATE()"; // Count bouquets created today

        $stmt = self::getDb()->query($sql);
        return $stmt->fetchColumn(); // Return single column value
    }
}
